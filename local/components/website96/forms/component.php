<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arResponse = array();

$arPolicyField = array(
    'CODE' => 'PRIVACY_POLICY',
    'PROPERTY_TYPE' => 'L',
    'URL' => $arParams['FORM_POLITIC_URL'] ?: '',
    'NAME' => Loc::getMessage('WEBSITE96_FORMS_COMPONENT_PRIVACY_POLICY'),
    'HINT' => Loc::getMessage('WEBSITE96_FORMS_COMPONENT_PRIVACY_POLICY_HINT'),
    'DEFAULT_VALUE' => 'on'
);

if(is_array($arParams['FORM_REQUIRED_FIELDS'])){
    $arParams['FORM_REQUIRED_FIELDS'][$arPolicyField['CODE']] = $arPolicyField['CODE'];
}

if (!isset($arParams['IBLOCK_ID']) || strlen($arParams['IBLOCK_ID']) == 0){
    echo Loc::getMessage("WEBSITE96_FORMS_COMPONENT_ERROR_NOT_IBLOCK");
    return false;
}

if (!isset($_REQUEST["ajax_form"]) || empty($_REQUEST["ajax_form"])) {
    $signer = new \Bitrix\Main\Security\Sign\Signer;
    $params = $arParams;
    $newParams = [];
    foreach ($params as $key => $value) {
        if (strncmp($key, "~", strlen("~")) == 0) {
            $newParams[ substr($key, 1) ] = $value;
        }
    }
    $arResult["JSON_SIGN"] = urlencode(base64_encode($signer->sign(base64_encode(serialize($newParams)), "ajax_form_" . $arParams["IBLOCK_ID"])));
}


if (CModule::IncludeModule("iblock") && $arParams['IBLOCK_ID'] > 0) {
    $arFormBlock = CIBlock::GetByID($arParams['IBLOCK_ID'])->Fetch();
    //get all properties
    $PROPERTY_LIST = array();
    $rsIBlockProps = CIBlockProperty::GetList(
        array(
            "SORT" => "ASC"
        ),
        array(
            'ACTIVE'=>'Y',
            'IBLOCK_ID' => $arParams['IBLOCK_ID']
        )
    );
    while ($PROPERTY = $rsIBlockProps->GetNext()){
        $PROPERTY_LIST[$PROPERTY['ID']] = $PROPERTY;
    }

    if (is_array($arParams['FORM_FIELDS']) && count($arParams['FORM_FIELDS']) > 0){
        foreach ($arParams['FORM_FIELDS'] as $key => $ID) {

            switch ($PROPERTY_LIST[$ID]['PROPERTY_TYPE']) {
                case 'E':
                    if ($arParams['FORM_PRODUCT_ADD'] == "Y" && $arParams['FORM_PRODUCT_ID'] > 0) {
                        $rsProduct = CIBlockElement::GetList(
                            array(),
                            array(
                                'IBLOCK_ID' => $PROPERTY_LIST[$ID]['LINK_BLOCK_ID'],
                                'ID' => $arParams['FORM_PRODUCT_ID']
                            ), false,
                            array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_*')
                        );

                        while ($arProduct = $rsProduct->GetNextElement()) {
                            $PROPERTY_LIST[$ID]['VALUE'] = $arProduct->GetFields();
                            $PROPERTY_LIST[$ID]['VALUE']['PREVIEW_PICTURE'] =
                                CFile::ResizeImageGet(
                                    CFile::GetByID($PROPERTY_LIST[$ID]['VALUE']['PREVIEW_PICTURE'])->Fetch(),
                                    array(
                                        'width' => 150,
                                        'height' => 150
                                    ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                                    true)['src'];
                            $PROPERTY_LIST[$ID]['VALUE']['PROPERTIES'] = $arProduct->GetProperties();
                        }
                    }
                    break;
            }
            $arResult['FIELDS'][$ID] = $PROPERTY_LIST[$ID];
        }
    }
    //add policy politic field
    $arResult['FIELDS'][$arPolicyField['CODE']] = $arPolicyField;
}

if(isset($_REQUEST['ajax_send']) && $_REQUEST['ajax_send'] == "Y" && check_bitrix_sessid()) {
    $arFields = $_REQUEST['FIELDS'];

    if(!is_array($arFields))
        $arFields = Array();

    $strBodyMessage = Loc::getMessage('WEBSITE96_FORMS_COMPONENT_DATA_FORMS') . $arFormBlock['NAME'];
    $strBodyMessage .= "\n\n";
    $strBodyMessage .= '------------------------------------------'."\n\n";

    $arError = array();

    foreach ($arParams['FORM_REQUIRED_FIELDS'] as $key => $ID) {
        $PROPERTY_CODE = $arResult['FIELDS'][$ID]['CODE'];

        if (!isset($arFields[$PROPERTY_CODE]) || empty($arFields[$PROPERTY_CODE]) || $arFields[$PROPERTY_CODE] == NULL) {
            switch ($arResult['FIELDS'][$ID]['PROPERTY_TYPE']) {
                case 'S':
                    $arError[$PROPERTY_CODE] = $arResult['FIELDS'][$ID]['HINT'] ?
                        $arResult['FIELDS'][$ID]['HINT'] : '"' . $arResult['FIELDS'][$ID]['NAME'] . '"' .
                        Loc::getMessage('WEBSITE96_FORMS_COMPONENT_ERROR_EMPTY_FIELD');
                    break;
                case 'L':
                    $arError[$PROPERTY_CODE] = Loc::getMessage('WEBSITE96_FORMS_COMPONENT_ERROR_AGREEMENT');
                break;
            }

        }

    }

    if (count($arError) <= 0) {
        foreach ($arFields as $CODE => $VALUE) {
            foreach ($arResult['FIELDS'] as $ID => $arField) {
                if ($CODE == $arField['CODE']) {
                    switch ($arField['PROPERTY_TYPE']) {
                        case 'S':
                            $strBodyMessage .= $arField['NAME'].': '.htmlspecialcharsback($arFields[$CODE])."\n";
                            break;
                        case 'E':
                            $strBodyMessage .= $arField['NAME'].': '.htmlspecialcharsback($arResult['FIELDS'][$ID]['VALUE']['NAME'])." (id: ".$arResult['FIELDS'][$ID]['VALUE']["ID"].")\n";
                            break;
                    }
                }
            }
        }
        $strBodyMessage .= "\n\n";
        $strBodyMessage .= '------------------------------------------';
        $strBodyMessage .= "\n\n";
        $strBodyMessage .= Loc::getMessage('WEBSITE96_FORMS_COMPONENT_EMAIL_SIGN');

        $el = new CIBlockElement;

        $arElementFields = array(
            'NAME' => date('d.m.Y H:m:s'),
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'PROPERTY_VALUES' => $arFields
        );
        if($ID = $el->Add($arElementFields)) {
            $et = new CEventType;
            $arIBlockMessage = CIBlock::GetByID($arParams["IBLOCK_ID"])->GetNext();
            $eventID = $et->Add(array(
                "LID" => LANGUAGE_ID,
                "EVENT_NAME" => trim(htmlspecialcharsEx($arIBlockMessage['CODE'])),
                "NAME" => $arIBlockMessage['NAME'],
                "DESCRIPTION" => $arIBlockMessage['DESCRIPTION']
            ));
            $emess = new CEventMessage;
            $arMessage = Array(
                "ACTIVE" => "Y",
                "LID" => SITE_ID,
                "EVENT_NAME" => trim(htmlspecialcharsEx($arIBlockMessage['CODE'])),
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#DEFAULT_EMAIL_FROM#",
                "SUBJECT" => 'Заявка с формы "'.$arIBlockMessage['NAME'].'"',
                "BODY_TYPE" => "text",
                "MESSAGE" => '#MESSAGE#'
            );
            $arEventID = $emess->GetByID($eventID)->GetNext();
            if($arEventID['ID'] > 0){
                $res = $emess->Update($arEventID['ID'], $arMessage);
            } else {
                $arEventID['ID'] = $emess->Add($arMessage);
            }

            if(CEvent::Send($arIBlockMessage['CODE'], SITE_ID, array('MESSAGE' => $strBodyMessage),'N', $arEventID['ID'])){
                $arResponse['success'] = Loc::getMessage('WEBSITE96_FORMS_COMPONENT_EMAIL_SENT');
            }
        } else {
            $arError['ADD_MESSAGE'] = Loc::getMessage('WEBSITE96_FORMS_COMPONENT_ERROR').': '.$el->LAST_ERROR;
        }
    }

    if (count($arError) > 0) {
        $arResponse['error'] = $arError;
    }

    $APPLICATION->RestartBuffer();
    echo json_encode($arResponse);
    die();
} elseif(isset($_REQUEST['ajax_form']) && !empty($_REQUEST['ajax_form'])) {
    $APPLICATION->RestartBuffer();
    $this->IncludeComponentTemplate();
    die();
} else {
    $this->IncludeComponentTemplate();
}
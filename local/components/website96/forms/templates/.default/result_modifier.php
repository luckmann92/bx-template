<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ($arResult['FIELDS']) {
    foreach ($arResult['FIELDS'] as $k => $arField) {
        if (intval($arField['VALUE']['PROPERTIES']['PRODUCT_PRICE']['VALUE']) != 0) {
            $arResult['FIELDS'][$k]['VALUE']['PROPERTIES']['PRODUCT_PRICE']['VALUE'] =
                number_format($arField['VALUE']['PROPERTIES']['PRODUCT_PRICE']['VALUE'], 0, '', ' ');
        }
        if (intval($arField['VALUE']['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']) != 0) {
            $arResult['FIELDS'][$k]['VALUE']['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE'] =
                number_format($arField['VALUE']['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE'], 0, '', ' ');
        }
    }
}
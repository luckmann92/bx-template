<?php
/**
 * @var CMain $APPLICATION
 * @var string $headerContent
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$pageContent = ob_get_clean();
$pageContent = trim(implode("", $APPLICATION->buffer_content)) . $pageContent;
$APPLICATION->RestartBuffer();
ob_end_clean();

if (function_exists("getmoduleevents")) {
    foreach (GetModuleEvents("main", "OnLayoutRender", true) as $arEvent) {
        ExecuteModuleEventEx($arEvent);
    }
}

$pageLayout = $APPLICATION->GetPageProperty("PAGE_LAYOUT", AppGetCascadeDirProperties("PAGE_LAYOUT", "column1"));
$arLang = $APPLICATION->GetLang();

//Подключения файла настроек шаблон
require_once $_SERVER['DOCUMENT_ROOT'].'/local/tools/settings.php';

$pageTitle = $APPLICATION->GetPageProperty('title') ?: $APPLICATION->GetTitle();
?>
<!doctype html>
<html lang="<?=$arLang['LANGUAGE_ID']?>">
    <head>
        <base href="/">
        <link rel="shortcut icon" href="<?=SITE_DIR?>favicon.ico">
        <?$APPLICATION->IncludeFile("views/modules/meta.php",
            array(
                "SETTING" => $arSetting
            ), array(
                "SHOW_BORDER" => false,
                "MODE" => "php",
            ));
        $APPLICATION->ShowHead();
        ?>
        <title><?=$arLang["SITE_NAME"] ? $pageTitle . ' - ' . $arLang["SITE_NAME"] : $pageTitle?></title>
    </head>
<body class="app">
<?
if ($USER->IsAdmin()) {
    $APPLICATION->ShowPanel();
}
if ($arSetting['SHOW_PANEL'] == 'Y'){
    echo '<button class="settings__panel-show"></button>';
}

$APPLICATION->IncludeFile(
    "views/modules/header_responsive.php",
    array(
        "SETTING" => $arSetting
    ),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php"
    )
);

$APPLICATION->IncludeFile(
    "views/modules/header/" . $arSetting['HEADER'] . "/template.php",
    array(
        "SETTING" => $arSetting
    ),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php"
    )
);

if ($APPLICATION->GetCurPage(false) == SITE_DIR) {
    $APPLICATION->IncludeFile(
        "views/modules/home_page/" . mb_strtolower($arSetting['TEMPLATE_TYPE']) . "/" . $arSetting['HOME_PAGE'] . "/template.php",
        array(
            "CONTENT" => $pageContent,
            "SETTING" => $arSetting
        ),
        array(
            "SHOW_BORDER" => false,
            "MODE" => "php"
        )
    );
} else {
    $APPLICATION->IncludeFile(
        "views/layouts/".$pageLayout.".php",
        array(
            "CONTENT" => $pageContent,
            "SETTING" => $arSetting
        ),
        array(
            "SHOW_BORDER" => false,
            "MODE" => "php"
        )
    );
}

$APPLICATION->RestartWorkarea(true);

if (stripos($APPLICATION->GetCurPage(), 'cart') === true && $arSetting['TEMPLATE_TYPE'] != 'SHOP') {
    LocalRedirect('/');
} elseif($arSetting['TEMPLATE_TYPE'] == 'SHOP' && stripos($APPLICATION->GetCurPage(), 'cart') === false) {
    $APPLICATION->IncludeComponent(
        'website96:shop.basket',
        'panel',
        array()
    );
}

$APPLICATION->IncludeFile(
    "views/modules/footer.php",
    array(
        "SETTING" => $arSetting,
    ),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php"
    )
);

$APPLICATION->IncludeFile(
    "views/scripts.php",
    array(
        "SETTING" => $arSetting,
    ),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php"
    )
);

$APPLICATION->ShowBodyScripts();
?>
</body>
</html>

<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Page\Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("public/css/main.css"));

$wb = new CWebsiteTemplate();

//Подключение цветовой схемы
if ($arParams['SETTING']['COLORS']) {
    foreach ($arParams['SETTING']['COLORS'] as $code => $value) {
        $wb->getCssColorTheme($code, $value);
    }
}
//Подключение шрифтов
if ($arParams['SETTING']['FONT']) {
    foreach ($arParams['SETTING']['FONT'] as $code => $value) {
        $wb->getCssFonts($code, $value);
    }
}

if ($arParams['SETTING']['FONT_SIZE']) {
    $wb->getCssSizeFonts($arParams['SETTING']['FONT_SIZE']);
}
?>

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="UTF-8">

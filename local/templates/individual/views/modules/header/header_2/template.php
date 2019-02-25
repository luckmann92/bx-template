<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<header class="header-shop">
    <nav class="header-shop__top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col d-flex align-items-center header-shop__logo">
                    <a href="<?=SITE_DIR?>" class="d-flex align-items-center">
                        <?$APPLICATION->IncludeFile('include/'.SITE_ID.'/logo.php',
                            ['SETTING' => $arParams['SETTING']],
                            ['SHOW_BORDER' => false, 'MODE' => 'php']
                        );?>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-auto header-search">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:search.suggest.input",
                        ".default",
                        array(
                            "DROPDOWN_SIZE" => "10",
                            "INPUT_SIZE" => "20",
                            "NAME" => "q",
                            "VALUE" => "Поиск по сайту",
                            "COMPONENT_TEMPLATE" => ".default",
                            "COMPOSITE_FRAME_MODE" => "Y",
                            "COMPOSITE_FRAME_TYPE" => "STATIC"
                        ),
                        false
                    );?>
                </div>
                <div class="col header-shop__block header-shop__address">
                    <div class="header-shop__pic">
                        <?=GetContentSvgIcon('address')?>
                    </div>
                    <div class="header-shop__text">
                        <?$APPLICATION->IncludeFile(
                            "include/".SITE_ID."/contact/address.php",
                            array(), array(
                                "SHOW_BORDER" => true,
                                "MODE" => "text"
                            )
                        );?>
                    </div>
                </div>
                <div class="col header-shop__block header-shop__address">
                    <div class="header-shop__pic">
                        <?=GetContentSvgIcon('phone')?>
                    </div>
                    <div class="header-shop__text">
                        <a class="header-shop__number" href="tel:<?$APPLICATION->IncludeFile(
                            "include/".SITE_ID."/contact/phone.php",
                            array(), array(
                                "SHOW_BORDER" => false,
                                "MODE" => "text"
                            )
                        );?>"><?$APPLICATION->IncludeFile(
                                "include/".SITE_ID."/contact/phone.php",
                                array(), array(
                                    "SHOW_BORDER" => true,
                                    "MODE" => "text"
                                )
                            );?></a>
                        <?$APPLICATION->IncludeComponent(
                                "website96:forms",
                                ".default",
                                array(
                                    "CACHE_TIME" => "3600",
                                    "CACHE_TYPE" => "A",
                                    "FORM_BTN_OPEN" => "Заказать звонок",
                                    "FORM_BTN_SUBMIT" => "Отправить",
                                    "FORM_BTN_TYPE" => "header-shop__modal>",
                                    "FORM_FIELDS" => array(
                                        0 => "24",
                                        1 => "25",
                                    ),
                                    "FORM_POLITIC_URL" => "/politic/",
                                    "FORM_PRODUCT_ADD" => "N",
                                    "FORM_PRODUCT_ID" => "",
                                    "FORM_REQUIRED_FIELDS" => array(
                                        0 => "24",
                                        1 => "25",
                                    ),
                                    "FORM_TITLE" => "Оставьте заявку",
                                    "IBLOCK_ID" => "14",
                                    "IBLOCK_TYPE" => "forms",
                                    "COMPONENT_TEMPLATE" => ".default"
                                ),
                                false
                            );?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="header-shop__bottom">
        <div class="container">
            <div class="row row-line">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "header_2-top",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "top",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => $arParams["SETTING"]["TEMPLATE_TYPE"]!="COMPANY"?"top":"company_top",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "header-top",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO"
                    ),
                    false
                ); ?>
            </div>
        </div>
    </nav>
</header>
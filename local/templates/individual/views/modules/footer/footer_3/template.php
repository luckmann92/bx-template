<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/views/modules/footer/' . $arParams['SETTING']['FOOTER'] . '/style.css');
?>
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row justify-content-between align-items-start">
                    <?if($arParams['SETTING']['TEMPLATE_TYPE'] != 'COMPANY'){?>
                        <div class="footer-nav col-lg-2 col-md-3 col-sm-6">
                            <div class="footer-nav__title">Каталог продукции</div>
                            <div class="footer-nav__catalog">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    ".default",
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "catalog_top",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "Y",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "catalog_top",
                                        "USE_EXT" => "Y",
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO"
                                    ),
                                    $component
                                );?>
                            </div>
                        </div>
                    <?}?>
                    <div class="footer-nav two-columns <?=$arParams['SETTING']['TEMPLATE_TYPE'] != 'COMPANY' ? 'col-lg-4 col-md-5 col-sm-6' : 'col-lg-8 col-md-8 col-sm-12'?>">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            ".default",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "Y",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "footer",
                                "USE_EXT" => "N",
                                "COMPONENT_TEMPLATE" => ".default",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                            ),
                            false
                        );?>
                    </div>
                    <div class="footer-info <?=$arParams['SETTING']['TEMPLATE_TYPE'] != 'COMPANY' ? 'col-lg-5 col-md-4 col-sm-12' : 'col-lg-4 col-md-4 col-sm-12'?>">
                        <div class="footer-contact">
                            <div class="footer-contact__content">
                                <div class="footer-contact__name"><?$APPLICATION->IncludeFile("include/".SITE_ID."/contact/phone__title.php",[],["SHOW_BORDER"=>true,"MODE"=>"text"]);?></div>
                                <a class="footer-contact__link"
                                   href="tel:<?$APPLICATION->IncludeFile("include/".SITE_ID."/contact/phone.php", [],["SHOW_BORDER" => false,"MODE" => "text"]);?>">
                                    <?$APPLICATION->IncludeFile("include/".SITE_ID."/contact/phone.php", [],["SHOW_BORDER"=>true, "MODE" => "text"]);?></a>
                            </div>
                            <a class="btn js-init-modal__form btn-default btn-white" href="#">Заказать звонок</a>
                        </div>
                        <div class="footer-contact">
                            <div class="footer-contact__content">
                                <div class="footer-contact__name">Эл. почта</div>
                                <a class="footer-contact__link"
                                   href="mailto:website@info.ru">
                                    website@info.ru</a>
                            </div>
                        </div>
                        <div class="footer-contact">
                            <div class="footer-contact__content">
                                <div class="footer-contact__name"><?$APPLICATION->IncludeFile("include/".SITE_ID."/contact/address__title.php",[],["SHOW_BORDER"=>true,"MODE"=>"text"]);?></div>
                                <a class="footer-contact__link"
                                   href="<?=SITE_DIR?>contacts/"><?$APPLICATION->IncludeFile("include/".SITE_ID."/contact/address.php", [],["SHOW_BORDER"=>true,"MODE" =>"text"]);?></a>
                            </div>
                        </div>
                        <div class="col footer-search footer-search">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row justify-content-sm-between align-items-center">
                    <div class="col-12 col-md-4 copyright">
                        <?$APPLICATION->IncludeFile("include/".SITE_ID."/copyright.php", [], ["SHOW_BORDER" => true, "MODE" => "text"]);?>
                    </div>
                    <div class="col-12 col-md-4 socicons">
                        <a href="#">
                            <?=GetContentSvgIcon('vk');?>
                        </a>
                        <a href="#">
                            <?=GetContentSvgIcon('fb');?>
                        </a>
                        <a href="#">
                            <?=GetContentSvgIcon('ig');?>
                        </a>
                        <a href="#">
                            <?=GetContentSvgIcon('tw');?>
                        </a>
                    </div>
                    <div class="col-12 col-md-4 developer">
                        <a rel="nofollow" href="http://website96.ru/" target="_blank" title="Разработано Website96"><?=GetContentSvgIcon('website96')?></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?
if($_COOKIE["confirm_fz152"] != 'y'){
    $APPLICATION->IncludeComponent(
        "website96:inline.value",
        "fz152",
        array(
            "COMPONENT_TEMPLATE" => "fz152",
            "VALUE" => "Сайт использует файлы cookies и сервис сбора технических данных его посетителей.  Продолжая использовать данный ресурс, вы автоматически соглашаетесь с использованием данных технологий."
        ),
        false
    );
}
?>
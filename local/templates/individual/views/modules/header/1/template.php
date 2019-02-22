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
                <div class="col header-search">
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
                    <?=GetContentSvgIcon('address')?>
                    <div class="header-shop__text">
                        <span>г. Екатеринбург</span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="header-shop__bottom">
        <div class="container">
            <div class="row row-line">
                <ul class="header-shop__list">
                    <li>
                        <a href="/catalog/elektronika/">Каталог товаров</a>
                    </li>
                    <li>
                        <a href="/catalog/mebel/">О компании</a>
                    </li>
                    <li>
                        <a href="/catalog/odezhda/">Новости и акции</a>
                    </li>
                    <li>
                        <a href="/catalog/krasota-i-zdorove/">Доставка и оплата</a>
                    </li>
                    <li>
                        <a href="/catalog/sport-i-turizm/">Гарантии</a>
                    </li>
                    <li>
                        <a href="/catalog/uslugi/">Вопрос-ответ</a>
                    </li>
                    <li>
                        <a href="/catalog/uslugi/">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
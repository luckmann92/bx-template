<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
\Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/views/modules/header/' . $arParams['SETTING']['HEADER'] . '/style.css');
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/views/modules/header/' . $arParams['SETTING']['HEADER'] . '/script.css');
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if($arResult['ITEMS']){?>
    <section class="section-slider">
        <div class="slider-home"
             data-dots="<?=count($arResult['ITEMS']) > 0 ? 'true':'false'?>"
             data-arrows="<?=$arParams['SLIDER_ARROWS'] == 'N' ? 'false' : 'true'?>"
             data-speed="<?=$arParams['SLIDER_TIME'] > 0 ? $arParams['SLIDER_TIME'] : '0'?>"
             data-autoplay="<?=$arParams['SLIDER_AUTOPLAY'] == 'Y' ? 'true' : 'false'?>"
             data-autoheight="<?=$arParams['SLIDER_AUTOHEIGHT'] == 'Y' ? 'true' : 'false'?>"
        >
            <?foreach ($arResult['ITEMS'] as $k => $arSlide){
                $this->AddEditAction($arSlide['ID'], $arSlide['EDIT_LINK'], CIBlock::GetArrayByID($arSlide["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arSlide['ID'], $arSlide['DELETE_LINK'], CIBlock::GetArrayByID($arSlide["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="slide-item slide-item__1<?=$arSlide['PROPERTIES']['SLIDE_SHADOW']['VALUE_XML_ID'] == 'Y' ? ' c-shadow' : ''?>"
                     style="background-image: url(<?=$arSlide['PREVIEW_PICTURE']['SRC']?>);"
                     id="<?=$this->GetEditAreaId($arSlide['ID']);?>">
                    <div class="container">
                        <div class="row">
                            <div class="slide-item__caption col-12 col-lg-6 col-md-9">
                                <div class="section-title c-<?=$arSlide['PROPERTIES']['SLIDE_TITLE_THEME']['VALUE_XML_ID']?>">
                                    <h2><?=$arSlide['NAME']?></h2>
                                </div>
                                <?if($arSlide['PREVIEW_TEXT']){?>
                                    <p class="slide-item__anons c-<?=$arSlide['PROPERTIES']['SLIDE_TITLE_THEME']['VALUE_XML_ID']?>"><?=$arSlide['PREVIEW_TEXT']?></p>
                                <?}?>
                                <div class="slide-item__bottom">
                                    <?if($arSlide['PROPERTIES']['LINK_SECTION']['VALUE']){?>
                                        <a href="<?=$arSlide['PROPERTIES']['LINK_SECTION']['VALUE']?>" target="_blank" class="btn btn-primary btn-slider-big b-<?=$arSlide['PROPERTIES']['SLIDE_TITLE_THEME']['VALUE_XML_ID']?>">
                                            <?=$arSlide['PROPERTIES']['LINK_BUTTON_NAME']['VALUE'] ? $arSlide['PROPERTIES']['LINK_BUTTON_NAME']['VALUE'] : GetMessage('LINK_MORE')?>
                                        </a>
                                    <?}?>
                                    <div class="slider__arrows-box slider__arrows-content">
                                        <button type="button" class="slide-prev slick-prev slider-home__prev slick-arrow"></button>
                                        <button type="button" class="slide-next slick-next slider-home__next slick-arrow"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
       <div class="slider-links">
           <div class="container">
               <div class="row">
                   <div class="col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">
                       <div class="slider-links__box">
                           <a href="#" class="slider-links__item">
                               <div class="slider-links__image">
                                   <img
                                       src="/upload/iblock/cce/cce73c110a642b31683a3dfd66533fa5.jpg"
                                       lazy-images="/upload/iblock/cce/cce73c110a642b31683a3dfd66533fa5.jpg"
                                       alt="<?=$arSection['PICTURE']['ALT'] ? $arSection['PICTURE']['ALT'] : $arSection['NAME']?>"
                                       title="<?=$arSection['PICTURE']['TITLE'] ? $arSection['PICTURE']['TITLE'] : $arSection['NAME']?>">
                               </div>
                               <span class="slider-links__title">Выгодная бонусная система befree</span>
                           </a>
                           <a href="#" class="slider-links__item">
                               <div class="slider-links__image">
                                   <img
                                           src="/upload/iblock/cce/cce73c110a642b31683a3dfd66533fa5.jpg"
                                           lazy-images="/upload/iblock/cce/cce73c110a642b31683a3dfd66533fa5.jpg"
                                           alt="<?=$arSection['PICTURE']['ALT'] ? $arSection['PICTURE']['ALT'] : $arSection['NAME']?>"
                                           title="<?=$arSection['PICTURE']['TITLE'] ? $arSection['PICTURE']['TITLE'] : $arSection['NAME']?>">
                               </div>
                               <span class="slider-links__title">Выгодная бонусная система befree</span>
                           </a>
                           <a href="#" class="slider-links__item">
                               <div class="slider-links__image">
                                   <img
                                           src="/upload/iblock/cce/cce73c110a642b31683a3dfd66533fa5.jpg"
                                           lazy-images="/upload/iblock/cce/cce73c110a642b31683a3dfd66533fa5.jpg"
                                           alt="<?=$arSection['PICTURE']['ALT'] ? $arSection['PICTURE']['ALT'] : $arSection['NAME']?>"
                                           title="<?=$arSection['PICTURE']['TITLE'] ? $arSection['PICTURE']['TITLE'] : $arSection['NAME']?>">
                               </div>
                               <span class="slider-links__title">Выгодная бонусная система befree</span>
                           </a>
                           <a href="#" class="slider-links__item">
                               <div class="slider-links__image">
                                   <img
                                           src="/upload/iblock/cce/cce73c110a642b31683a3dfd66533fa5.jpg"
                                           lazy-images="/upload/iblock/cce/cce73c110a642b31683a3dfd66533fa5.jpg"
                                           alt="<?=$arSection['PICTURE']['ALT'] ? $arSection['PICTURE']['ALT'] : $arSection['NAME']?>"
                                           title="<?=$arSection['PICTURE']['TITLE'] ? $arSection['PICTURE']['TITLE'] : $arSection['NAME']?>">
                               </div>
                               <span class="slider-links__title">Выгодная бонусная система befree</span>
                           </a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </section>
<?}?>
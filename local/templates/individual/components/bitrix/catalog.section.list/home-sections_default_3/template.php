<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

?>
<?if ($arResult['SECTIONS']) {
    //ob_start();
    ?>
    <section class="section-home section-categories section-categories__1">
        <?if($APPLICATION->GetCurPage(false) === '/'){?>
            <div class="section-title">
                <div class="container">
                    <div class="row justify-content-md-between justify-content-sm-start align-items-end align-items-md-center">
                        <div class="col-auto">
                            <h2><?=$arParams['SECTION_TITLE'] ? $arParams['SECTION_TITLE'] : GetMessage('CATEGORIES_SECTION_TITLE_DEFAULT')?></h2>
                        </div>
                        <div class="col-auto">
                            <a href="/catalog/" class="btn btn-link"><?=$arParams['SECTION_LINK'] ? $arParams['SECTION_LINK'] : GetMessage('CATEGORIES_SECTION_LINK_DEFAULT')?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?}?>
        <div class="container">
            <div class="container-section container-section--popular">
                <?$i = 1;
                foreach ($arResult['SECTIONS'] as $arSection){
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
                    <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="section-item" id="<?=$this->GetEditAreaId($arSection['ID']);?>" >
                        <div class="section-item__image" style="background-image: url(<?=$arSection['PICTURE']['SRC']?>)">
                            <!--<img lazy-images="<?/*=$arSection['PICTURE']['SRC']*/?>"
                                 alt="<?/*=$arSection['PICTURE']['ALT'] ? $arSection['PICTURE']['ALT'] : $arSection['NAME']*/?>"
                                 title="<?/*=$arSection['PICTURE']['TITLE'] ? $arSection['PICTURE']['TITLE'] : $arSection['NAME']*/?>">-->
                        </div>
                        <div class="section-item__name"><?=$arSection['NAME']?></div>
                    </a>
                <?$i++;
                }?>
            </div>
        </div>
    </section>
<?
   // $componentContent = ob_get_clean();
}?>
<?
   /* $hash = mb_strimwidth(hash('sha256', $templateName), 0 , 5);
    preg_match_all('~(?<=class=").*?(?=")~i', $componentContent, $matches);
    foreach ($matches[0] as $mts) {
        $mt = explode(' ', $mts);
        foreach ($mt as $m) {
            if (stripos($componentContent, $m . '_' . $hash) === false) {
                $componentContent = str_replace($m, $m . '_' . $hash, $componentContent);
            }
        }

    }
    echo $componentContent;*/
?>

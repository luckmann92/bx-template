<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
    <div class="papers__text">Описание раздела. Поделиться мнением клиентов о компании. Сделать так, чтобы мнение не выглядело самовосхвалением: дать контакты клиентов и предложить узнать, что они думают о сотрудничестве (tektonika.pro); публиковать не только положительное мнение, но и отрицательное (реклама в блоге Тёмы); использовать для публикации мнений аккаунты в соцсетях (mmp.ru).</div>
    <div class="papers__list">
        <div class="papers__item">
            <div class="papers__image">
                <img src="\local\templates\individual\public\images\paper.png" alt="">
            </div>
            <div class="papers__info">
                <div class="papers__date">
                    <span class="papers__month">Февраль</span>
                    <span class="papers__year">2019</span>
                </div>
                <a href="#" class="papers__link" download><?=GetContentSvgIcon('pdf')?>Название файла</a>
            </div>
        </div>
        <div class="papers__item">
            <div class="papers__image">
                <img src="\local\templates\individual\public\images\paper.png" alt="">
            </div>
            <div class="papers__info">
                <div class="papers__date">
                    <span class="papers__month">Февраль</span>
                    <span class="papers__year">2019</span>
                </div>
                <a href="#" class="papers__link" download><?=GetContentSvgIcon('pdf')?>Название файла</a>
            </div>
        </div>
        <div class="papers__item">
            <div class="papers__image">
                <img src="\local\templates\individual\public\images\paper.png" alt="">
            </div>
            <div class="papers__info">
                <div class="papers__date">
                    <span class="papers__month">Февраль</span>
                    <span class="papers__year">2019</span>
                </div>
                <a href="#" class="papers__link" download><?=GetContentSvgIcon('pdf')?>Название файла</a>
            </div>
        </div>
    </div>
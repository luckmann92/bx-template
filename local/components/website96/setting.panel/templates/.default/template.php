<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arResult['SETTING']['SHOW_PANEL'] == 'Y'){?>
    <div class="box__modal-setting animated">
        <div class="settings__panel">
            <div class="settings__panel-buttons-wrap">
                <div class="settings__panel-buttons">
                    <a onclick="modalClose(event);" href="#" class="settings__panel-show"></a>
                    <button class="js-init_apply_settings group__panel-submit">
                        <svg width="22" height="15" viewBox="0 0 22 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.9348 0.299139C20.536 -0.0997131 19.8894 -0.0997131 19.4905 0.299139L7.25512 12.5347L2.55203 7.83158C2.15322 7.43273 1.50663 7.43277 1.10773 7.83158C0.708881 8.23039 0.708881 8.87698 1.10773 9.27584L6.53297 14.701C6.93167 15.0998 7.57873 15.0995 7.97727 14.701L20.9348 1.74343C21.3337 1.34462 21.3336 0.697992 20.9348 0.299139Z" fill="white"/></svg>
                        Применить
                    </button>
                </div>  
            </div>
            <form action="<?=POST_FORM_ACTION_URI?>" method="get" enctype="multipart/form-data">
                <div class="settings__panel-content active">
                    <?=bitrix_sessid_post()?>
                    <input type="hidden" value="Y" name="SET_SETTING">
                    <?

                    foreach ($arResult['FIELDS'] as $CODE => $arFields) {
                        switch ($CODE) {
                            case 'HEADER':?>
                                <div class="group__panel page__view">
                                    <div class="group__theme-title">Вид шапки</div>
                                    <div class="group__theme-list group__header">
                                        <?foreach ($arFields as $field) {?>
                                            <div class="col__line">
                                                <label class="view__label view__line" for="headerView__<?=$field['ID']?>"
                                                    <?=$field['PICTURE'] ? 'style="background-image:url(' . $field['PICTURE'] . ')"' : ''?>>
                                                    <input type="radio"
                                                           name="<?=$CODE?>"
                                                           id="headerView__<?=$field['ID']?>"
                                                           value="<?=$field['ID']?>"
                                                        <?=$arResult['SETTING']['HEADER'] == $field['ID'] ? 'checked' : ''?>
                                                    >
                                                    <span class="pageView__name"><?=$field['NAME']?></span>
                                                </label>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                                <!--<select name="<?/*=$CODE*/?>">
                                    <?/*foreach ($arFields as $field) {*/?>
                                        <?/*if ($field['PICTURE']) {*/?>
                                            <img src="<?/*=$field['PICTURE']*/?>">
                                        <?/*}*/?>
                                        <option value="<?/*=$field['ID']*/?>" <?/*=$arResult['SETTING']['HEADER'] == $field['ID'] ? 'selected' : ''*/?>><?/*=$field['NAME']*/?></option>
                                    <?/*}*/?>
                                </select>-->

                                <?break;
                            case 'TEMPLATE_TYPE':?>
                                <div class="group__panel" id="template-type">
                                    <div class="group__theme-title">Готовое решение</div>
                                    <div class="group__theme-list type__list">
                                        <?foreach ($arFields as $code => $name) {?>
                                            <label class="type__label pageType__<?=mb_strtolower($code)?> <?=$arResult['SETTING']['TEMPLATE_TYPE'] == $code ? 'type__checked' : ''?>"
                                                   for="pageType__<?=mb_strtolower($code)?>">
                                                <input type="radio"
                                                       name="TEMPLATE_TYPE"
                                                       id="pageType__<?=mb_strtolower($code)?>"
                                                       value="<?=$code?>"
                                                    <?=$arResult['SETTING']['TEMPLATE_TYPE'] == $code ? 'checked' : ''?>>
                                                <span><?=$name?></span>
                                            </label>
                                        <?}?>
                                    </div>
                                </div>
                                <?break;
                            case 'FONTS':?>
                                <div class="group-inline-panel">
                                    <div class="group__panel" id="title-font">
                                        <label class="group__theme-title" for="selectMainfont">Основной шрифт</label>
                                        <div class="group__theme-list">
                                            <div class="group__theme-type">
                                                <select name="FONT[SIMPLE]"
                                                        class="group__theme-template__select"
                                                        id="selectMainfont">
                                                        <?foreach ($arFields as $field) {?>
                                                            <option value="<?=$field['FONT_CODE']?>"
                                                                <?=$arResult['SETTING']['FONT']['SIMPLE'] == $field['FONT_CODE']
                                                                    ? 'selected' : ''?>><?=$field['FONT_NAME']?></option>
                                                        <?}?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?if ($arResult['FIELDS']['FONT_SIZE']) {?>
                                        <div class="group__panel" id="title-font">
                                            <label class="group__theme-title" for="selectMainfont">Размер шрифта</label>
                                            <div class="group__theme-list">
                                                <div class="group__theme-type">
                                                    <select name="FONT_SIZE"
                                                            class="group__theme-template__select"
                                                            id="selectSizefont">
                                                            <?foreach ($arResult['FIELDS']['FONT_SIZE'] as $id => $arFont) {?>
                                                                <option value="<?=$id?>"
                                                                    <?=$arResult['SETTING']['FONT_SIZE'] == $id
                                                                ? 'selected' : ''?>><?=$arFont?></option>
                                                            <?}?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?}?>
                                </div>
                                <div class="group__panel" id="simple-font">
                                    <label class="group__theme-title" for="selectTitlefont">Шрифт для заголовков</label>
                                    <div class="group__theme-list">
                                        <div class="group__theme-type">
                                            <select name="FONT[TITLE]"
                                                    class="group__theme-template__select"
                                                    id="selectTitlefont">
                                                    <?foreach ($arFields as $field) {?>
                                                        <option value="<?=$field['FONT_CODE']?>"
                                                            <?=$arResult['SETTING']['FONT']['TITLE'] == $field['FONT_CODE']
                                                                ? 'selected' : ''?>><?=$field['FONT_NAME']?></option>
                                                    <?}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?
                                break;
                            case 'COLORS':?>
                                <div class="group__panel">
                                    <div class="group__theme-title">Активный (основный) цвет</div>
                                    <div class="group__theme-list">
                                        <?foreach ($arFields as $id => $field) {?>
                                            <div class="theme__color theme__default">
                                                <label class="color__label"
                                                       for="actionColor_<?=$id?>"
                                                       title="<?=$field['COLOR_NAME']?>" >
                                                    <input type="radio"
                                                           name="COLORS[ACTION]"
                                                           id="actionColor_<?=$id?>"
                                                           value="<?=$field['COLOR_CODE']?>"
                                                        <?=$arResult['SETTING']['COLORS']['ACTION'] == $field['COLOR_CODE'] ? 'checked' : ''?>>
                                                    <span style="background-color: #<?=$field['COLOR_HEX']?>"></span>
                                                </label>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                                <div class="group__panel">
                                    <div class="group__theme-title">Дополнительный цвет</div>
                                    <div class="group__theme-list">
                                        <?foreach ($arFields as $id => $field) {?>
                                            <div class="theme__color theme__default">
                                                <label class="color__label"
                                                       for="mainColor_<?=$id?>"
                                                       title="<?=$field['COLOR_NAME']?>" >
                                                    <input type="radio"
                                                           name="COLORS[MAIN]"
                                                           id="mainColor_<?=$id?>"
                                                           value="<?=$field['COLOR_CODE']?>"
                                                        <?=$arResult['SETTING']['COLORS']['MAIN'] == $field['COLOR_CODE'] ? 'checked' : ''?>>
                                                    <span style="background-color: #<?=$field['COLOR_CODE'] == 'default' ? 'fff' : $field['COLOR_HEX']?>"></span>
                                                </label>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                                <?
                                break;
                            case 'HOME_PAGE':?>
                                <div class="group__panel page__view">
                                    <div class="group__theme-title">Вид главной страницы</div>
                                    <div class="group__theme-list">
                                        <?foreach ($arFields as $field) {?>
                                            <div class="col__part">
                                                <label class="view__label" for="pageView__<?=$field['ID']?>"
                                                    <?=$field['PICTURE'] ? 'style="background-image:url(' . $field['PICTURE'] . ')"' : ''?>>
                                                    <input type="radio"
                                                           name="HOME_PAGE"
                                                           id="pageView__<?=$field['ID']?>"
                                                           value="<?=$field['ID']?>"
                                                           <?=$arResult['SETTING']['HOME_PAGE'] == $field['ID'] ? 'checked' : ''?>
                                                    >
                                                    <span class="pageView__name"><?=$field['NAME']?></span>
                                                </label>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                                <?
                                break;
                        }
                    }?>
                </div>
            </form>
        </div>
    </div>
    <?foreach ($arResult['FIELDS']['FONTS'] as $font) {?>
        <link href="<?=$font['FONT_SRC']?>" rel="stylesheet">
    <?}
}?>
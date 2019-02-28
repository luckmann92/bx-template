<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<?if (!empty($arResult)){?>
    <ul class="header-shop__list">
        <?foreach ($arResult as $arItem){?>
            <li <?=$arItem["SELECTED"] ? 'class="active"' : ''?>>
                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </li>
        <?}?>
    </ul>
<?}?>
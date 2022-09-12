<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
---
</br>
<p><b><?=GetMessage("SIMPLECOMP_CAT_TITLE")?></b></p>

<?php if (count($arResult["NEWS"]) > 0) { ?>
    <ul>
        <?php foreach ($arResult["NEWS"] as $key => $arNews) { ?>
            <li>
                <b>
                    <?=$arNews["NAME"];?>
                </b>
                - <?=$arNews["ACTIVE_FROM"];?>
                (<?=implode(",", $arNews["SECTIONS"]);?>)
            </li>
            <?php if (count($arNews["PRODUCTS"]) > 0) { ?>
                <ul>
                <?php foreach ($arNews["PRODUCTS"] as $arProduct) { ?>
                        <?=$arProduct["NAME"];?> -
                        <?=$arProduct["ATT_PRICE"];?> -
                        <?=$arProduct["ATT_MATERIAL"];?> -
                        <?=$arProduct["ATT_CODE"];?>

                    </li>
                    </br>
                <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>
    </ul>
    </br>
<?php } ?>
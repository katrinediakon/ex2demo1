<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?global $APPLICATION;
foreach($arResult["ITEMS"] as $arItem)
{
$arResult["SPECIALDATE"]=$arItem["DISPLAY_ACTIVE_FROM"];
break;
}
$this->__component->SetResultCacheKeys(array(

"SPECIALDATE",

));

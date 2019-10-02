

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


<h3>Каталог: </h3>
<?$min=10000;$max=0?>
<?php foreach ($arResult as $key => $value): ?>
  <ul>
    <li><?=$value["NAME"]?> - <?=date(" d.m.Y", strtotime($value["DATE_CREATE"]))?></li>
    <p>(
      <?php foreach ($value["SECTION"] as $SECTION_ID => $SECTION): ?>
        <?=$SECTION["NAME"]?>,
      <?php endforeach; ?>
    )</p>
    <?php foreach ($value["SECTION"] as $SECTION_ID => $SECTION): ?>
      <?php foreach ($SECTION["ELEMENTS"] as $ELEMENT_ID => $ELEMENT): ?>
        <?if($min>$ELEMENT['PRICE']) $min=$ELEMENT['PRICE']?>
        <?if($max<$ELEMENT['PRICE']) $max=$ELEMENT['PRICE']?>
        <p><?=$ELEMENT['NAME']."-".$ELEMENT['PRICE']."-".$ELEMENT['MATERIAL']."-".$ELEMENT['ARTNUMBER']?> </p>
      <?php endforeach; ?>
    <?php endforeach; ?>

  </ul>
  <?php endforeach; ?>
  <?
  global $APPLICATION;
   $APPLICATION->SetPageProperty('MinandMax', '<p>Максимальная цена: '.$max.'</p>
   <p>Минимальная цена: '.$min.'</p>');?>

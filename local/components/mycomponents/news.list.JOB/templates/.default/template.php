

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
        <p><?=$ELEMENT['NAME']."-".$ELEMENT['PRICE']."-".$ELEMENT['MATERIAL']."-".$ELEMENT['ARTNUMBER']?> </p>
      <?php endforeach; ?>
    <?php endforeach; ?>

  </ul>


<?php endforeach; ?>

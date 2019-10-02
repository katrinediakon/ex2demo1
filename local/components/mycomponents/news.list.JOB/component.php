<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @global CIntranetToolbar $INTRANET_TOOLBAR */
global $INTRANET_TOOLBAR;

use Bitrix\Main\Context,
	Bitrix\Main\Type\DateTime,
	Bitrix\Main\Loader,
	Bitrix\Iblock;

CModule::IncludeModule("iblock");


$arResult= array();
$id= array();
$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID2"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), Array("ID", "NAME","DATE_CREATE"));

while($ob = $res->GetNext())
{

	$proba= array();
	$proba["NAME"]=$ob["NAME"];
	$proba["DATE_CREATE"]=$ob["DATE_CREATE"];
	$proba["ID"]=$ob["ID"];

	$id[]=$ob["ID"];
	$arResult[$ob["ID"]]=$proba;

}

	  // $proba= array();
		// $arProj = CIBlockSection::GetList(array("SORT"=>"ASC"), array('IBLOCK_ID' =>  $arParams["IBLOCK_ID"], "UF_NEWS_LINK" => $variable["ID"] ),false, array("UF_NEWS_LINK"));
		// while($projRes = $arProj->GetNext())
		//  {
		// 		 $proba["NAME"]=$projRes["NAME"];
		// 		 $proba["ID"]=$projRes["ID"];
		// 		 $proba["DATE_CREATE"]=$projRes["DATE_CREATE"];
		// 		 $proba["UF_NEWS_LINK"]=$projRes["UF_NEWS_LINK"];
		// 		 $arResult[$key][]=$proba;
		//  }
		$arProj = CIBlockSection::GetList(array("SORT"=>"ASC"), array('IBLOCK_ID' =>  $arParams["IBLOCK_ID"]),false, array($arParams["NEWS_COUNT"]));
		 while($projRes = $arProj->GetNext())
		 {
			 	$proba= array();
			 	$proba["NAME"]=$projRes["NAME"];
			 	$proba["ID"]=$projRes["ID"];
			 	$proba["DATE_CREATE"]=$projRes["DATE_CREATE"];
				foreach ($projRes["UF_NEWS_LINK"] as $key => $value) {
						$arResult[$value]["SECTION"][]=$proba;

				}

		 }

foreach ($arResult as $key => $value) {
		foreach ($value["SECTION"] as $val => $section) {
			$elements= array();
			 $arFilter = Array("SECTION_ID"=>$section["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
			 $el = CIBlockElement::GetList([], $arFilter, false, Array("nPageSize"=>50), Array("ID","IBLOCK_ID","NAME", "PROPERTY_PRICE","PROPERTY_ARTNUMBER", "PROPERTY_MATERIAL"));
			 while($obel = $el->GetNext())
			 {
				 $proba= array();
				 $proba["NAME"]=$obel["NAME"];
				 $proba["PRICE"]=$obel["PROPERTY_PRICE_VALUE"];
				 $proba["ARTNUMBER"]=$obel["PROPERTY_ARTNUMBER_VALUE"];
				 $proba["MATERIAL"]=$obel["PROPERTY_MATERIAL_VALUE"];
				 $elements[]=$proba;
			 }
			 $arResult[$key]["SECTION"][$val]["ELEMENTS"]=$elements;
		}
}
$this->includeComponentTemplate();

?>

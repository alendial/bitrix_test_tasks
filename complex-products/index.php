<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог товаров комплексный");
?>
<div class="container">
    <?$APPLICATION->IncludeComponent(
        "twr:complex_catalog",
        ".default",
        array(
            "IBLOCK_ID" => "2",
            "CACHE_TIME" => "3600",
            "COMPONENT_TEMPLATE" => ".default",
        ),
        false
    );?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?php
$APPLICATION->IncludeComponent(
    "twr:catalog_tree",
    "",
    Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
    ),
    $component
);
?>
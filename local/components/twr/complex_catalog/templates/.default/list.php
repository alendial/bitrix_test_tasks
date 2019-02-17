<?php
$APPLICATION->IncludeComponent(
    "twr:catalog_list",
    "",
    Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
    ),
    $component
);
?>
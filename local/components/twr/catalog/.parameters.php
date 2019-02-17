<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    'GROUPS' => array(),
    'PARAMETERS' => array(
        'IBLOCK_ID' => array(
            'NAME' => 'ID инфоблока',
            'TYPE' => 'INTEGER',
            'MULTIPLE' => 'N',
            'DEFAULT' => 1
        ),
        'CACHE_LIFETIME' => array(
            'NAME' => 'Время жизни кэша секунд',
            'TYPE' => 'INTEGER',
            'MULTIPLE' => 'N',
            'DEFAULT' => 3600
        ),
    )
);
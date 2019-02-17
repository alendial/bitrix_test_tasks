<?php
$arUrlRewrite = array(
//    4 => array(
//        'CONDITION' => '#^/#',
//        'RULE' => '',
//        'ID' => '',
//        'PATH' => '/index.php',
//        'SORT' => 100,
//    ),
    3 => array(
        'CONDITION' => '#^/complex-products/#',
        'RULE' => '',
        'ID' => '',
        'PATH' => '/complex-products/index.php',
        'SORT' => 100,
    ),
    2 => array(
        'CONDITION' => '#^/products/#',
        'RULE' => '',
        'ID' => '',
        'PATH' => '/products/index.php',
        'SORT' => 100,
    ),
    1 => array (
        'CONDITION' => '#^/bitrix/services/ymarket/#',
        'RULE' => '',
        'ID' => '',
        'PATH' => '/bitrix/services/ymarket/index.php',
        'SORT' => 100,
    ),
    0 => array (
        'CONDITION' => '#^/rest/#',
        'RULE' => '',
        'ID' => NULL,
        'PATH' => '/bitrix/services/rest/index.php',
        'SORT' => 100,
    ),
);

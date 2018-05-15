<?php

/**
 * @var $router \app\behaviors\micro\UrlManager
 */


$router->get('/', function () {
    return 'yii2 micro';
});

$router->get('<say:\w+>/<where:\w+>', function ($say, $where) {
    return $say . ' - ' . $where;
});
<?php

namespace app\behaviors\micro;

use yii\web\UrlRule;

/**
 * Class UrlManager
 *
 * just for auto complete :D
 *
 * @package app\components
 *
 * @method void get(string $pattern, string|\Closure $route, $append = true)
 * @method void post(string $pattern, string|\Closure $route, $append = true)
 * @method void put(string $pattern, string|\Closure $route, $append = true)
 * @method void patch(string $pattern, string|\Closure $route, $append = true)
 * @method void delete(string $pattern, string|\Closure $route, $append = true)
 * @method void options(string $pattern, string|\Closure $route, $append = true)
 * @method void head(string $pattern, string|\Closure $route, $append = true)
 * @method void any(string $pattern, string|\Closure $route, $append = true)
 *
 * @method \Closure getCallback($id)
 */
class UrlManager extends \yii\web\UrlManager
{
    public function behaviors()
    {
        return [
            'micro' => MicroBehavior::className(),
        ];
    }
}
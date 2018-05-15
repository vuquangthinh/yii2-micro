<?php
/**
 * Created by PhpStorm.
 * User: quangthinh
 * Date: 5/15/18
 * Time: 8:17 PM
 */

namespace app\behaviors\micro;


use yii\web\UrlRule;

class MicroRule extends UrlRule
{
    private static $id = 0;

    private $_name;

    public function getName($generated = false) {
        if (empty($this->_name)) {
            $this->_name = 'actionMicro' . self::$id++;
        }
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function setCallback($callback) {

    }
}
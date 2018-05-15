<?php
/**
 * Created by PhpStorm.
 * User: quangthinh
 * Date: 5/15/18
 * Time: 8:19 PM
 */

namespace app\behaviors\micro;


use Yii;
use yii\rest\Controller;

class MicroController extends Controller
{
    public function createAction($id)
    {
        /**
         * @var UrlManager $urlManager
         */
        $urlManager = Yii::$app->urlManager;
        $callback  = $urlManager->getCallback($id);
        if ($callback) {
            return new MicroAction($id, $this, $callback);
        }

        return parent::createAction($id);
    }
}
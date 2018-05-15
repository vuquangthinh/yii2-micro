<?php
/**
 * Created by PhpStorm.
 * User: quangthinh
 * Date: 5/15/18
 * Time: 8:54 PM
 */

namespace app\behaviors\micro;


use ReflectionFunction;
use Yii;
use yii\base\Action;
use yii\base\Controller;
use yii\base\InlineAction;
use yii\web\BadRequestHttpException;

class MicroAction extends Action
{
    private $callback;

    public function __construct($id, Controller $controller, $callback, array $config = [])
    {
        $this->callback = $callback;
        parent::__construct($id, $controller, $config);
    }

    private function bindActionParams($params) {
        $args = [];
        $missing = [];
        $actionParams = [];

        $reflection = new ReflectionFunction($this->callback);
        foreach ($reflection->getParameters() as $param) {
            $name = $param->getName();
            if (array_key_exists($name, $params)) {
                if ($param->isArray()) {
                    $args[] = $actionParams[$name] = (array) $params[$name];
                } elseif (!is_array($params[$name])) {
                    $args[] = $actionParams[$name] = $params[$name];
                } else {
                    throw new BadRequestHttpException(Yii::t('yii', 'Invalid data received for parameter "{param}".', [
                        'param' => $name,
                    ]));
                }

                unset($params[$name]);
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $actionParams[$name] = $param->getDefaultValue();
            } else {
                $missing[] = $name;
            }
        }

        if (!empty($missing)) {
            throw new BadRequestHttpException(Yii::t('yii', 'Missing required parameters: {params}', [
                'params' => implode(', ', $missing),
            ]));
        }

        return $args;
    }

    public function runWithParams($params)
    {
        $args = $this->bindActionParams($params); //$this->controller->bindActionParams($this, $params);
        Yii::debug('Running action: ' . get_class($this->controller) . '@' . $this->id, __METHOD__);
        if (Yii::$app->requestedParams === null) {
            Yii::$app->requestedParams = $args;
        }

        return call_user_func_array($this->callback, $args);
    }
}
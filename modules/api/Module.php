<?php

namespace app\modules\api;

/**
 * Class Module
 * @package app\modules\api
 */
class Module extends \yii\base\Module
{

    /** @inheritDoc */
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }

}
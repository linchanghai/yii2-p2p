<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 6:37 PM
 */

namespace core\system\controllers\backend;


use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;

class SettingController extends Controller
{
    public function actionIndex()
    {
        $setting = Kiwi::getSettingModel();
        if (Yii::$app->getRequest()->getIsPost() && $setting->load(Yii::$app->getRequest()->post())) {
            $setting->save();
        }
        return $this->render('index', ['setting' => $setting]);
    }
}
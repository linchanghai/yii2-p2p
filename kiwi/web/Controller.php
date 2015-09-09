<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\web;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * Class Controller
 * @package kiwi\web
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Controller extends \yii\web\Controller
{
    #region ajax maybe use pjax to replace

//    public function render($view, $params = [])
//    {
//        if (Yii::$app->request->isAjax) {
//            foreach ($params as $param) {
//                if ($param instanceof Model && $param->hasErrors()) {
//                    $errorList = [];
//                    foreach ($param->getErrors() as $attribute => $errors) {
//                        $errorList[] = implode(',', $errors);
//                    }
//                    Yii::$app->session->setFlash('error', implode(';', $errorList));
//                }
//            }
//
//            $jsonData = ['data' => $params];
//            $jsonData = ArrayHelper::merge($jsonData, ['alert' => $this->getAlertData()]);
//
//            return Json::encode($jsonData);
//        } else {
//            return parent::render($view, $params);
//        }
//    }
//
//    public function redirect($url, $statusCode = 302)
//    {
//        if (Yii::$app->request->isAjax) {
//            $jsonData = ['redirect' => Url::to($url, true)];
//            $jsonData = ArrayHelper::merge($jsonData, ['alert' => $this->getAlertData()]);
//            return Json::encode($jsonData);
//        } else {
//            return parent::redirect($url, $statusCode);
//        }
//    }
//
//    public function getAlertData()
//    {
//        $alertData = [];
//        $alertTypes = ['error', 'danger', 'success', 'info', 'warning'];
//        $session = Yii::$app->getSession();
//        $flashes = $session->getAllFlashes();
//        foreach ($flashes as $type => $data) {
//            if (in_array($type, $alertTypes)) {
//                $alertData[$type] = (array)$data;
//                $session->removeFlash($type);
//            }
//        }
//        return $alertData;
//    }

    #endregion ajax
} 
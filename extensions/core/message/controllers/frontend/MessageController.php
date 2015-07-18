<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/7/18
 * @Time 16:06
 */
namespace core\message\controllers\frontend;

use core\message\models\Message;
use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;

class MessageController extends Controller{
        public function actionMyMessage(){
            $dataProvider = new ActiveDataProvider([
                'query' => Message::find()->andWhere(['to'=>Yii::$app->user->id]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
            $models = $dataProvider->getModels();
            return $this->render('myMessage', [
                'models' => $models,
            ]);
        }
} 
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
use yii\helpers\Json;
use yii\helpers\Url;

class MessageController extends Controller
{
    public function actionMyMessage()
    {
        $this->layout = '/account';
        $dataProvider = new ActiveDataProvider([
            'query' => Message::find()->andWhere(['to' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $models = $dataProvider->getModels();
        return $this->render('myMessage', [
            'models' => $models,
        ]);
    }

    public function actionChangeStatus()
    {
        $result = [];
        if (is_array(Yii::$app->request->post('messageId'))) {
            foreach (Yii::$app->request->post('messageId') as $id) {
                $model = Kiwi::getMessage()->find()->where(['message_id' => $id, 'to' => Yii::$app->user->id])->one();
                $model->status = 1;
                if (!$model->save()) {
                    var_dump($model->getErrors());exit;
                } else {
                    $result = $id;
                }
            }
        } else {
            $model = Kiwi::getMessage()->find()->where(['message_id' => Yii::$app->request->post('messageId'), 'to' => Yii::$app->user->id])->one();
            $model->status = 1;
            if(!$model->save()){
                var_dump($model->getErrors());exit;
            }

        }
        return Json::encode($result);
    }

    public function actionDelete()
    {
        $result = [];
        if (is_array(Yii::$app->request->post('messageId'))) {
            foreach (Yii::$app->request->post('messageId') as $id) {
                $model = Kiwi::getMessage()->find()->where(['message_id' => $id, 'to' => Yii::$app->user->id])->one();
                if (!$model->delete()) {
                    var_dump($model->getErrors());exit;
                } else {
                    $result = $id;
                }
            }
        } else {
            $model = Kiwi::getMessage()->find()->where(['message_id' => Yii::$app->request->post('messageId'), 'to' => Yii::$app->user->id])->one();
            if(!$model->delete()){
                var_dump($model->getErrors());exit;
            }

        }
        return Json::encode(['redirect'=>Url::to(['/message/message/my-message'])]);
    }
}
<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/7/1
 * @Time 9:49
 */

namespace core\member\controllers\frontend;

use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;

class MemberController extends Controller
{
    public function actionSaveRealName(){
        $model = Kiwi::getUserVerrifyForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->member_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
} 
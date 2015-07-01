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
use yii\helpers\Json;

class MemberController extends Controller
{
    public function actionSaveRealName(){
        $model = Kiwi::getUserVerifyForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('realNameVerify', [
                'model' => $model,
            ]);
        } else {
            return $this->render('realNameVerify', [
                'model' => $model,
            ]);
        }
    }

    public function actionMemberBank(){
        /** @var \core\member\models\MemberBank $model */
        $model = Yii::$app->user->identity->memberBank;
        if(!$model){
            $model = Kiwi::getMemberBank(['member_id'=>Yii::$app->user->id]);
        }

        $area = Kiwi::getArea()->find()->where(['parent_id'=>100000])->all();
        $catList = [];

        foreach($area as $s){
            $catList[$s->area_id] = $s->name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('memberBank', [
                'model' => $model,
                'catList' => $catList,
            ]);
        } else {
            return $this->render('memberBank', [
                'model' => $model,
                'catList' => $catList,
            ]);
        }
    }

    /**
     * get cities list
     */
    public function actionGetCities() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Kiwi::getArea()->getList($cat_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }



} 
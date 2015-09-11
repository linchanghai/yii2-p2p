<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/8/6
 * @Time 10:16
 */
namespace core\cms\controllers\frontend;

use core\cms\models\CmsMedia;
use yii\data\Pagination;

class CmsController extends \kiwi\web\Controller{
    public $layout='/cms';
    public function actionAbout(){
        $cmsAbout = \kiwi\Kiwi::getCmsAbout()->find()->where(['type'=>1])->one();
        if($cmsAbout){
            return $this->render('about',[
                'model'=>$cmsAbout
            ]);
        }
    }

    public function actionTeam(){
        $cmsAbout = \kiwi\Kiwi::getCmsAbout()->find()->where(['type'=>2])->limit(3)->all();
            return $this->render('team',[
                'models'=>$cmsAbout
            ]);

    }
    public function actionExperts(){
        $cmsAbout = \kiwi\Kiwi::getCmsAbout()->find()->where(['type'=>3])->limit(3)->all();
        return $this->render('experts',[
            'models'=>$cmsAbout
        ]);

    }
    public function actionLawOffice(){
        $cmsAbout = \kiwi\Kiwi::getCmsAbout()->find()->where(['type'=>4])->one();
        if($cmsAbout){
            return $this->render('lawOffice',[
                'model'=>$cmsAbout
            ]);
        }
    }

    public function actionLaw(){
        $lawModels = \kiwi\Kiwi::getCmsLaw()->find()->where([])->limit(4)->all();

            return $this->render('law',[
                'models'=>$lawModels
            ]);

    }
    public function actionMediaList(){
        $query = CmsMedia::find()->addOrderBy('create_time DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>10]);
        $cmsMediaModels = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('mediaList', [
            'models' => $cmsMediaModels,
            'pages' => $pages,
        ]);
    }

    public function actionMedia($id){
        $media = \kiwi\Kiwi::getCmsMedia()->findOne($id);
        if($media){
            return $this->render('cms',[
                'model'=>$media
            ]);
        }else{
            throw new \yii\web\NotFoundHttpException('页面不存在');
        }
    }

    public function actionContact(){

            return $this->render('contact');

    }
    public function actionPartnerList(){

    }

    public function actionEmploy(){
        $lawModels = \kiwi\Kiwi::getCmsRecruitment()->find()->where([])->limit(4)->all();

        return $this->render('employ',[
            'models'=>$lawModels
        ]);

    }

} 
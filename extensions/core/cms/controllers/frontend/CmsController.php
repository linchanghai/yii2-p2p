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
    public function actionAbout($title){
        $cmsAbout = \kiwi\Kiwi::getCmsAbout()->findOne(['title'=>trim($title)]);
        if($cmsAbout){
            return $this->render('cms',[
                'model'=>$cmsAbout
            ]);
        }else{
            throw new \yii\web\NotFoundHttpException('页面不存在');
        }
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


} 
<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/27/2015
 * @Time 8:56 PM
 */

namespace kiwi\widgets;

use Yii;
use yii\helpers\ArrayHelper;

class FileUploadAction 
{
    public $options;

    public function init()
    {
        $defaultOptions =  [
            'upload_url' => Yii::$app->params['imageDomain'] . 'temp/',
            'upload_dir' => Yii::getAlias(Yii::$app->params['imagePath'] . 'temp/'),
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
        ];
        $this->options = ArrayHelper::merge($defaultOptions, $this->options);
    }

    public function  run()
    {
        error_reporting(E_ALL | E_STRICT);
        $file = '@vendor/blueimp/jquery-file-upload/server/php/UploadHandler.php';
        include(Yii::getAlias($file));
        $upload_handler = new UploadHandler($this->options);
    }
}
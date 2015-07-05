<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/27/2015
 * @Time 9:07 PM
 */

namespace kiwi\widgets;


use dosamigos\fileupload\FileUploadAsset;
use yii\base\InvalidConfigException;
use yii\widgets\InputWidget;

class FileUploadWidget extends InputWidget
{
    public $dirName;

    public $imageWidth=150;

    public $imageHeight=100;

    public $url;

    public $hasDelete = true;

    public $showName;

    public $hasAdd = true;

    public $multiple = 1;

    public $thumbnailClass = 'col-xs-6 col-md-2';

    public $inputs = [];

    public function run()
    {
        FileUploadAsset::register($this->getView());

        if (!$this->url) {
            throw new InvalidConfigException('url must be set');
        }
        if (is_array($this->url)) {
            $this->url = Url::to($this->url);
        }
        $width= '';
        $style = 'style="';
        if ($this->imageHeight) {
            if($this->imageHeight>141){
                $this->imageHeight=140;
            }
            $style .= ' height: ' . $this->imageHeight . 'px;';
        }
        if ($this->imageWidth) {
            if($this->imageWidth>190){
                $this->imageWidth=189;
            }
            $left=190-$this->imageWidth;
            $width= ' width: ' . $this->imageWidth . 'px;margin-left:'.$left.'px;';
            $style .= ' width: ' . $this->imageWidth . 'px;';
        }
        $style .= '"';
        $deleteButton = '';
        if ($this->hasDelete) {
            $deleteButton = '<p><div class="btn btn-danger btn-sm delete" >删除</div></p>';
        }

        $fileName = $this->showName ? '<h3>\' + file.old_name + \'</h3>' : '';

        $model = $this->model;
        $attribute = $this->attribute;
        $inputId = strtolower($model->formName());

        $inputHtml = '';
        foreach ($this->inputs as $name => $label) {
            $inputHtml .= <<<EOF
<div style="margin-top:3px"><div class="col-md-3"><span style="white-space:nowrap">{$label}:</span></div><div class="col-md-9"><input type="text" class="form-control" name="{$model->formName()}[{$attribute}]['+file.name+'][{$name}]" value=""/></div><div class="clearfix"></div></div>
EOF;
        }


        $js = <<<EOF
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    $('#{$attribute}-files').on('click', '.delete', function() {
        $(this).parents('.file-thumbnail').remove();
    });
    $('#{$attribute}-fileupload').fileupload({
        url: '{$this->url}',
        formData: [
            {
                name: '_csrf',
                value: $('input[name=_csrf]').val()
            }
        ],
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                var img = '';
                if(!file.error){
                if (file.type == "application/msword") {
                    img = '<img {$style} src="../../images/word.png" />';
                }
                else if (file.type == "application/vnd.ms-powerpoint") {
                    img = '<img {$style} src="../../images/ppt.png" />';
                }
                else if (file.type == "application/vnd.ms-excel") {
                    img = '<img {$style} src="../../images/excel.png" />';
                } else if (file.type.indexOf('image') == -1) {
                    img = '<img {$style} src="../../images/other.png" />';
                }
                else {
                    img = '<img {$style} src="' + file.url + '" />';
                }
                var content = '<div class="caption" style="text-align: center">{$fileName}{$inputHtml}{$deleteButton}</div>'+
                '<input type="hidden" name="{$model->formName()}[{$attribute}]['+file.name+'][url]" value="'+file.name+'"/>' +
                '<input type="hidden" name="{$model->formName()}[{$attribute}]['+file.name+'][name]" value="'+file.old_name+'"/>';
                var html = '<div class="file-thumbnail {$this->thumbnailClass}">' +
                    '<a href="#" class="thumbnail" style="{$width}">' +
                    img +
                    '</a>' + content + '</div>';
              var is_multiple={$this->multiple};
              if(is_multiple==0){
               $('#{$attribute}-files').html(html);
                }else{
                $('#{$attribute}-files').append(html);
                }
                }else{
                 $('#{$attribute}-files').html('<div style="color:red">'+file.error+'</div>');
                }
            });
        },
        progressall: function (e, data) {
            var progress_bar = $('#progress .progress-bar');
            progress_bar.removeClass('hidden');
            var progress = parseInt(data.loaded / data.total * 100, 10);
            progress_bar.css(
                'width',
                progress + '%'
            );
            if (progress == 100) {
                progress_bar.css(
                    'width',
                    0 + '%'
                );
                progress_bar.addClass('hidden');
            }
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
EOF;
        $this->view->registerJs($js);
        return $this->render('fileupload', ['dirName'=>$this->dirName,'widget' => $this, 'multiple' => $this->multiple, 'model' => $this->model, 'attribute' => $this->attribute]);
    }
}
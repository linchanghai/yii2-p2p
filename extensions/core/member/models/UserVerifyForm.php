<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/6/27
 * @Time 15:56
 */

namespace core\member\models;


use kiwi\base\Model;
use Yii;
class UserVerifyForm extends Model
{
    public $real_name;
    public $id_card;

    public function rules()
    {
        return [
            ['id_card', 'integer'],
            ['real_name', 'string'],
            ['id_card', 'verifyIdCard'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'real_name' => Yii::t('core_member', 'Real Name'),
            'id_card' => Yii::t('core_member', 'Id Card'),
        ];
    }

    public function verifyIdCard($attribute, $params)
    {
        $len = strlen($this->$attribute);
        if ($len == 18) {
            return (bool)preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/", $this->$attribute);
        }
        if ($len == 15) {
            return (bool)preg_match("/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/", $this->$attribute);
        }
        return false;
    }

} 
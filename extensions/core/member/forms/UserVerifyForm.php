<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/6/27
 * @Time 15:56
 */

namespace core\member\forms;


use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;

class UserVerifyForm extends Model
{
    public $real_name;
    public $id_card;
    public $isNewRecord;

    public function rules()
    {
        return [
            [['id_card', 'real_name'], 'required'],
            ['real_name', 'string'],
            ['id_card', 'validation_filter_id_card'],
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


    public function init()
    {
        /** @var  $memberModel \core\member\models\Member */
        $memberModel = Yii::$app->user->identity;
        if ($memberModel->real_name && $memberModel->id_card) {
            $this->isNewRecord = false;
        } else {
            $this->isNewRecord = true;
        }
    }

    public function save()
    {
        if ($this->validate()) {
            /** @var  $memberModel \core\member\models\Member */
            $memberModel = Yii::$app->user->identity;
            if ($this->isNewRecord) {
                $memberModel->real_name = $this->real_name;
                $memberModel->id_card = $this->id_card;
                if($memberModel->save()){
                    $memberStatusModel = Kiwi::getMemberStatus()->findOne(['member_id' => Yii::$app->user->id]);
                    $memberStatusModel->id_card_status = 1;
                    return  $memberStatusModel->save();
                }
            }
        }
        return false;

    }

    function validation_filter_id_card($attribute, $params)
    {
        if (strlen($this->$attribute) == 18) {
            if (!$this->idcard_checksum18($this->$attribute)) {
                $this->addError($attribute, Yii::t('core_member', 'wrong id card number'));
            }
        } elseif ((strlen($this->$attribute) == 15)) {
            $id_card = $this->idcard_15to18($this->$attribute);
            if (!$this->idcard_checksum18($id_card)) {
                $this->addError($attribute, Yii::t('core_member', 'wrong id card number'));
            }
        } else {
            $this->addError($attribute, Yii::t('core_member', 'wrong id card number'));
        }
    }

    // 计算身份证校验码，根据国家标准GB 11643-1999
    function idcard_verify_number($idcard_base)
    {
        if (strlen($idcard_base) != 17) {
            return false;
        }
        //加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码对应值
        $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        $checksum = 0;
        for ($i = 0; $i < strlen($idcard_base); $i++) {
            $checksum += substr($idcard_base, $i, 1) * $factor[$i];
        }
        $mod = $checksum % 11;
        $verify_number = $verify_number_list[$mod];
        return $verify_number;
    }

    // 将15位身份证升级到18位
    function idcard_15to18($idcard)
    {
        if (strlen($idcard) != 15) {
            return false;
        } else {
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false) {
                $idcard = substr($idcard, 0, 6) . '18' . substr($idcard, 6, 9);
            } else {
                $idcard = substr($idcard, 0, 6) . '19' . substr($idcard, 6, 9);
            }
        }
        $idcard = $idcard . $this->idcard_verify_number($idcard);
        return $idcard;
    }

    // 18位身份证校验码有效性检查
    function idcard_checksum18($idcard)
    {
        if (strlen($idcard) != 18) {
            return false;
        }
        $idcard_base = substr($idcard, 0, 17);
//        var_dump($this->idcard_verify_number($idcard_base));exit;
        if ($this->idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))) {
            return false;
        } else {
            return true;
        }
    }

} 
<?php

namespace p2p\activity\models;

use core\member\models\Member;
use kiwi\behaviors\RecordBehavior;
use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%member_sign_record}}".
 *
 * @property integer $member_sign_record_id
 * @property integer $member_id
 * @property int $days
 * @property integer $ponit
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class MemberSignRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_sign_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'days', 'ponit'], 'required'],
            [['member_id', 'ponit', 'create_time', 'is_delete','days'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_sign_record_id' => Yii::t('p2p_activity', 'Member Sign Record ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'days' => Yii::t('p2p_activity', 'Target Date'),
            'ponit' => Yii::t('p2p_activity', 'Ponit'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
    }

    public function validateSign(){
        $model = $this->find()->orderBy(['create_time'=> SORT_DESC])->one();
        if($model){
            if(strtotime(date('Y-m-d'))>$model->create_time&& strtotime(date('Y-m-d',strtotime('-1 day')))<=$model->create_time){
                return false;
            }
        }
        return true;
    }

    public function memberSign(){
        $model = $this->find()->orderBy(['create_time'=> SORT_DESC])->one();
        if($model){
            if(strtotime(date('Y-m-d',strtotime('-1 day')))>$model->create_time&& strtotime(date('Y-m-d',strtotime('-2 day')))<=$model->create_time){
                $this->days = $model->days+1;
            }
        }else{
            $this->days = 1;
        }
        $this->member_id = Yii::$app->user->id;
        $this->ponit = $this->getSignPoint($this->days);
        if($this->save()){
            return true;
        }else{
            return false;
        }
    }

    public function getSignPoint($date){
        $rule = [
            '1'=> 10,
            '2'=> 20,
            '3'=> 30,
            '4'=> 40,
            '5'=> 50,
        ];
        if(isset($rule[$date])){
            return $rule[$date];
        }else{
            return end($rule);
        }
    }
    public function behaviors()
    {
        $changeRecordClass = Kiwi::getStatisticChangeRecordClass();
        return [
            'updatePoint' => [
                'class' => RecordBehavior::className(),
                'targetClass' => 'core\member\models\StatisticChangeRecord',
                'attributes' => [
                    'member_id'=> 'member_id',
                    'type' => $changeRecordClass::TYPE_EXCHANGE_POINT,
                    'value' => 'ponit',
                ],
            ],
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => false,
            ],
        ];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/22
 * Time: 11:30
 */

namespace p2p\project\forms;

use Yii;
use kiwi\base\Model;

class ProjectInvestForm extends Model
{
    public $money;
    public $project_id;
    public $bonus_id;
    public $couponCash_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money','project_id'], 'required'],
            [['bonus_id', 'couponCash_id'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'money' => Yii::t('p2p_project', 'Money'),
            'project_id' => Yii::t('p2p_project', 'Project'),
            'bonus_id' => Yii::t('p2p_project', 'Bonus'),
            'couponCash_id' => Yii::t('p2p_project', 'CouponCash'),
        ];
    }

    public function invest()
    {
        if($this->validate()) {
            return true;
        }
    }
}
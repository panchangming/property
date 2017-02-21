<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_day_count".
 *
 * @property string $day
 * @property integer $count
 */
class GoodsDayCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_day_count';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['day'], 'safe'],
            [['count'], 'required'],
            [['count'], 'integer'],
            [['day'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'day' => 'Day',
            'count' => 'Count',
        ];
    }

    public function getDayCount() {
        $day   = date('Ymd');
        $model = $this->findOne($day);
        if ($model) {
            $model->count ++;
        } else {
            $model        = $this;
            $model->day   = $day;
            $model->count = 1;
        }
        $model->save();
        return $model->count;
    }

}

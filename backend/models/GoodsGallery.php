<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_gallery".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property string $path
 */
class GoodsGallery extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'goods_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['goods_id'], 'integer'],
                [['path'], 'required'],
                [['path'], 'string', 'max' => 255],
                ['path', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1 * 1024 * 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'       => 'ID',
            'goods_id' => '商品id',
            'path'     => '相册',
        ];
    }

    public function addAll($data, $goods_id) {
        $ids = array();
        foreach ($data as $path) {
            $this->isNewRecord = true;
            $this->goods_id    = $goods_id;
            $this->path        = $path;
            $this->save() && array_push($ids, $this->id) && $this->id          = null;
        }
        return $ids;
    }

}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $goods_status
 * @property integer $sort
 * @property integer $inputtime
 */
class Goods extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name', 'goods_category_id', 'brand_id', 'market_price', 'shop_price', 'stock'], 'required'],
                [['goods_category_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'sort', 'inputtime'], 'integer'],
                [['market_price', 'shop_price'], 'number'],
                [['name'], 'string', 'max' => 20],
                [['logo'], 'string', 'max' => 255],
            ['goods_status','safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'                => 'ID',
            'name'              => '商品名称',
            'sn'                => '货号',
            'logo'              => '缩略图',
            'goods_category_id' => '商品分类',
            'brand_id'          => '品牌',
            'market_price'      => '市场价',
            'shop_price'        => '商城价',
            'stock'             => '库存',
            'is_on_sale'        => '是否在售',
            'status'            => '状态',
            'sort'              => '排序',
            'goods_status'              => '促销类型',
            'inputtime'         => '创建时间',
        ];
    }

    /**
     * beforeSave会在save方法之前自动执行
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)){
            if ($insert) {
                //生成货号
                $goodsDayCount = new GoodsDayCount();
                $count         = $goodsDayCount->getDayCount();
                $this->sn      = date('Ymd') . str_pad($count, 5, '0', STR_PAD_LEFT);
                $this->inputtime = time();
            }
            if($this->goods_status){
                $this->goods_status = array_sum($this->goods_status);
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * 通过id获取商品信息，并且将商品促销类型转换成数组。
     * @param $id 商品id。
     * @return static 商品对象。
     */
    public static function getGoodsInfo($id)
    {
        $info = self::findOne($id);
        $goods_status = [];
        if($info->goods_status & 1){
            array_push($goods_status,1);
        }
        if($info->goods_status & 2){
            array_push($goods_status,2);
        }
        if($info->goods_status & 4){
            array_push($goods_status,4);
        }
        $info->goods_status = $goods_status;
        return $info;
    }


}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170306_065317_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'member_id'=>$this->integer(30)->notNull(),
            'name'=>$this->string(200)->notNull()->comment('收货人'),
            'province_name'=>$this->string(200)->notNull()->comment('省名'),
            'city_name'=>$this->string(200)->notNull()->comment('市名'),
            'area_name'=>$this->string(200)->notNull()->comment('县名'),
            'detail_address'=>$this->string(200)->comment('详细地址'),
            'tel'=>$this->integer(40),
             'delivery_id'=>$this->integer(40),
             'delivery_name'=>$this->string(200),
             'delivery_price'=>$this->string(200),
             'pay_type_id'=>$this->integer(50)->comment('支付方式'),
             'pay_type_name'=>$this->integer(50)->comment('支付方式名字'),
            'price'=>$this->string(200)->comment('商品金额'),
            'status'=>$this->integer(20)->comment('订单状态'),
            'trade_no'=>$this->integer(20)->comment('第三方支付平台'),
            'create_time'=>$this->integer(20)->comment('添加时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}

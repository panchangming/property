<?php

use yii\db\Migration;

class m170223_074712_alter_goods_table extends Migration
{
    public function up()
    {
        //添加促销类型字段
        return $this->addColumn('goods','goods_status','int unsigned comment "1新品 2热销 4精品"');
    }

    public function down()
    {
        $this->dropColumn('goods','goods_status');
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m170220_061210_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string(20)->notNull(),
            'sn'                => $this->string(20)->notNull()->unique(),
            'logo'              => $this->string()->notNull(),
            'goods_category_id' => $this->integer()->unsigned()->notNull(),
            'brand_id'          => $this->integer()->unsigned()->notNull(),
            'market_price'      => $this->decimal(10, 2)->notNull(),
            'shop_price'        => $this->decimal(10, 2)->notNull(),
            'stock'             => $this->integer()->unsigned()->notNull(),
            'is_on_sale'        => $this->smallInteger()->notNull()->unsigned()->defaultValue(1)->comment('1在售  0下架'),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1)->comment('1正常 0回收站'),
            'sort'              => $this->integer()->unsigned()->comment('排序'),
            'inputtime'         => $this->integer()->unsigned()
        ]);

        $this->createTable('goods_intro', [
            'goods_id' => $this->primaryKey(),
            'content'  => $this->text(),
        ]);

        $this->createTable('goods_gallery', [
            'id'       => $this->primaryKey(),
            'goods_id' => $this->integer()->unsigned()->comment('商品id'),
            'path'     => $this->string()->notNull()
        ]);

        $this->createTable('goods_day_count', [
            'day'   => $this->primaryKey(),
            'count' => $this->integer()->unsigned()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
        $this->dropTable('goods_intro');
        $this->dropTable('goods_gallery');
        $this->dropTable('goods_day_count');
    }

}

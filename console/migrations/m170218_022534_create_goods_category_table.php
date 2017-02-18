<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m170218_022534_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(20)->notNull(),
            'parent_id'=>$this->integer()->notNull()->unsigned(),
            'intro'=>$this->string(),
            'lft'=>$this->integer()->unsigned(),
            'rght'=>$this->integer()->unsigned(),
            'level'=>$this->smallInteger()->unsigned(),
            'key(parent_id),key(lft,rght)'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}

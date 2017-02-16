<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m170216_071535_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(20)->notNull(),
            'logo'=>$this->string(255)->notNull(),
            'sort'=>$this->integer()->unsigned(),
            'intro'=>$this->string(),
            'status'=>$this->integer()->comment('-1已删除  0隐藏  1正常')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}

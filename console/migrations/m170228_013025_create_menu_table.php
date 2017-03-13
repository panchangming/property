<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m170228_013025_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
             'name'=>$this->string()->notNull(),
             'pid'=>$this->integer()->notNull(),
             'description'=>$this->text(),
            'route'=>$this->string()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}

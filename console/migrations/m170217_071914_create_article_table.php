<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170217_071914_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(20)->notNull(),
            'intro'=>$this->string(),
            'status'=>$this->integer()->comment('0隐藏  1显示'),
            'sort'=>$this->integer()->unsigned(),
            'is_help'=>$this->integer()->unsigned()->comment('1帮助分类  0非帮助分类')
        ]);
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(20)->notNull(),
            'article_category_id'=>$this->integer()->unsigned(),
            'intro'=>$this->string(),
            'status'=>$this->integer()->comment('0隐藏  1显示'),
            'sort'=>$this->integer()->unsigned(),
            'inputtime'=>$this->integer()->unsigned()->comment('创建时间')
        ]);
        $this->createTable('article_detail', [
            'article_id' => $this->integer()->unsigned(),
            'content'=>$this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
        $this->dropTable('article');
        $this->dropTable('article_detail');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m210131_162333_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'articleId' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'date' => $this->date(),
            'userId' => $this->integer(),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-article-user-id',
            'article',
            'userId',
            'user',
            'userId',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }

}
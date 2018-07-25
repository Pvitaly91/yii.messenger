<?php

use yii\db\Migration;

/**
 * Class m180714_161158_users
 */
class m180714_161158_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("user", [
            'id' => $this->primaryKey(),
            'email' => $this->string(24)->notNull()->unique(),
            'username' => $this->string(32)->notNull()->unique(),
            'password' => $this->string(40)->notNull(),
            'online_status' => $this->timestamp(),
            'status' => $this->string(255)
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('user');
     
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180714_161158_users cannot be reverted.\n";

        return false;
    }
    */
}

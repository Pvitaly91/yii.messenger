<?php

use yii\db\Migration;

/**
 * Class m180714_161408_messeges
 */
class m180714_161408_messeges extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
           $this->createTable('message', [
               'id' => $this->primaryKey(),
               'user_id' => $this->integer()->notNull(),
               'destination_id' => $this->integer()->notNull(),
               'message' => $this->text()->notNull(),
               'delivery' => $this->boolean(),
               'seen' => $this->boolean(),
               'time' => $this->dateTime()->notNull()
           ]);
           $this->addForeignKey('fk-messages-user_id', 'message', 'user_id', 'user', 'id', 'CASCADE');
           $this->addForeignKey('fk-messages-destination_id', 'message', 'destination_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-messages-user_id',
            'message'
        );

        $this->dropTable('message');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180714_161408_messeges cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m180714_161345_contact_list
 */
class m180714_161345_contact_list extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contact_list', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'contact_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk-contact_list-user_id', 'contact_list', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {  
        $this->dropForeignKey(
            'fk-contact_list-user_id',
            'contact_list'
        );
        $this->dropTable('contact_list');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180714_161345_contact_list cannot be reverted.\n";

        return false;
    }
    */
}

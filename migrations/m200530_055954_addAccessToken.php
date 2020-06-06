<?php

use yii\db\Migration;

/**
 * Class m200530_055954_addAccessToken
 */
class m200530_055954_addAccessToken extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'accessToken', $this->char(128));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'accessToken');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200530_055954_addAccessToken cannot be reverted.\n";

        return false;
    }
    */
}

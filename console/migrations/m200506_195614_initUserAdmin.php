<?php

use yii\db\Migration;

/**
 * Class m200506_195614_initUserAdmin
 */
class m200506_195614_initUserAdmin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'admin',
            'auth_key' => 'gYNq7bUdtNgBz_MyxdL-GMGuAtGp--HK',
            'password_hash' => '$2y$13$WU7ER2CQVM6Pt8gfjdViL.YpDhd81scYSUkEDRPMTLjMLyr6QtmdK',
            'email' => 'admin@admin.com',
            'status' => 10,
            'created_at' => 1588794575,
            'updated_at' => 1588794575,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['id' => 1]);

        return false;
    }
}

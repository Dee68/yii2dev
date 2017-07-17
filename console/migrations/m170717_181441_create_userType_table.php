<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userType`.
 */
class m170717_181441_create_userType_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('userType', [
            'id' => $this->primaryKey(),
            'user_type_name' => $this->string(),
            'user_type_value' => $this->integer(10),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('userType');
    }
}

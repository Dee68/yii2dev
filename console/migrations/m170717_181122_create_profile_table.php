<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 */
class m170717_181122_create_profile_table extends Migration
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
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'birthdate' => $this->date(),
            'gender_id' => $this->integer(10),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('profile');
    }
}

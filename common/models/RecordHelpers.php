<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

/**
 * Description of RecordHelpers
 *this class checks if a user already has a profile,
 * else suggest the creation of one
 * @author Dimie
 */

use Yii;
class RecordHelpers {
    /*
     * check if profile already exists
     */
    public static function userHas($model_name)
    {
        //connect to database
        $connection = Yii::$app->db;
        //get user id
        $userid = Yii::$app->user->identity->id;
        //create query
        $query = "SELECT id FROM $model_name WHERE user_id = :user_id";
        $command = $connection->createCommand($query);
        //bind parameters
        $command->bindValue(':user_id', $userid);
        //get result of query
        $result = $command->queryOne();
        if($result == NULL){
            return FALSE; 
        }else{
            return $result['id'];
        }
    }
}

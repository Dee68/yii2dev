<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

/**
 * Description of ValueHelpers
 *
 * @author Dimie
 */
class ValueHelpers {
    /*
     * return the value of role name handed in as a string
     * example: 'Admin','Manager','User'
     */
    public static function getRoleValue($role_name)
    {
        //connect to database
        $connection = \Yii::$app->db;
        //create query
        $query = "SELECT role_value FROM role WHERE role_name = :role_name";
        //execute query on database
        $command = $connection->createCommand($query);
        //bind query parameters for safety
        $command->bindValue(':role_name',$role_name);
        //retrieve result
        $result = $command->queryOne();
        return $result['role_value'];
        
    }
    /*
     * return the value of status name handed in as string
     * example:'Active', or 'Pending'
     */
    public static function getSatusValue($status_name)
    {
        //connect to database
        $connection = \Yii::$app->db;
        //create query
        $query = " SELECT status_value FROM status WHERE status_name = :status_name";
        //execute query on database
        $command = $connection->createCommand($query);
        //bind query parameters for safety
        $command->bindValue(':status_name',$status_name);
        //retrieve result and return
        $result = $command->queryOne();
        return $result['status_value'];
    }
    /*
     * return the value of user type handed in as a string
     * example: 'Paid' or 'Free'
     */
    public static function getUserTypeValue($user_type_name)
    {
        //connect to database
        $connection = \Yii::$app->db;
        //create query
        $query = "SELECT user_type_value FROM usertype WHERE user_type_name = :user_type_name";
        //execute query on database
        $command = $connection->createCommand($query);
        //bind query parameters for safety
        $command->bindValue(':user_type_name', $user_type_name);
        //return result of query
        $result = $command->queryOne();
        return $result['user_type_value'];
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

/**
 * Description of PermissionHelpers
 *this class restrict's or grant's access to user in correspondence to 
 * 'staus','role' and 'userType'
 * it also permits user to view only their profiles
 * @author Dimie
 */
use common\models\ValueHelpers;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class PermissionHelpers {
    /*
     * check if user is owner of record
     * e.g :@model_name = 'profile';
     * 
     */
    public static function userMustBeOwner($model_name, $model_id)
    {
        //connect to database
        $connection = Yii::$app->db;
        //get user id;
        $userid = Yii::$app->user->identity->id;
        //create query
        $query = "SELECT id FROM $model_name WHERE user_id = :user_id AND id = :model_id";
        //execute query
        $command = $connection->createCommand($query);
        //bind parameters
        $command->bindValue(':user_id', $userid);
        $command->bindValue(':model_id', $model_id);
        //get result of query
        $result = $command->queryOne();
        if($result){
            return TRUE;
        }  else {
            return FALSE;
        }
                
    }
    /*
     * allows only paid users
     */
    public static function requireUpgradeTo($user_type_name)
    {
        if(Yii::$app->user->identity->user_type_id != ValueHelpers::getUserTypeValue($user_type_name)){
            return Yii::$app->getResponse()->redirect(Url::to(['upgrade/index']));
        }
    }
    /*
     * requires a particular status
     */
    public static function requireStatus($status_name)
    {
        if(Yii::$app->user->identity->status_id == ValueHelpers::getSatusValue($status_name)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    /*
     * requie minimum status
     */
    public static function requireMinimumStatus($status_name)
    {
        if(Yii::$app->user->identity->status_id >= ValueHelpers::getSatusValue($status_name)){
            return TRUE;
        }  else {
            return FALSE;    
        }
    }
    /*
     * require a particular role
     */
    public static function requireRole($role_name)
    {
        if(Yii::$app->user->identity->role_id == ValueHelpers::getRoleValue($role_name)){
            return TRUE; 
        }  else {
            return FALSE;    
        }
    }
    /*
     * require minimum role
     */
    public static function requireMinimumRole($role_name)
    {
        if(Yii::$app->user->identity->role_id >= ValueHelpers::getRoleValue($role_name)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

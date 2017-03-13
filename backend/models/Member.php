<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/5
 * Time: 14:02
 */

namespace backend\models;


use yii\db\ActiveRecord;

class Member extends ActiveRecord
{
    public  function rules(){
        return [
            [['username', 'password', 'tel', 'email'], 'required'],
            [['email'], 'email'],
            ['tel', 'match','pattern'=>'/^1\d{10}$/'],
            [['add_time', 'last_login_time', 'last_login_ip', 'status'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['password', 'email'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 11],
            [['salt'], 'string', 'max' => 6],
            [['token'], 'string', 'max' => 32],
        ];

    }
    public  function  attributeLabels(){
        return[

            'relpassword'=>'确认密码:',
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'tel' => '手机号码',
            'email' => '邮箱',
            'add_time' => '加入时间',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录IP',
            'salt' => '盐',
            'status' => '状态',
            'token' => '令牌',

        ];
    }

}
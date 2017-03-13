<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 9:39
 */

namespace backend\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Menu extends  ActiveRecord
{
    public  function  rules(){
        return[
           [['name','pid'],'required'],
            [['description','img','route'],'safe']
        ] ;
    }
    public  function  attributeLabels(){
        return[
          'name'=>'名称',
           'route'=>'路由',
            'pid'=>'菜单选择',
            'description'=>'描述',
            'img'=>'图标'
        ];
    }
    public static function  getMenu(){
        $zNodes = [['id'=>0,'pid'=>0,'name'=>'顶级目录']];
        $nodes = self::find()->asArray()->all();
        return array_merge($zNodes,$nodes);
    }
    public static  function  getMenuOne(){
        $menuOne=self::findAll(['pid'=>0]);
        return $menuOne;
    }
    public  function  getMenus(){
       // return   $this->hasMany($this->className(),['pid'=>'id']);
        return self::findAll(['pid'=>$this->id]);
    }
    public  function  getMember(){
      $Members=$this->menus;
        foreach($Members as $k=>$Member ){
            if(!\Yii::$app->user->can($Member->route)){
               unset($Members[$k]);
            }
        }
        return $Members;
    }



}
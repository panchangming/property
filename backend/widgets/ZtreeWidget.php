<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 11:33
 */

namespace backend\widgets;


use yii\web\JqueryAsset;
use yii\base\Widget;
use yii\helpers\Json;
use yii\web\view;

class ZtreeWidget extends Widget
{
    public  $Ztree_jsFile='@web/ext/ztree/js/jquery.ztree.core.min.js';
    public  $Ztree_cssFile='@web/ext/ztree/css/zTreeStyle/zTreeStyle.css';
    public  $setting = '{}';
    public  $zNodes = [];
    public  $id;
    public $expandAll=true;
    public $selectNodes=[];
    public  function  init(){
        parent::init();
        if($this->id==null) $this->id = 'Ztree'.uniqid();
    }
    public  function  run(){
        $this->loadCssFile();
        $this->loadJsFile();
        $this->loadJs();
        parent::run();
        return '<div><ul id="'.$this->id.'" class="ztree"></ul></div>';
    }
    public  function  loadJsFile(){
         $this->view->registerJsFile($this->Ztree_jsFile,['depends'=>JqueryAsset::className()]);
    }
    public  function  loadCssFile(){
       $this->view->registerCssFile($this->Ztree_cssFile);
    }
    public  function  loadJS()
    {$this->view->registerJs('var zTreeObj;
        // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
        var setting ='. $this->setting .';
   // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
   var zNodes =' .json::encode($this->zNodes). ';',view::POS_END);
        $this->view->registerJs('zTreeObj = $.fn.zTree.init($("#'.$this->id.'"), setting, zNodes);');
        if($this->expandAll){
            $this->view->registerJs('zTreeObj.expandAll(true);');
        }
        foreach($this->selectNodes as $k=>$v){
            $this->view->registerJs('zTreeObj.selectNode(zTreeObj.getNodesByParam("'.$k.'","'.$v.'",null)[0]);');
        }
    }
}
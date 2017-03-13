<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/17
 * Time: 10:43
 */

namespace backend\controllers;
use xj\uploadify\UploadAction;
use crazyfd\qiniu\Qiniu;
use yii\web\Controller;

class UploadController extends  Controller
{
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => \yii\helpers\Url::base(true).'/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },

                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {

                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {

                    $savePath = $action->getSavePath();
                    $ak = '9dkDwQk86ljQw0W9kFBey0kddrP1XFRzUxEjASCT';
                    $sk = 'IaA_Sgh6GQhWyhBhUBwSWY_dBrd0Hw49IcLKAuEt';
                    $domain = 'http://oli9lrtr4.bkt.clouddn.com/';
                    $bucket = 'panchang';
                    $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
                    $key = $action->getFilename();
                    $qiniu->uploadFile($savePath,$key);
                    $url = $qiniu->getLink($key);
                    //var_dump($action);exit;
                    $action->output['msg'] = $url?'上传成功':'上传失败';
                    $action->output['fileUrl'] =$url ;
                },
            ],
        ];
    }
}
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
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    //使用七牛云存储保存用户上传的图片
                    $savePath = $action->getSavePath();
                    $ak = 'qJHe4wo24q6X6AWSXsv-syl8PkhHjo6i5WXc-to5';
                    $sk = 'KBYoPnqTbgX4a65rXNI9f-6_kCKwwnHMSnLOGLNk';
                    $domain = 'http://olhxdl0ds.bkt.clouddn.com/';
                    $bucket = 'php1107';
                    $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
                    $key = $action->getFilename();
                    $qiniu->uploadFile($savePath,$key);
                    $url = $qiniu->getLink($key);
                    $action->output['msg'] = $url?'上传成功':'上传失败';
//                    $action->output['fileUrl'] = $action->getWebUrl();//四哥许坤:下面跟了另外三种可以替换的信息,根据需要修改.如果想获取更多信息,可以参考下面
//                    $action->output['savePath'] = $action->getSavePath();
                    $action->output['fileUrl'] =$url ;
                },
            ],
        ];
    }
}
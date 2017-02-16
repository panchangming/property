<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/16
 * Time: 14:30
 */

namespace backend\controllers;


use backend\models\Brand;
use yii\web\Controller;
use xj\uploadify\UploadAction;

class BrandController extends Controller
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
                    $action->output['fileUrl'] = $action->getWebUrl();//四哥许坤:下面跟了另外三种可以替换的信息,根据需要修改.如果想获取更多信息,可以参考下面
                },
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        //创建模型对象，并传递给视图
        $model = new Brand();
        //判断是否提交
        if(\Yii::$app->request->isPost){
            //获取数据
            $model->load(\Yii::$app->request->post());
            //验证数据,执行添加
            if($model->save()){
                //跳转
                $this->redirect(['index']);
            }
        }
        return $this->render('add',[
            'model'=>$model,
        ]);
    }

}
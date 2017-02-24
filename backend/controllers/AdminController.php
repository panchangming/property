<?php

/**
 * @link http://blog.kunx.org/.
 * @copyright Copyright (c) 2017-2-21 
 * @license kunx-edu@qq.com.
 */

namespace backend\controllers;
use yii\web\Controller;
use backend\models\RegForm;
use backend\models\LoginForm;
use backend\models\Admin;

/**
 * Description of AdminController
 *
 * @author kunx <kunx-edu@qq.com>
 */
class AdminController extends Controller {
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength'=>3,
                'maxLength'=>3,
            ],
        ];
    }
    /**
     * 添加管理员
     * @return type
     */
    public function actionReg() {
        $model = new RegForm;
        if ($model->load(\Yii::$app->request->post()) && $model->reg()) {
            return $this->redirect(['login']);
        }
        return $this->render('reg', ['model' => $model]);
    }


    /**
     * 管理员登录
     * @return type
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm;

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', ['model' => $model]);
    }

    /**
     * 管理员退出登录
     * @return type
     */
    public function actionLogout() {
        \Yii::$app->user->logout();
        return $this->redirect(['login']);
    }

    /**
     * 删除管理员
     * @param type $id
     */
    public function actionDelete($id) {
        Admin::updateAll(['status' => Admin::STATUS_DELETED], ['id' => $id]);
        return $this->redirect(['login']);
    }

    public function actionIndex() {
        //获取品牌列表
        $list = Admin::find()->all();
        return $this->render('index', [
                    'list' => $list
        ]);
    }

}

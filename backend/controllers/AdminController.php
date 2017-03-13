<?php



namespace backend\controllers;
use backend\models\AccessForm;
use yii\web\Controller;
use backend\models\RegForm;
use backend\models\LoginForm;
use backend\models\Admin;
use yii\web\HttpException;


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
        //获取管理员列表
        $list = Admin::find()->all();
        return $this->render('index', [
                    'list' => $list
        ]);
    }
   public  function  actionAccess($id){
       $admin=Admin::findOne($id);
       if($admin==null){
           throw new HttpException(404,'该用户不存在');
       }
       $model=new AccessForm();
       $model->role=$admin->loadRole();
       if($model->load(\Yii::$app->request->post())&&$model->validate()){
           if($admin->accessRole($model->role)){
               \Yii::$app->session->setFlash('success','权限添加成功');
               return $this->redirect(['index']);
           }

       }
       return $this->render('access',['model'=>$model]);
   }

}

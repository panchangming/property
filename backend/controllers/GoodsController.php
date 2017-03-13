<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\GoodsIntro;
use backend\models\GoodsGallery;
use backend\models\GoodsDayCount;
use backend\models\GoodsSearchForm;
use yii\data\Pagination;
use yii\web\Controller;

class GoodsController extends MembersController
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix" => "http://admin.jx.com",
                ],
            ]
        ];
    }

    /**
     * 创建商品.
     *
     *
     * @return object
     */
    public function actionAdd()
    {
        $goodsModel = new Goods;
        $goodsIntroModel = new GoodsIntro();
        $goodsGalleryModel = new GoodsGallery();

        if (\Yii::$app->request->isPost) {
            //开启事务
            $t = \Yii::$app->db->beginTransaction();

            $goodsModel->load(\Yii::$app->request->post());
            $goodsIntroModel->load(\Yii::$app->request->post());


            //保存基本信息
            $flag = $goodsModel->save();

            //保存详细信息
            $goodsIntroModel->goods_id = $goodsModel->id;
            $flag = $flag && $goodsIntroModel->add();

            //保存商品相册
            $pathes = \Yii::$app->request->post('path');
            if ($pathes) {
                $flag = $flag && $goodsGalleryModel->addAll($pathes, $goodsModel->id);
            }
            if ($flag) {
                $t->commit();
            } else {
                $t->rollBack();
            }

            return $this->redirect(['index']);
        }

        return $this->render('add', [
            'goodsModel' => $goodsModel,
            'goodsIntroModel' => $goodsIntroModel,
            'goodsGalleryModel' => $goodsGalleryModel,
        ]);
    }

    public function actionDelete($id)
    {
        Goods::updateAll(['status' => 0], ['id' => $id]);
        return $this->redirect(['index']);
    }

    public function actionEdit($id)
    {
        $goodsModel = Goods::getGoodsInfo($id);
        $goodsIntroModel = GoodsIntro::find()->where(['goods_id' => $id])->one();
        $goodsGalleryModel = new GoodsGallery();
        $goodsGalleryModels = GoodsGallery::findAll(['goods_id' => $id]);

        if (\Yii::$app->request->isPost) {
            $goodsModel->load(\Yii::$app->request->post());
            $goodsIntroModel->load(\Yii::$app->request->post());


            //保存基本信息
            $goodsModel->save();
            //保存详细信息
            $goodsIntroModel->save();

            //删除历史相册
            $goodsGalleryModel->deleteAll(['goods_id' => $id]);
            //保存商品相册
            $pathes = \Yii::$app->request->post('path');
            if ($pathes) {
                $goodsGalleryModel->addAll($pathes, $goodsModel->id);
            }
            return $this->redirect(['index']);
        }
        return $this->render('add', [
            'goodsModel' => $goodsModel,
            'goodsIntroModel' => $goodsIntroModel,
            'goodsGalleryModel' => $goodsGalleryModel,
            'goodsGalleryModels' => $goodsGalleryModels,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new GoodsSearchForm();

        //获取查询条件
        $searchData = \Yii::$app->request->get($searchModel->formName());
        //给模型赋值
        if ($searchData) {
            foreach ($searchData as $key => $value) {
                $searchModel->$key = $value;
            }
            $searchModel->name;
            $searchModel->minPrice;
            $searchModel->maxPrice;

        }
        $query = Goods::find();
        $data = \Yii::$app->request->get();
        if (!empty($data['GoodsSearchForm']['name'])) {
          $query->andWhere(['like', 'name', $searchModel->name]);


        }
        if (!empty($data['GoodsSearchForm']['minPrice'])) {
            $query->andWhere(['>', 'shop_price', $searchModel->minPrice]);
        }
        if (!empty($data['GoodsSearchForm']['maxPrice'])) {
            $query->andWhere(['<', 'shop_price', $searchModel->maxPrice]);
        }
         $count=$query->count();

        $size = 5;
        $pager = new Pagination(['totalCount' => $count, 'PageSize' => $size]);
        $model = $query->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('index', ['model' => $model, 'searchModel' => $searchModel, 'pager' => $pager]);

    }
    public  function  actionPhoto($id){
        $photo=GoodsGallery::find()->where(['goods_id'=>$id])->select('path')->all();
        //var_dump($photo);exit;
        return $this->render('photo',['photo'=>$photo]);
    }
    public  function  actionShow($id){
        $model=GoodsIntro::findOne(['goods_id'=>$id]);
        //var_dump($model);exit;
        return $this->render('show',['model'=>$model]);
    }
}
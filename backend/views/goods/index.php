<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

    <?php
    $form = ActiveForm::begin([
        'layout' => 'inline',
        'method' => 'get',
        'action'  => Url::to(['index']),
        'options' => [
            'style' => 'margin-bottom:1em'
        ],
    ]);
    echo $form->field($searchModel, 'name')->textInput(['placeholder' => '商品名称']);
    echo $form->field($searchModel, 'minPrice')->textInput(['placeholder' => '最小价格']);
    echo $form->field($searchModel, 'maxPrice')->textInput(['placeholder' => '最大价格']);
    echo Html::submitInput('搜索', ['class' => 'btn btn-primary']);

    ActiveForm::end();

    ?>
    <a href="<?php echo Url::to(['add'])?>" class="btn btn-info">添加商品</a>
    <table class="table table-bordered table-hover">
        <tr>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>货号</th>
            <th>logo</th>
            <th>商品分类名称</th>
            <th>品牌</th>
            <th>市场价格</th>
            <th>本店价格</th>
            <th>库存</th>
            <th>是否上架</th>
            <th>状态</th>
            <th>排序</th>
            <th>录入时间</th>
            <th>操作</th>
        </tr>
        <?php foreach($model as $row): ?>
            <tr>
                <td><?php echo $row['id'] ;?></td>
                <td><?php echo $row['name'] ;?></td>
                <td><?php echo $row['sn'] ;?></td>
                <td><img src="<?php echo $row['logo']?>" style="max-height: 20px;"></td>
                <td><?php echo \backend\models\GoodsCategory::getCategoryOne(['id'=> $row['goods_category_id']]) ;?></td>
                <td><?php echo \backend\models\Brand::getListOne($row['brand_id']) ;?></td>
                <td>￥<?php echo $row['market_price'] ;?></td>
                <td>￥<?php echo $row['shop_price'] ;?></td>
                <td><?php echo $row['stock'] ;?></td>
                <td><?php echo ($row['is_on_sale']==0)?'上架':'下架' ;?></td>
                <td><?php echo ($row['status']==1)?'回收站':'正常' ;?></td>
                <td><?php echo  $row['sort'] ;?></td>
                <td><?php echo date('Y-m-d H:i:s',$row['inputtime']) ;?></td>
                <td>
                    <div class="btn-group">
                    <a href="<?php echo Url::to(['edit','id'=>$row['id']])?>" class="btn btn-success  btn-xs">编辑</a>
                    <a href="<?php echo Url::to(['delete','id'=>$row['id']])?>" class="btn btn-danger btn-xs">删除</a>
                    <a href="<?php echo Url::to(['show','id'=>$row['id']])?>" class="btn btn-info btn-xs">详情</a>
                    <a href="<?php echo Url::to(['photo','id'=>$row['id']])?>" class="btn btn-info btn-xs">相册</a>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

<?php
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager]);

<?php

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="container">
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
    echo Html::a('创建商品', Url::to(['add']), ['class' => 'btn btn-success']);
    ?>


    <br />
    <br />
    <table class="table table-bordered table-hover">
        <tr>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品LOGO</th>
            <th>商品简介</th>
            <th>操作</th>
        </tr>
<?php foreach ($list as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><img src="<?php echo $row['logo']; ?>" style="max-height: 20px;"/></td>
                    <td><?php echo $row['sn']; ?></td>
                    <td><a href="<?php echo Url::to(['edit', 'id' => $row['id']]); ?>">编辑</a>  <a href="<?php echo Url::to(['delete', 'id' => $row['id']]); ?>">删除</a></td>
            </tr>
<?php endforeach; ?>
    </table>
</div>
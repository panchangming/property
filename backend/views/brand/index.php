<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="container">
    <?php echo Html::a('创建品牌',Url::to(['add']),['class'=>'btn btn-success']);?>
    <br />
    <br />
    <table class="table table-bordered table-hover">
        <tr>
            <th>品牌ID</th>
            <th>品牌名称</th>
            <th>品牌LOGO</th>
            <th>品牌简介</th>
            <th>操作</th>
        </tr>
        <tr>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
        </tr>
    </table>
</div>
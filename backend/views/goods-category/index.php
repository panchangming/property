<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="container">
    <a href="<?php echo Url::to(['add'])?>" class="btn btn-success">添加分类</a> <br /><br />

    <table class="table table-hover table-bordered">
        <tr>
            <th>名称</th>
            <th>简介</th>
            <th>操作</th>
        </tr>
        <?php foreach($list as $row):?>
            <tr>
                <td><?php echo str_repeat('&nbsp;',($row['level']-1) * 2). $row['name'];?></td>
                <td><?php echo $row['intro'];?></td>
                <td>
                    <a href="<?php echo Url::to(['edit','id'=>$row['id']]);?>">编辑</a>
                    <a href="<?php echo Url::to(['delete','id'=>$row['id']]);?>">删除</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
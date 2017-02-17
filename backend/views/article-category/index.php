<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

?>
<div class="container">
    <a href="<?php echo Url::to(['add']); ?>" class="btn btn-success">添加分类</a><br /><br />
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>分类状态</th>
            <th>操作</th>
        </tr>
        <?php foreach($list as $row):?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['status']?'显示':'隐藏';?></td>
            <td><a href="<?php echo Url::to(['edit','id'=>$row['id']]);?>">编辑</a>  <a href="<?php echo Url::to(['delete','id'=>$row['id']]);?>">删除</a></td>
        </tr>
        <?php endforeach;?>
    </table>
    <?php
    echo \yii\widgets\LinkPager::widget([
        'pagination'=>$pages
    ]);
    ?>
</div>

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
        <?php foreach($list as $row):?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['name'];?></td>
            <td><img src="<?php echo $row['logo'];?>" style="max-height: 20px;"/></td>
            <td><?php echo $row['intro'];?></td>
            <td><a href="<?php echo Url::to(['edit','id'=>$row['id']]);?>">编辑</a>  <a href="<?php echo Url::to(['delete','id'=>$row['id']]);?>">删除</a></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
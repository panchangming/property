<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

?>
<div class="container">
    <a href="<?php echo Url::to(['add']); ?>" class="btn btn-success">添加文章</a><br /><br />
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>简介</th>
            <th>分类</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        <?php foreach($list as $row):?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['intro'];?></td>
            <td><?php echo \backend\models\ArticleCategory::getArticleCategoryById($row['article_category_id']);?></td>
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

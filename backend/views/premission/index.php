<div class="container">
    <table class="table table-bordered table-hover">
        <caption>
            <?=\yii\bootstrap\Html::a('添加',['premission/add'],['class'=>'btn btn-info'])?>
        </caption>
        <tr>
            <th>名称</th>
            <th>简介</th>
            <th>操作</th>
        </tr>
        <?php foreach($allPermission as $row): ?>
            <tr>
                <td><?=$row->name?></td>
                <td><?=$row->description?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('删除',['premission/delete'],['class'=>'btn btn-danger'])?>
                    <?=\yii\bootstrap\Html::a('修改',['premission/edit','name'=>$row->name],['class'=>'btn btn-info'])?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager]);
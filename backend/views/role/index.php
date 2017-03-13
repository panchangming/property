<table class="table table-bordered table-hover">
    <caption>
        <?=\yii\bootstrap\Html::a('添加',['role/add'],['class'=>'btn btn-success'])?>
    </caption>
    <tr>
        <th>角色名</th>
        <th>角色简介</th>
        <th>操作</th>
    </tr>
    <?php foreach($roles as $row): ?>
        <tr>
            <td><?=$row->name?></td>
            <td><?=$row->description?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['role/edit','name'=>$row->name],['class'=>'btn btn-info btn-xs'])?>
                <?=\yii\bootstrap\Html::a('删除',['role/delete','name'=>$row->name],['class'=>'btn btn-danger btn-xs'])?>
            </td>
        </tr>
    <?php endforeach;?>

</table>

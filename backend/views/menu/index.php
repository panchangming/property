<table class="table table-bordered table-hover">
    <caption>
        <?=\yii\bootstrap\Html::a('添加',['menu/add'],['class'=>'btn btn-success'])?>
    </caption>
    <tr>
        <th>名称</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
    <?php foreach($menu as $row):?>
        <tr>
            <td><?=$row->name?></td>
            <td><?=$row->description?></td>
            <td> <?=\yii\bootstrap\Html::a('修改',['menu/edit','id'=>$row['id']],['class'=>'btn btn-success'])?>
                <?=\yii\bootstrap\Html::a('删除',['menu/delete','id'=>$row['id']],['class'=>'btn btn-danger'])?>
            </td>
        </tr>

    <?php foreach($row->menus as $child):?>
        <tr>
            <td>&nbsp;----<?=$child->name?></td>
            <td><?=$child->description?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['menu/edit','id'=>$child['id']],['class'=>'btn btn-success'])?>
                <?=\yii\bootstrap\Html::a('删除',['menu/delete','id'=>$child['id']],['class'=>'btn btn-danger'])?>

            </td>
        </tr>
    <?php endforeach;?>
    <?php endforeach;?>
</table>
<div class="container">
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>手机号码</th>
            <th>邮箱</th>
            <th>加入时间</th>
            <th>最后登录时间</th>
            <th>最后登录IP</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        <?php  foreach($member as $row):?>
            <tr>
                <td><?=$row->id?></td>
                <td><?=$row->username?></td>
                <td><?=$row->tel?></td>
                <td><?=$row->email?></td>
                <td><?=$row->add_time?></td>
                <td><?=$row->last_login_time?></td>
                <td><?=$row->last_login_ip?></td>
                <td><?=$row->status?></td>
                <td>
                    <?=\yii\helpers\Html::a('修改',['member/edit','id'=>$row->id])?>
                    <?=\yii\helpers\Html::a('删除',['member/delete','id'=>$row->id])?>
                </td>
            </tr>
        <?php endforeach;?>

    </table>
    </div>

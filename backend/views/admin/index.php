<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="container">
    <?php echo Html::a('创建管理员账号', Url::to(['reg']), ['class' => 'btn btn-success']); ?>
    <br />
    <br />
    <table class="table table-bordered table-hover">
        <tr>
            <th>用户名</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>注册时间</th>
            <th>操作</th>
        </tr>
        <?php foreach($list as $row):?>
        <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['status'] ? '正常' : '禁止登陆' ?></td>
                <td><?php echo date('Y-m-d H:i:s', $row['created_at']); ?></td>
                <td><a href="<?php echo Url::to(['delete', 'id' => $row['id']]); ?>" class='btn btn-danger btn-xs'>删除</a>
                    <a href="<?php echo Url::to(['access', 'id' => $row['id']]); ?>" class='btn btn-warning btn-xs'>授权</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
<?php

use\yii\helpers\Html;
?>
<?php foreach($photo as $ph):?>
    <?=Html::img($ph->path)?>
<?php endforeach;?>

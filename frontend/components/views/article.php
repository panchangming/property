<div class="bottomnav w1210 bc mt10">
    <?php $i=0;foreach($articleCategories as $category):?>
    <div class="bnav<?php echo ++$i;?>">
        <h3><b></b> <em><?php echo $category['name'];?></em></h3>
        <ul>
            <?php foreach($articleList[$category->id] as $article):?>
                <li><a href=""><?php echo $article['name'];?></a></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php  endforeach;?>

</div>
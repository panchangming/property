<?php
use yii\helpers\Url;
?>
<div class="category fl <?php echo $isIndex ?'':'cat1'?>"> <!-- 非首页，需要添加cat1类 -->
            <div class="cat_hd <?php echo $isIndex?'':'off'?>">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                <h2>全部商品分类</h2>
                <em></em>
            </div>
            <div class="cat_bd <?php echo $isIndex?'':'none'?>">
                <?php
                foreach($goodsCategories as $top):
                    if($top['level']==1):
                        ?>

                        <div class="cat">
                            <h3><a href="<?php echo Url::to(['goods/list','id'=>$top['id']]);?>"><?php echo $top['name']; ?></a><b></b></h3>
                            <div class="cat_detail">
                                <?php
                                foreach($goodsCategories as $sec):
                                    if($sec['parent_id'] == $top['id']):
                                        ?>
                                        <dl class="dl_1st">
                                            <dt><a href="<?php echo Url::to(['goods/list','id'=>$top['id']]);?>"><?php echo $sec['name'];?></a></dt>
                                            <dd>
                                                <?php
                                                foreach($goodsCategories as $thd):
                                                    if($thd['parent_id'] == $sec['id']):
                                                        ?>
                                                        <a href="<?php echo Url::to(['goods/list','id'=>$thd['id']]);?>"><?php echo $thd['name'];?></a>
                                                        <?php
                                                    endif;
                                                endforeach;
                                                ?>
                                            </dd>
                                        </dl>
                                        <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <?php
                    endif;
                endforeach;
                ?>

</div>

</div>
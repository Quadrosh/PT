<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<?php if ($model['status']== 'premium') : ?>
    <div class="masterListItem premium">
        <div class="row">
                <div class="col-sm-2">
                    <div class="imageBox">
                        <?= Html::img('/img/th-list-'.$model['image'],['class'=>'masterListAvatar']) ?>
                    </div>
                </div>
                <div class="col-sm-10 listDataBox">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="masterName"><?= Html::encode($model['username']) ?></p>

<!--                            --><?php //if (isset($model->pros)) : ?>
<!--                                --><?php //foreach ($model->pros as $profession) : ?>
<!--                                    <p class="masterProfession">--><?//= Html::encode($profession['name']) ?><!--</p>-->
<!--                                --><?php //endforeach; ?>
<!--                            --><?php //endif; ?>


                            <?php if (isset($model->pros)) : ?>
                                <?php $count = 0?>
                               <p class="masterProfession">
                                <?php foreach ($model->pros as $profession) : ?>
                                    <?php if (!$count == count($model->pros)) : ?>
                                        <span class=" <?php if($count==0){echo' capital';} else {echo ' lowercase';} ?>"><?= Html::encode($profession['name']) ?><?php if(count($model->pros)>1){echo', ';}  ?></span>

                                    <?php else : ?>
                                        <span class=" lowercase"><?= Html::encode($profession['name']) ?></span>
                                    <?php endif; ?>
                                    <?php $count++?>
                                <?php endforeach; ?>
                               </p>
                            <?php endif; ?>






                            <?php if (isset($model->btns)) : ?>
                                <?php foreach ($model->btns as $btn) : ?>
                                    <?= Html::a($btn['name'], '/master/'.$model['hrurl'].$btn['link'],['class'=>'btn btn-xs masterBtn']) ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                        <div class="col-sm-6">

                            <?php if (isset($model->psys)) : ?>
                                <?php foreach ($model->psys as $psy) : ?>
                                    <p class="masterPsychotherapy"><?= Html::encode($psy['name']) ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="masterAddress"><?= Html::encode($model['address']) ?>
                                <span class="masterPhone"><span class="glyphicon glyphicon-earphone phone_icon"></span><?= Html::encode($model['phone']) ?><?php if ($model->sites) : ?>, <span class="glyphicon glyphicon-share-alt site_icon"></span>
                                        <?php foreach ($model->sites as $site) : ?>
                                            <?= Html::a($site['name'],$site['link']) ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?></p>
                        </div>
                        <div class="col-sm-8">
                            <div class="disease">
                                <?php if (isset($model->mtexts)) : ?>
                                    <?php foreach ($model->mtexts as $mtext) : ?>
                                        <?= Html::a($mtext['list_name'],'/master/'.$model['hrurl'].'/'.$mtext['hrurl'],['class'=>'btn btn-xs masterBtn']) ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <p class="masterListAdd"><?= Html::encode($model['list_add']) ?></p>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

<?php endif; ?>

<?php if ($model['status']== 'regular') : ?>
    <div class="masterListItem regular">
        <div class="row">
            <div class="col-sm-6">
                <p class="masterName"><?= Html::encode($model['username']) ?></p>
            </div>
            <div class="col-sm-6 text-right">
                <?php if (isset($model->psys)) : ?>
                    <?php $count = count($model->psys)?>
                    <?php foreach ($model->psys as $psy) : ?>
                        <span class="masterPsychotherapy"><?= Html::encode($psy['name']) ?><?php if(--$count>0){echo' <span class="circle"></span> ';} ?></span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-2">
                <?php if (isset($model->pros)) : ?>
                    <?php $count = 0?>
                    <?php foreach ($model->pros as $profession) : ?>
                        <?php if (!$count == count($model->pros)) : ?>
                            <span class="masterProfession <?php if($count==0){echo' capital';} else{echo ' lowercase';} ?>"><?= Html::encode($profession['name']) ?><?php if(count($model->pros)>1){echo', ';}  ?></span>

                        <?php else : ?>
                            <span class="masterProfession lowercase"><?= Html::encode($profession['name']) ?></span>
                        <?php endif; ?>
                        <?php $count++?>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="col-sm-10 listDataBox">
                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6 text-right">



                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="masterAddress"><?= Html::encode($model['address']) ?>
                            <span class="masterPhone"><span class="glyphicon glyphicon-earphone phone_icon"></span><?= Html::encode($model['phone']) ?><?php if ($model->sites) : ?>, <span class="glyphicon glyphicon-share-alt site_icon"></span>
                                <?php foreach ($model->sites as $site) : ?>
                                    <span><?= Html::a($site['name'],$site['link']) ?> </span>
                                <?php endforeach; ?>
                            <?php endif; ?></span></p>
                    </div>
                    <div class="col-sm-8">
                        <div class="disease">
                            <?php $count = count($model->tags)?>
                            <?php if (isset($model->tags)) : ?>
                                <?php foreach ($model->tags as $tag) : ?>
                                    <span><?= $tag['name'] ?><?php if(--$count>0){echo', ';} ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <p class="masterListAdd"><?= Html::encode($model['list_add']) ?></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

<?php endif; ?>
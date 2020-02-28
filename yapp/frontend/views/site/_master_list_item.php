<?php

use common\models\Imagefiles;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<?php if ($model['status']== 'premium') : ?>
    <div class="masterListItem premium">
        <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-1">

                    <div class="imageBox">
                        <a href="/master/<?= $model['hrurl'] ?>" class="link2master">

                            <?=  Html::img('/img/view/'
                                . Imagefiles::TERM_CUT_OVERFLOW
                                . Imagefiles::SIZE_240_240
                                . $model->imagefile['name'],
                                [
                                    'class' => 'img',
                                    'alt' => $model['image_alt'],
                                    'style'=>'width:120px;'
                                ]) ;?>
                        </a>
                    </div>

                </div>
                <div class="col-sm-11 col-md-11 col-lg-11 listDataBox">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <p class="masterName"><?= Html::encode($model['username']) ?></p>


                            <?php if (isset($model->pros)) : ?>
                                <?php $count = 1?>
                               <p class="masterProfession">
                                   <?php foreach ($model->pros as $pro) {
                                       if ($count != count($model->pros)) {
                                           echo '<span class="';
                                           echo $count==1 ?' capital':' lowercase';
                                           echo '">'.$pro['name'].'</span>';
                                           echo count($model->pros)>1 ? ', ':'';
                                       } else {
                                           echo '<span class="';
                                           echo $count==1 ?' capital':' lowercase';
                                           echo '">'.$pro['name'].'</span>';
                                       }
                                       $count++;
                                   } ?>
                               </p>
                            <?php endif; ?>

                            <div class="less768">
                                <?php if (isset($model->psys)) : ?>
                                    <?php $count = 1?>
                                    <p class="masterPsychotherapy ">
                                        <?php foreach ($model->psys as $psy) {
                                            if ($count != count($model->psys)) {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$psy['name'].'</span>';
                                                echo count($model->psys)>1 ? ', ':'';
                                            } else {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$psy['name'].'</span>';
                                            }
                                            $count++;
                                        } ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div class="more768">
                                <?php if (isset($model->btns)) : ?>
                                    <?php foreach ($model->btns as $btn) : ?>
                                        <?= Html::a($btn['name'], $model->root?'/'.$model->root.$btn['link']:'/master/'.$model['hrurl'].$btn['link'],['class'=>'btn btn-xs masterBtn']) ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="col-sm-6 col-xs-12 more768">
                            <?php if (isset($model->psys)) : ?>
                                <?php $count = 1?>
                                <p class="masterPsychotherapy ">
                                    <?php foreach ($model->psys as $psy) {
                                        if ($count != count($model->psys)) {
                                            echo '<span class="';
                                            echo $count==1 ?' capital':' lowercase';
                                            echo '">'.$psy['name'].'</span>';
                                            echo count($model->psys)>1 ? ', ':'';
                                        } else {
                                            echo '<span class="';
                                            echo $count==1 ?' capital':' lowercase';
                                            echo '">'.$psy['name'].'</span>';
                                        }
                                        $count++;
                                    } ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="city">
                                <i class="masterAddressIcon fa fa-globe" aria-hidden="true"></i><?php
                                if(isset($model->cities)){
                                    $cities='';
                                    $i = 0;
                                    foreach ($model->cities as $city) {
                                        if ($i == 0) {
                                            $cities.=$city['name'];
                                        } else {
                                            $cities.=', '.$city['name'];
                                        }
                                        $i++;
                                    }
                                    echo $cities;
                                }
                                ?>
                            </p>
                            <p class="masterAddress"><?= nl2br($model['address']) ?>
                                <span class="masterPhone"><i class="phone_icon fa fa-phone" aria-hidden="true"></i><?= Html::encode($model['phone']) ?>
                                    <?php if ($model['other_contacts']) : ?>
                                        <?php echo ', '.$model['other_contacts'] ?>
                                    <?php endif; ?>
                                    <?php if ($model->sites) : ?>, <span class="glyphicon glyphicon-share-alt site_icon"></span>
                                        <?php foreach ($model->sites as $site) : ?>
                                            <?= Html::a($site['name'],$site['link'],['rel' => 'nofollow']) ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?></p>
                        </div>
                        <div class="col-sm-8">
                            <div class="disease">
                                <?php if (isset($model->mtexts) AND $model->mtexts!=null) : ?>
                                    <h6 class="taglabel">заметки:</h6>
                                    <?php $count = 1?>

                                    <?php
                                    foreach ($model->mtexts as $mtext) {
                                        echo  Html::a($mtext['list_name'],'/master/'.$model['hrurl'].'/'.$mtext['hrurl'],[
                                            'class'=>$count==1 ?'masterMText ':'masterMText ',
                                            'style'=> 'padding-right: 0;'
                                        ]);
                                        if ($count != count($model->mtexts)) {
                                            echo count($model->mtexts)>1 ? ', ':'';
                                        }
                                        $count++;
                                    }

                                        ?>


                                <?php endif; ?>


                                <?php if (isset($model->tags)) : ?>
                                    <?php $count = count($model->tags)?>
                                    <h6 class="taglabel">метки:</h6>
                                    <p class="lowercase">
                                        <?php foreach ($model->tags as $tag) : ?>
                                            <span><?= $tag['name'] ?><?php if(--$count>0){echo', ';} ?></span>
                                        <?php endforeach; ?>
                                    </p>
                                <?php endif; ?>

                                <p class="masterListAdd"><?= Html::encode($model['list_add']) ?></p>
                            </div>
                            <div class="sessionTypes">
                                <?php if (isset($model->sessionAssighs)) : ?>
                                    <?php $count = 1?>
                                    <p class="sessionsInfo">
                                        <?php foreach ($model->sessionAssighs as $session) {
                                            if ($count != count($model->sessionAssighs)) {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$session->sessionType['name'].'</span> - '.$session['value'].$session['comment'];
                                                echo count($model->sessionAssighs)>1 ? ', ':'';
                                            } else {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$session->sessionType['name'].'</span> - '.$session['value'].$session['comment'];
                                            }
                                            $count++;
                                        } ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xs-12 text-center less768">
                            <?php if (isset($model->btns)) : ?>
                                <?php foreach ($model->btns as $btn) : ?>
                                    <?= Html::a($btn['name'], '/master/'.$model['hrurl'].$btn['link'],['class'=>'btn btn-xs masterBtn']) ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<?php endif; ?>



<!-- regular -->
<?php if ($model['status']== 'regular') : ?>
    <?php if ($model['image']!= null) : ?>
        <!--    с фото -->
        <div class="masterListItem premium">
            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-1">

                    <div class="imageBox">
                        <a href="/master/<?= $model['hrurl'] ?>" class="link2master">
                            <?=  Html::img('/img/view/'
                                . Imagefiles::TERM_CUT_OVERFLOW
                                . Imagefiles::SIZE_240_240
                                . $model->imagefile['name'],
                                [
                                    'class' => 'img',
                                    'alt' => $model['image_alt'],
                                    'style'=>'width:120px;'
                                ]) ;?>
                        </a>
                    </div>

                </div>
                <div class="col-sm-11 col-md-11 col-lg-11 listDataBox">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <p class="masterName"><?= Html::encode($model['username']) ?></p>


                            <?php if (isset($model->pros)) : ?>
                                <?php $count = 1?>
                                <p class="masterProfession">
                                    <?php foreach ($model->pros as $pro) {
                                        if ($count != count($model->pros)) {
                                            echo '<span class="';
                                            echo $count==1 ?' capital':' lowercase';
                                            echo '">'.$pro['name'].'</span>';
                                            echo count($model->pros)>1 ? ', ':'';
                                        } else {
                                            echo '<span class="';
                                            echo $count==1 ?' capital':' lowercase';
                                            echo '">'.$pro['name'].'</span>';
                                        }
                                        $count++;
                                    } ?>
                                </p>
                            <?php endif; ?>

                            <div class="less768">
                                <?php if (isset($model->psys)) : ?>
                                    <?php $count = 1?>
                                    <p class="masterPsychotherapy ">
                                        <?php foreach ($model->psys as $psy) {
                                            if ($count != count($model->psys)) {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$psy['name'].'</span>';
                                                echo count($model->psys)>1 ? ', ':'';
                                            } else {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$psy['name'].'</span>';
                                            }
                                            $count++;
                                        } ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div class="more768">
                                <?php if (isset($model->btns)) : ?>
                                    <?php foreach ($model->btns as $btn) : ?>
                                        <?= Html::a($btn['name'], '/master/'.$model['hrurl'].$btn['link'],['class'=>'btn btn-xs masterBtn']) ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="col-sm-6 col-xs-12 more768">
                            <?php if (isset($model->psys)) : ?>
                                <?php $count = 1?>
                                <p class="masterPsychotherapy ">
                                    <?php foreach ($model->psys as $psy) {
                                        if ($count != count($model->psys)) {
                                            echo '<span class="';
                                            echo $count==1 ?' capital':' lowercase';
                                            echo '">'.$psy['name'].'</span>';
                                            echo count($model->psys)>1 ? ', ':'';
                                        } else {
                                            echo '<span class="';
                                            echo $count==1 ?' capital':' lowercase';
                                            echo '">'.$psy['name'].'</span>';
                                        }
                                        $count++;
                                    } ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="city">
                                <i class="masterAddressIcon fa fa-globe" aria-hidden="true"></i><?php
                                if(isset($model->cities)){
                                    $cities='';
                                    $i = 0;
                                    foreach ($model->cities as $city) {
                                        if ($i == 0) {
                                            $cities.=$city['name'];
                                        } else {
                                            $cities.=', '.$city['name'];
                                        }
                                        $i++;
                                    }
                                    echo $cities;
                                }
                                ?>
                            </p>
                            <p class="masterAddress"><?= nl2br($model['address']) ?>
                                <span class="masterPhone"><i class="phone_icon fa fa-phone" aria-hidden="true"></i><?= Html::encode($model['phone']) ?>
                                    <?php if ($model['other_contacts']) : ?>
                                        <?php echo ', '.$model['other_contacts'] ?>
                                    <?php endif; ?>
                                    <?php if ($model->sites) : ?>, <span class="glyphicon glyphicon-share-alt site_icon"></span>
                                    <?php foreach ($model->sites as $site) : ?>
                                    <?= Html::a($site['name'],$site['link'],['rel' => 'nofollow']) ?></span>
                            <?php endforeach; ?>
                            <?php endif; ?></p>
                        </div>
                        <div class="col-sm-8">
                            <div class="disease">
                                <?php $count = count($model->tags)?>
                                <?php if (isset($model->tags)) : ?>
                                    <h6 class="taglabel">метки:</h6>
                                    <p class="lowercase">
                                        <?php foreach ($model->tags as $tag) : ?>
                                            <span><?= $tag['name'] ?><?php if(--$count>0){echo', ';} ?></span>
                                        <?php endforeach; ?>
                                    </p>
                                <?php endif; ?>

                                <p class="masterListAdd"><?= Html::encode($model['list_add']) ?></p>
                            </div>
                            <div class="sessionTypes">
                                <?php if (isset($model->sessionAssighs)) : ?>
                                    <?php $count = 1?>
                                    <p class="sessionsInfo">
                                        <?php foreach ($model->sessionAssighs as $session) {
                                            if ($count != count($model->sessionAssighs)) {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$session->sessionType['name'].'</span> - '.$session['value'].$session['comment'];
                                                echo count($model->sessionAssighs)>1 ? ', ':'';
                                            } else {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$session->sessionType['name'].'</span> - '.$session['value'].$session['comment'];
                                            }
                                            $count++;
                                        } ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xs-12 text-center less768">
                            <?php if (isset($model->btns)) : ?>
                                <?php foreach ($model->btns as $btn) : ?>
                                    <?= Html::a($btn['name'], '/master/'.$model['hrurl'].$btn['link'],['class'=>'btn btn-xs masterBtn']) ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<!--    без фото -->
    <?php if ($model['image']== null) : ?>
        <div class="masterListItem regular">
            <div class="row">
                <div class="col-sm-6">
                    <p class="masterName"><?= Html::encode($model['username']) ?></p>
                </div>
                <div class="col-sm-6 text-right more768">
                    <?php if (isset($model->psys)) : ?>
                        <?php $count = 1?>
                        <p class="masterPsychotherapy ">
                            <?php foreach ($model->psys as $psy) {
                                if ($count != count($model->psys)) {
                                    echo '<span class="';
                                    echo $count==1 ?' capital':' lowercase';
                                    echo '">'.$psy['name'].'</span>';
                                    echo count($model->psys)>1 ? ', ':'';
                                } else {
                                    echo '<span class="';
                                    echo $count==1 ?' capital':' lowercase';
                                    echo '">'.$psy['name'].'</span>';
                                }
                                $count++;
                            } ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-1">
                <?php if (isset($model->pros)) : ?>
                    <?php $count = 1?>
                    <p class="masterProfession">
                        <?php foreach ($model->pros as $pro) {
                            if ($count != count($model->pros)) {
                                echo '<span class="';
                                echo $count==1 ?' capital':' lowercase';
                                echo '">'.$pro['name'].'</span>';
                                echo count($model->pros)>1 ? ', ':'';
                            } else {
                                echo '<span class="';
                                echo $count==1 ?' capital':' lowercase';
                                echo '">'.$pro['name'].'</span>';
                            }
                            $count++;
                        } ?>
                    </p>
                <?php endif; ?>

                <div class="less768">
                    <?php if (isset($model->psys)) : ?>
                        <?php $count = 1?>
                        <p class="masterPsychotherapy">
                            <?php foreach ($model->psys as $psy) {
                                if ($count != count($model->psys)) {
                                    echo '<span class="';
                                    echo $count==1 ?' capital':' lowercase';
                                    echo '">'.$psy['name'].'</span>';
                                    echo count($model->psys)>1 ? ', ':'';
                                } else {
                                    echo '<span class="';
                                    echo $count==1 ?' capital':' lowercase';
                                    echo '">'.$psy['name'].'</span>';
                                }
                                $count++;
                            } ?>
                        </p>
                    <?php endif; ?>
                </div>

            </div>
                <div class="col-sm-11 listDataBox">
                    <div class="row">
                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-6 text-right">



                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="city">
                                <i class="masterAddressIcon fa fa-globe" aria-hidden="true"></i><?php
                                if(isset($model->cities)){
                                    $cities='';
                                    $i = 0;
                                    foreach ($model->cities as $city) {
                                        if ($i == 0) {
                                            $cities.=$city['name'];
                                        } else {
                                            $cities.=', '.$city['name'];
                                        }
                                        $i++;
                                    }
                                    echo $cities;
                                }
                                ?>
                            </p>
                            <p class="masterAddress"><?= nl2br($model['address']) ?>
                                <span class="masterPhone"><i class="phone_icon fa fa-phone" aria-hidden="true"></i><?= Html::encode($model['phone']) ?>
                                    <?php if ($model['other_contacts']) : ?>
                                        <?php echo ', '.$model['other_contacts'] ?>
                                    <?php endif; ?>
                                    <?php if ($model->sites) : ?>, <span class="glyphicon glyphicon-share-alt site_icon"></span>
                                    <?php foreach ($model->sites as $site) : ?>
                                        <span><?= Html::a($site['name'],$site['link'],['rel' => 'nofollow']) ?> </span>
                                    <?php endforeach; ?>
                                <?php endif; ?></span></p>
                        </div>
                        <div class="col-sm-8">
                            <div class="disease">
                                <?php $count = count($model->tags)?>
                                <?php if (isset($model->tags)) : ?>
                                    <h6 class="taglabel">метки:</h6>
                                <p class="lowercase">
                                    <?php foreach ($model->tags as $tag) : ?>
                                            <span><?= $tag['name'] ?><?php if(--$count>0){echo', ';} ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </p>
                                <p class="masterListAdd"><?= Html::encode($model['list_add']) ?></p>
                            </div>
                            <div class="sessionTypes">
                                <?php if (isset($model->sessionAssighs)) : ?>
                                    <?php $count = 1?>
                                    <p class="sessionsInfo">
                                        <?php foreach ($model->sessionAssighs as $session) {
                                            if ($count != count($model->sessionAssighs)) {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$session->sessionType['name'].'</span> - '.$session['value'].$session['comment'];
                                                echo count($model->sessionAssighs)>1 ? ', ':'';
                                            } else {
                                                echo '<span class="';
                                                echo $count==1 ?' capital':' lowercase';
                                                echo '">'.$session->sessionType['name'].'</span> - '.$session['value'].$session['comment'];
                                            }
                                            $count++;
                                        } ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    <?php endif; ?>
<?php endif; ?>
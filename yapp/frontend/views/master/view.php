<?php
use \yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
$feedback = new \common\models\Feedback;

?>
<div class="<?= $master['stylekey'] ?>">
    <div class="row ">
        <div class="col-xs-12 less480">
            <div class="masterImageBox">
                <a href="/master/<?= $master['hrurl'] ?>">
                    <?= cl_image_tag($master->imagefile['cloudname'], [
                        "alt" => $master['image_alt'],
                        "width" => 167,
                        "height" => 180,
                        "crop" => "fill",
                        "gravity" => "face"
                    ]); ?>
                </a>
            </div>
        </div>
        <div class="col-xs-3 col-sm-4 more480">
            <div class="masterImageBox">
                <a href="/master/<?= $master['hrurl'] ?>">
                    <?= cl_image_tag($master->imagefile['cloudname'], [
                        "alt" => $master['image_alt'],
                        "width" => 167,
                        "height" => 180,
                        "crop" => "fill",
                        "gravity" => "face"
                    ]); ?>
                </a>
            </div>
        </div>
        <div class="col-xs-9 col-sm-8">
            <h1 class="masterPageUsername"><?= $master['username'] ?></h1>

            <?php if (isset($masterData['professions'])) : ?>
                <?php $count = 1?>
                <p class="masterProfession">
                    <?php foreach ($masterData['professions'] as $profession) {
                        if ($count != count($masterData['professions'])) {
                            echo '<span class="';
                            echo $count==1 ?' capital':' lowercase';
                            echo '">'.$profession['name'].'</span>';
                            echo count($masterData['professions'])>1 ? ', ':'';
                        } else {
                            echo '<span class=" lowercase">'.$profession['name'].'</span>';
                        }
                        $count++;
                    } ?>
                </p>
            <?php endif; ?>


            <div class="divider"></div>


            <?php if (isset($masterData['psys'])) : ?>
                <?php $psyCount = 1?>
                <p class="masterPsychotherapy">
                    <?php foreach ($masterData['psys'] as $psychotherapyType) : ?>
                    <?php if ($psyCount != count($masterData['psys'])) {
                           echo '<span class="';
                            echo $psyCount==1 ?' capital':' lowercase';
                            echo '">'.$psychotherapyType['name'].'</span>';
                            echo count($masterData['psys'])>1 ? ', ':'';
                        } else {
                            echo '<span class=" lowercase">'.$psychotherapyType['name'].'</span>';
                        }
                        $psyCount++;
                        ?>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>


        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <ul class="links">
                <?php foreach ($masterPages as $masterPage) : ?>
                    <li><?=  Html::a( $masterPage['list_name'], '/master/'.$master['hrurl'].'/'.$masterPage['hrurl'],
                            ['class'=>'pjax_btn']);
                        ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-sm-8 noPaddingLess480">
            <div id="contentBox" class="contentBox">



                <?php Pjax::begin([
                    'id' => 'masterArticleText',
                    'timeout' => 2000,
                    'enablePushState' => false,
                ]); ?>

                <?php if ($article!=null) : ?>
<!--   Записаться     -->
                    <?php if($article=='go') : ?>

                        <?= $this->render('_order', [
                            'master' => $master,
                            'feedback' => $feedback,
                        ]) ?>

                    <?php endif; ?>
<!--   отзывы -->
                    <?php if($article=='otziv') : ?>
                        <p>Отзывы</p>
                    <?php endif; ?>
<!--   текст мастера -->
                    <?php if($article!='otziv' && $article!='go') : ?>
                        <h2 class="articleName"><?= nl2br($article['pagehead'])?></h2>
                        <p><?= nl2br($article['text'])?></p>
                    <?php endif; ?>
                <?php endif; ?>
<!--   hello -->
                <?php if($article==null) : ?>
                    <p><?= nl2br($master['hello']) ?></p>
                <?php endif; ?>

                <?php Pjax::end(); ?>
            </div>
<!--    footer -->
            <div class="masterFooter text-center">
                <div class="button">
                    <?=  Html::a( 'Записаться', '/master/'.$master['hrurl'].'/go',
                        ['class'=>'pjax_btn btn-default']); ?>
                </div>
                <div class="button">
                    <?=  Html::a( 'Отзывы', '/master/'.$master['hrurl'].'/otziv',
                        ['class'=>'pjax_btn btn-link']); ?>
                </div>

                <p class="address"><?= nl2br($master['address']) ?></p>
            </div>
        </div>
    </div>
</div>

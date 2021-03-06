<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use yiister\gentelella\widgets\Panel;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString('Manage {modelClass}', ['modelClass' => Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))]) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <?="<?php "?>
        Panel::begin(
        [
        'header' => Html::encode($this->title),
        'icon' => 'users',
        ]
        )
        <?=" ?> "?>



        <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">


            <?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>

            <div class="container">
                <div class="box-header with-border">
                    <div class="pull-left">
                        <?= "<?= " ?>Html::a(<?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-success btn-flat']) ?>
                    </div>
                </div>
            </div>

            <?php if ($generator->indexWidgetType === 'grid'): ?>
                <?= "<?= " ?>\yiister\gentelella\widgets\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'hover' => true,
                <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
                //['class' => 'yii\grid\SerialColumn'],

                <?php
                $count = 0;
                if (($tableSchema = $generator->getTableSchema()) === false) {
                    foreach ($generator->getColumnNames() as $name) {
                        if (++$count < 6) {
                            echo "            '" . $name . "',\n";
                        } else {
                            echo "            // '" . $name . "',\n";
                        }
                    }
                } else {
                    foreach ($tableSchema->columns as $column) {
                        $format = $generator->generateColumnFormat($column);
                        if (++$count < 6) {
                            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        } else {
                            echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                }
                ?>

                [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '70'],
                'template' => '{view} {update} {delete} {link}',
                ],
                ],
                ]); ?>
            <?php else: ?>
                <?= "<?= " ?>ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                },
                ]) ?>
            <?php endif; ?>

            <?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>


        </div>


        <?= "<?php " ?>Panel::end()<?= " ?> " ?>

    </div>
</div>




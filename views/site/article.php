<?php

/** @var yii\web\View $this */
/** @var stdClass $article */


$this->title = "Запись - {$article->name}";
?>
<div class="site-index">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1><?= $article->name ?></h1>
                <article><?= $article->body ?></article>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
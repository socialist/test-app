<?php

/** @var yii\web\View $this */
/** @var stdClass $category */
/** @var mysqli $db */


$this->title = "Категория - {$category->name}";
$result = $db->query("SELECT `key`, `name`, `body`, `status` FROM `articles` WHERE `category_id`={$category->id}");
?>
<div class="site-index">
    <div class="container">
        <div class="row">
        <div class="col-md-9">
<?php if ($result->num_rows == 0) { ?>
    <p>Здесь ничего нет</p>
<?php } else { ?>
<ul>
<?php while (list($key, $name, $body, $status) = $result->fetch_row()) { ?>
    <li><a href="<?php echo \yii\helpers\Url::to(array('site/article', 'key' => $key)) ?>"><?php echo $name ?></a></li>
<?php } ?>
</ul>
<?php } ?>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
</div>

<?php

namespace app\controllers;

use mysqli;
use services\TagsService;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    public $db = null;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->db = new mysqli('localhost', 'root', '', 'test_app');
        $this->db->set_charset('utf8');
        return parent::beforeAction($action);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $rows = [];
        $sql = "SELECT * FROM `articles_categories`";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $rows[] = $row;
            }
        }
        return $this->render('index', compact('rows'));
    }

    /**
     * @param $key
     * @return string
     */
    public function actionCategory($key)
    {
        $category = $this->db->query("SELECT * FROM `articles_categories` WHERE `key`='{$key}'")->fetch_object();
        return $this->render('category', ['category' => $category, 'db' => $this->db]);
    }

    /**
     * @param $key
     * @return string
     */
    public function actionArticle($key)
    {
        $article = $this->db->query("SELECT * FROM `articles` WHERE `key`='{$key}'")->fetch_object();
        return $this->render('article', compact('article'));
    }

    /**
     * @param $key
     * @return string
     */
    public function actionTag($key)
    {
        //TODO: Нужно вывести записи по тегe ($key)
        $tags = (new TagsService())->getArticles(1);
        $tag = $this->db->query("SELECT * FROM `tags` WHERE `key`='{$key}'")->fetch_object();
        return $this->render('tag', compact('tag'));
    }
}

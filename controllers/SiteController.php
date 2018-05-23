<?php

namespace app\controllers;

use yii\web\Controller;
use app\repositories\ClickRepository;
use app\repositories\interfaces\iClickRepository;

class SiteController extends Controller
{

	/** @var  iClickRepository */
	protected $clickRepository;

	public function init()
	{
		parent::init();
		$this->clickRepository = new ClickRepository(\Yii::$app->getDb());
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
	    return $this->render('index');
    }

}

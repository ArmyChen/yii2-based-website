<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Request;
use frontend\models\StockSearchForm;

/**
 * User controller
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
     * @return mixed
     */
    public function actionIndex()
    {
        
      //$user = Yii::$app->db->createCommand('SELECT * FROM user WHERE id=1')->queryOne();
        return $this->render('index');
    }

      /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionStock()
    {
         $model = new StockSearchForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
 
              return $this->render('stock', [
                'model' => $model,
                'stock' => $model->search(),
            ]);
        } else {
            return $this->render('stock', [
                'model' => $model,
            ]);
        }

      //$user = Yii::$app->db->createCommand('SELECT * FROM user WHERE id=1')->queryOne();
      
    }
}
    
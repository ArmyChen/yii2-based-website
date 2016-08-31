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
		
		
		
		
		
		
		//$		user = Yii::$app->db->createCommand('SELECT * FROM user WHERE id=1')->queryOne();
		
		
		
		
		
		
		return $this->render('index');
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
     * Displays homepage.
     *
     * @return mixed
     */
	
	
	
	
	
	
	public function actionSearch()
	{
		
		
		
		
		
		
		$model = new StockSearchForm();
		
		
		
		
		
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			
			
			
			
			
			
			
			return $this->render('search', [
			'model' => $model,
			'search' => $model->search(),
			]);
			
			
			
			
			
			
		}
		
		
		
		
		
		else {
			
			
			
			
			
			
			return $this->render('search', [
			'model' => $model,
			'search' => '',
			]);
			
			
			
			
			
			
		}
		
		
		
		
		
		
		
		//$		user = Yii::$app->db->createCommand('SELECT * FROM user WHERE id=1')->queryOne();
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	public function actionSave(){
		
		
		
		
		
		
		if (Yii::$app->request->isAjax) {
			
			
			
			
			
			
			$data = Yii::$app->request->get();
			
			
			
			
			
			
			// 			$sql = 'insert into stock(user_id,stock_id,stock_name) values ('.Yii::$app->user->id.',\''.$data['code'].'\',\''.$data['name'].'\')';
			
			
			
			
			
			
			$user = Yii::$app->db->createCommand()->insert('stock', array(  
			'user_id' => Yii::$app->user->id,  
			'stock_id' => $data['code'],  
			'stock_name' => $data['name'],  
			))->execute();
			
			
			
			echo "保存成功";
			
			
			
		}
		
		
		
	}
	
	
	
	
	public function actionMy()
	{
		
		
		
		$model = Yii::$app->db->createCommand("select * from stock where user_id=".Yii::$app->user->id)->queryAll();
		
		
		
		return $this->render('my', [
		'model' => $model,
		]);
		
		
		
	}
	
	public function actionAjax()
	{
		
		
		
		$model = Yii::$app->db->createCommand("select * from stock where user_id=".Yii::$app->user->id)->queryAll();
        $rec_data = array();
		foreach ($model as $key => $value) {
          $rec_data[] = $this->search($value['stock_id']);
        
        }
        
        echo json_encode($rec_data);die;
	}

    public function search($code){

         $header = array(
            'Content-Type: application/json;charset=utf-8',
            'apikey : 7131db2a9e5dcfa0004a617465af9452',
        );

        $url = 'http://apis.baidu.com/apistore/stockservice/stock?stockid='. $code;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        curl_setopt($curl, CURLOPT_HEADER, 0);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($curl);

        curl_close($curl);

        return json_decode($data);
    }
	
}







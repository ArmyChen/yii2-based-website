<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class StockSearchForm extends Model
{
    public $code;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['code', 'required'],
           
        ];
    }

    public function search(){

         $header = array(
            'Content-Type: application/json;charset=utf-8',
            'apikey : 7131db2a9e5dcfa0004a617465af9452',
        );

        $url = 'http://apis.baidu.com/apistore/stockservice/stock?stockid='. $this->code;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        curl_setopt($curl, CURLOPT_HEADER, 0);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($curl);

        curl_close($curl);

        return $data;
    }

    
}

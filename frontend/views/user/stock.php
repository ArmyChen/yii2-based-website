<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '我的股票';


?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>提示!</strong> 点击搜索进行股票查询 ...
</div>

<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'stock-search']); ?>

            <?= $form->field($model, 'code')->label("请输入股票代码")->textInput(['autofocus' => true,'placeholder'=>"请输入股票代码"]) ?>

            <div class="form-group">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary', 'name' => 'stock-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>


<div class="container">

    <?php 
if(!empty($stock)){
    ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        
        <?
            $stock_array = json_decode($stock);
            echo $stock_array['curprice'];
        ?>
    </div>
    <?
    
}
?>
</div>



<hr>
<table class="table table-bordered table-hover">
<caption>我的股票</caption> 
   <thead>
      <tr>
         <th>名称</th>
         <th>代码</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
      
   </tbody>
</table>



<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '搜索';


?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>提示!</strong> 点击搜索进行股票查询 ... 
    <br/>
    <span class="label label-danger">注意，上证添加sh，深成添加sz，例如：力帆股份（sh601777）</span>
    
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


<div class="">

    <?php 
if(!empty($search)){
    ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        
        <?
            $stock_array = json_decode($search);
            $rec_data = $stock_array->retData;
            $stockinfo = $rec_data->stockinfo;
           // var_dump($stockinfo);
            
        ?>
        
        <label for="input-id" class="col-sm-2">股票：<span id="name"><?echo $stockinfo->name;?></span> </label>
        <label for="input-id" class="col-sm-2">代码：<span id="code"><?echo $stockinfo->code;?> </span></label>
        <label for="input-id" class="col-sm-3">昨：<?echo $stockinfo->closingPrice;?> 开：<?echo $stockinfo->OpenningPrice;?> 现：<?echo $stockinfo->currentPrice;?></label>
        <?
            $increaseClass = "label label-default";
      
            $increase =  sprintf("%.2f",$stockinfo->currentPrice - $stockinfo->OpenningPrice);
            $percent = 0;
            if($stockinfo->OpenningPrice != 0){
                $percent = ($increase / $stockinfo->OpenningPrice ) * 100;
                $percent = sprintf("%.2f",$percent);
                 if($increase > 0){
                    $increaseClass = "label label-danger";
                }else if($increase == 0){
                    $increaseClass = "label label-default";
                }else{
                    $increaseClass = "label label-success";
                }
            }else{
                $increase = 0;
            }
        ?>

        <label for="input-id" class="col-sm-2">涨幅：<span class="<?echo $increaseClass?>"><?echo $increase?> <span/> </label>
        <label for="input-id" class="col-sm-2">百分比 <span class="<?echo $increaseClass?>"><?echo $percent?>% <span/></label>
       
        <input type="button" value="喜欢" id="fav" class="btn btn-success "/>
    </div>
    <?
    
}
?>
</div>


<?php
$this->registerJs(
   '$("document").ready(function(){ 
       $("#fav").click(function(){
           $.ajax({
               url:"/frontend/web/index.php?r=user%2Fsave",
               type:"get",
               data: {"code": $.trim($("#code").html()),"name": $.trim($("#name").html())},
               success:function(e){
                   alert(e);
               }
           });
       });
    });'
);
?>

<?php





/* @var $this yii\web\View */




use yii\helpers\Html;




$this->title = '我的股票';






?>

<div class="panel panel-info">
      <div class="panel-heading">
            <h3 class="panel-title">自选股</h3>
      </div>
      <div class="panel-body">
            
            <button type="button" class="btn btn-large btn-block btn-info" id="refresh">开启自动刷新</button>
            
      </div>
</div>


<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>代码</th>
                <th>名称</th>
                <th>当前</th>
                <th>涨幅</th>
                
            </tr>
        </thead>
        <tbody id="table">
            <?
            foreach($model as $k =>$v)
             { 
            ?>
                <tr>
                    <td><?echo $v['stock_id'];?></td>
                    <td><?echo $v['stock_name'];?></td>
                    <td><span class="label label-default">空</span></td>
                    <td><span class="label label-default">空</span></td>
                </tr>
            <?
                }
            ?>
            
               
            
        </tbody>
    </table>
</div>






<?php
$this->registerJs(
   '$("document").ready(function(){ 
       $("#refresh").click(function(){
           setTimeout("refreshTable()",1000);
       });
    });'
);
?>
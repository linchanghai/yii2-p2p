
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="#">我的消息</a></li>
    </ul>
<?php
foreach($models as $model){
echo $model->title;
echo $model->content;
echo date('Y-m-d H:i:s',$model->created_at);
}
?>

?>

</div>
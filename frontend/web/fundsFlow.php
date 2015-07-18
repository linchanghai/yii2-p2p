<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Examples</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="css/style.min.css" rel="stylesheet" />
    <link href="css/invest.min.css" rel="stylesheet" />
    <link href="css/account.min.css" rel="stylesheet" />
    <link href="css/jquery.datetimepicker.css" rel="stylesheet" />
</head>
<body>
<?php include "header.php" ;?>
<div class="container twoContainer">
    <?php include "accountSide.php" ;?>
    <div class="containerMain fundsFlow">
        <div class="itemTitle">
            资金流水记录
        </div>
        <div class="fundsFlowContent p20">
            <div class="clearFix mt10 filterLine">
                <label>时间范围:</label>
                <a class="active" href="#">全部</a>
                <a href="#">1个月</a>
                <a href="#">2个月</a>
                <a href="#">3个月</a>
                <span class="fl">从</span>
                <input type="text" placeholder="请选择开始时间" class="fl datePicker">
                <span class="fl">到</span>
                <input type="text" placeholder="请选择截止时间" class="fl datePicker">
            </div>
            <div class="clearFix mt10 filterLine">
                <label>项目收益:</label>
                <a class="active" href="#">全部</a>
                <a href="#">充值</a>
                <a href="#">提现</a>
                <a href="#">投资</a>
                <a href="#">回收</a>
                <a href="#">转让债券</a>
            </div>
            <table class="table table-bordered textCenter mt20">
                <thead>
                    <tr>
                        <th>交易时间</th>
                        <th>交易类型</th>
                        <th>交易金额(元)</th>
                        <th>账户金额(元)</th>
                        <th>备注</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2015-07-07</td>
                        <td>投资成功</td>
                        <td>10000</td>
                        <td>0.00</td>
                        <td>点撒的</td>
                    </tr>
                </tbody>
            </table>
            <div class="tableNoInfo">
               <i class="glyphicon glyphicon-info-sign secondColor"></i> 暂无数据
                <p>
                    <a href="#" class="mt20 btn regularBtn">立即充值</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/accountRest.js"></script>
</body>
</html>
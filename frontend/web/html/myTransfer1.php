<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Examples</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="css/style.min.css" rel="stylesheet" />
    <link href="css/account.min.css" rel="stylesheet" />
</head>
<body>
<?php include "header.php" ;?>
<div class="container twoContainer">
    <?php include "accountSide.php" ;?>
    <div class="containerMain">
        <ul class="clearFix rechargeTitle tabs">
            <li><a href="#">可转让项目</a></li>
            <li><a class="active" href="#">转让中项目</a></li>
            <li><a href="#">已经转让项目</a></li>
        </ul>
        <div class="backGrey p20 fundsRecords">
            <table class="table table-bordered textCenter mt20 tabContent">
                <thead>
                <tr>
                    <th>项目名称</th>
                    <th>转让金额(元)</th>
                    <th>年化收益率</th>
                    <th>折价率</th>
                    <th>已完成转让</th>
                    <th>已获得资金(元)</th>
                    <th>已付服务费(元)</th>
                    <th>截止时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>N00095</td>
                    <td>100000</td>
                    <td>10%</td>
                    <td>0.1%</td>
                    <td>80%</td>
                    <td>80000</td>
                    <td>8</td>
                    <td>2015-07-07</td>
                    <td><a href="#" class="secondColor">查看</a></td>
                </tr>
                </tbody>
            </table>
            <div class="mt20 textCenter">
                <ul class="pagination">
                    <li><a href="#"><</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>
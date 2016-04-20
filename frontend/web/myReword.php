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
</head>
<body>
<?php include "header.php" ;?>
<div class="container twoContainer">
    <?php include "accountSide.php" ;?>
    <div class="containerMain tabWrap">
        <ul class="clearFix rechargeTitle tabs">
            <li><a class="active" href="#">红包</a></li>
            <li><a href="#">现金券</a></li>
            <li><a href="#">年化券</a></li>
        </ul>
        <div class="tabContentWrap">
            <div class="backGrey p20 fundsRecords tabContent">
                <div class="clearFix mt10 filterLine">
                    <label>红包使用状况:</label>
                    <a class="active" href="#">未使用</a>
                    <a href="#">已使用</a>
                </div>
                <div class="filterLine"><label>红包余额: 55元</label></div>
                <table class="table table-bordered textCenter mt20 tabContent">
                    <thead>
                    <tr>
                        <th>金额</th>
                        <th>发放日期</th>
                        <th>编号</th>
                        <th>过期时间</th>
                        <th>备注</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>10元</td>
                        <td>2015-07-07</td>
                        <td>NB00098</td>
                        <td>2015-07-07</td>
                        <td>新手认证获得</td>
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
            <div class="backGrey p20 fundsRecords tabContent hide">
                <div class="clearFix mt10 filterLine">
                    <label>红包使用状况:</label>
                    <a class="active" href="#">未使用</a>
                    <a href="#">已使用</a>
                    <a href="#">已过期</a>
                </div>
                <div class="filterLine"><label>使用现金券总数: 2张</label></div>
                <table class="table table-bordered textCenter mt20 tabContent">
                    <thead>
                    <tr>
                        <th>金额</th>
                        <th>发放日期</th>
                        <th>编号</th>
                        <th>过期时间</th>
                        <th>备注</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>10元</td>
                        <td>2015-07-07</td>
                        <td>NB00098</td>
                        <td>2015-07-07</td>
                        <td>N0098项目获得</td>
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
            <div class="backGrey p20 fundsRecords tabContent hide">
                <div class="clearFix mt10 filterLine">
                    <label>红包使用状况:</label>
                    <a class="active" href="#">未使用</a>
                    <a href="#">已使用</a>
                    <a href="#">已过期</a>
                </div>
                <div class="filterLine"><label>使用年化券总数: 2张</label></div>
                <table class="table table-bordered textCenter mt20 tabContent">
                    <thead>
                    <tr>
                        <th>年化券</th>
                        <th>发放日期</th>
                        <th>编号</th>
                        <th>过期时间</th>
                        <th>备注</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1.00%</td>
                        <td>2015-07-07</td>
                        <td>NB00098</td>
                        <td>2015-07-07</td>
                        <td>500积分换取</td>
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
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>
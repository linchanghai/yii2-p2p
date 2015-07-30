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
        <ul class="clearFix rechargeTitle">
            <li><a class="active" href="#">钻点钱包</a></li>
        </ul>
        <div class="rechargeContainer clearFix p20 myWallet">
            <div class="walletInfoItem displayTable">
                <div class="disTab">
                    <p>钻点钱包资金</p>
                    <p class="mt10">0.00元</p>
                </div>
            </div>
            <div class="walletInfoItem displayTable">
                <div class="disTab">
                    <p>累计收益</p>
                    <p class="mt10">1.00元</p>
                </div>
            </div>
            <div class="walletInfoRight">
                <div class="clearFix walletInfoRight1">
                    <div class="fl">本金0.00元</div>
                    <div class="fl ml10">
                        余额自动转入钻点钱包
                    </div>
                    <div class="fl ml10">
                        <div class="switchWrap">
                            <div class="switch clearFix">
                                <span class="switch-item switch-left">ON</span>
                                <span class="switch-middle">&nbsp;</span>
                                <span class="switch-item switch-right">OFF</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearFix mt10">
                    <div class="fl mt10">收益0.12元</div>
                    <div class="fl ml10">
                        <a href="#" class="fl btn regularBtn secondBack ml10">转入</a>
                        <a href="#" class="fl btn regularBtn secondBack ml10">转出</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="mt20 backGrey myWalletArea">
            <ul class="clearFix myWalletAreaTap">
                <li class="active">转入</li>
                <li>转出</li>
            </ul>
            <div class="myWalletAreaDetail">
                <div class="myWalletSingle p20">
                    <table class="table table-bordered textCenter">
                        <thead>
                            <tr>
                                <th>时间</th>
                                <th>金额</th>
                                <th>状态</th>
                                <th>操作</th>
                                <th>合同</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    2015-07-07 08:08:08
                                </td>
                                <td>
                                    1000元
                                </td>
                                <td>
                                    成功
                                </td>
                                <td>
                                    转入
                                </td>
                                <td>
                                    <a href="#">合同明细</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="myWalletSingle p20 hide">
                    <table class="table table-bordered textCenter">
                        <thead>
                        <tr>
                            <th>时间</th>
                            <th>金额</th>
                            <th>状态</th>
                            <th>操作</th>
                            <th>合同</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                2015-07-07 08:08:08
                            </td>
                            <td>
                                1000元
                            </td>
                            <td>
                                成功
                            </td>
                            <td>
                                转出
                            </td>
                            <td>
                                <a href="#">合同明细</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>
<?php
use yii\helpers\Url;

list($path, $link) = $this->getAssetManager()->publish('@core/message/web');
$this->registerJsFile($link . '/js/message.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile($link . '/css/message.css');

?>

<div class="containerMain backGrey myMessages">
    <div class="myMessageTitle itemTitle fs16 clearFix">
        <div class="fl">
            消息
        </div>
        <a href="#" class="fr">
            全部标记为已读
        </a>
    </div>
    <table class="table table-hover messagesTable">
        <tbody>
        <?php
        if (isset($models) && $models) {
            foreach ($models as $model) {
                ?>
                <tr>
                    <td class="messageLeft">
                        <input type="checkbox" class="prt2 msgCheck " name="messageId"
                               value="<?= $model->message_id ?>"/>
                    <span class="<?= ($model->status ? '' : 'status_unread') ?>"
                          data-url="<?= Url::to(['/message/message/change-status']) ?>"
                          data-id="<?= $model->message_id ?>">
                        <?= $model->title ?></span>

                        <div class="messageContent mt10">
                            <?= $model->content ?>
                        </div>
                    </td>
                    <td class="messageRight originDate"><?= date('Y-m-d H:i:s', $model->created_at) ?></td>
                    <td class="messageRight removeMsg secondColor">
                        <a class="secondColor deleteMessage" href="javascript:;"
                           data-url="<?= Url::to(['/message/message/delete']) ?>" data-id="<?= $model->message_id ?>">删除
                            ×</a>

                        <p class="textRight insideDate mt10"><?= date('Y-m-d H:i:s', $model->created_at) ?></p>
                    </td>
                </tr>

            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan=5>
                    <div class="tableNoInfo">
                        <i class="glyphicon glyphicon-info-sign secondColor"></i> 暂无数据
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php
    if (isset($models) && $models) {
        ?>
        <div class="myMessageBottom itemTitle itemBottom clearFix">
            <div class="fl">
                <label for="allMsg"><input type="checkbox" id="allMsg" class="prt2">全选</label>
                <a class="secondColor" href="#">标记为已读</a>
                <a class="secondColor" href="#">删除</a>
            </div>
        </div>
    <?php } ?>
</div>
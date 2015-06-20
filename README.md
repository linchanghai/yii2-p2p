以下只是个人意见，哥只是个俗人，难免有疏漏，如果建议，欢迎提出...
===

代码未测试，bug难免
---

我给核心框架取了个名字叫Kiwi(猕猴桃)，话说弄个有节操的名字，不太好找，这个还是比较靠谱的
---

核心框架代码放在kiwi目录下，主要用于扩展Yii的功能，目录结构和Yii的对应，
config文件夹放了通用配置文件，需要在index.php中实例化Yii时合并到config中
---

kiwi\Kiwi.php
---
上帝类，用于生成所有model，所有的model的create都不能用new

比如 $user = new User() 不允许，应该用 $user = Kiwi::getUser() 代替

Kiwi内部会调用 Yii::createObject($type, array $params = []) 生成类的实例


kiwi\Bootstrap.php
---
kiwi的引导文件，Bootstrap类在Yii application的bootstrap中调用。

然后初始化命名空间，然后按照依赖关系，加载module的配置文件，最后初始化各个模块。

模块初始化分两部分，开始实例化module类，然后加载配置，执行migration，之后所有module类实例化后执行module类的bootstrap方法


普通module定义
---
目录结构

    作者名or组织名

        module名

            controllers     控制器，不解释

            migrations      所有的数据库安装脚本放这边，写法跟Yii的migration写法一样，区别是命名规则应类似：
                            初始安装 文件名 v0.1.0.php, 类名 class v0_1_0 extends extends Migration
                            升级 文件名 v0.1.0_v0.2.0.php, 类名 class v0_1_0_v0_2_0 extends extends Migration
                            因为类名必须以字母开头，且不能出现.和- 所以...

            models/         数据库持久化操作，不解释

            forms/          用户数据验证，不解释

            services/       业务逻辑，不解释

            views/          视图，不解释

            Module.php      模块初始化类，在类中需要定义 public $version, 用于版本升级，详细定义查看kiwi\base\Module类

执行流程
---
在main-common.php的配置文件中将kiwi\Module设置为启动时初始化，Yii在实例化后会调用 kiwi\Module 的 bootstrap($app) 函数

该函数调用 $this->initModuleNamespace(); 遍历其他module目录设定Alias,及命名空间用于类的autoload

之后调用 $app->initModuleConfig() 用于获取 '@extension' 文件夹下的module定义。之后将配置存入Yii实例中

之后调用 $app->initModules(); 由于Yii使用延时加载Module，所以Module的实例化会在第一次使用时执行，
所以当没有显示调用 Yii::$app->getModule('xxx') 时, 模块类不会初始化，
但是模块下的classes用于整个程序的重写，需要在第一时间载入，所以在 kiwi\Module 中调用初始化所有模块


现有问题
---
在定义classes.php用于重写model时，多个模块都重写了同一个model时，及其载入顺序问题，后载入会覆盖前面的

使用controllerMap用于重写控制器时，多个载入问题

核心模块介绍
---
auth 权限模块
权限的实现基于Yii的beforeAction的事件，在Yii::$app中插入事件验证是否有权限，
并在每个module的beforeAction中加入事件直接阻止module下控制器的访问。

cron 定时任务模块
需要在linux服务器上添加corn job每分钟跑corn的代码，从console的入口
cron会去数据库查找当前时间点是否有定时任务需要执行(corn表达式匹配)，如果有，执行

notification 通知模块 -- todo
扫描整个系统的事件，
在后台维护时，下拉选择事件，勾选该事件发生时的通知方式(邮件/短信/站内信)，填写通知模板

payment 支付模块 --todo
定义支付接口，隔离各个支付方式的影响，触发支付的回掉通知函数，不包含payLog的记录

rewrite url重写模块
添加自定义urlRule，基于数据库配置的全局url重写，需要分前后台(todo)
需要添加正则匹配数据库维护，需要考虑(todo)

setting 配置模块
自定义配置，setting/settingKVModel
自定义下拉列表， DataList
KVModel和PVModel(EAVModel)需要提取到Kiwi(todo)

theme 主题更换模块 -- todo(del)
更换主题，后续会被layout模块替换掉

tree 抽象树形模块
category/tag/attributeSet都继承此模块，用左右值插件

user 用户模块 -- todo
邮箱注册/手机注册
用户名密码登录/短信动态密码登录
邮箱找回密码/短信找回密码
邮箱验证/手机验证

认证申请审核(vip/实名/企业)，上传数据，后台审核

个人信息维护/地址管理/扩展数据
二级密码/支付密码
头像/生日/

登录日志记录(time,ip)

用户组/升级/积分(积分应该像通知模块一样后台维护)

oauth 第三方登录 -- todo

layout/template 视图模块 -- todo
接管所有页面显示，url key 自己定义
定义主题，css/js后台上传，header/footer维护，可添加widgets
content内容，添加布局，添加widgets
widgets逻辑结果(如注册有成功失败，登录有成功失败)，需要选择调转页面
widgets的所有可输入变量都可以在页面上配置
widgets包括view输出，action逻辑部分

ajax无缝切换 底层 -- todo
需要重写ActiveForm, 触发init事件，用于控制enableAJaxValidate和jq.form接管表单提交
重写controller->render和response->redirect函数，
判断isAjax，输出 message(...), redirect, func(前台提交)(调用js函数改变页面Dom), customData

log 日志模块

aop 切面模块

form验证输入，service控制流程，model持久化

auth采用全局事件形式验证，但是复杂权限控制，如可查看无编辑权限(即界面有差异，而不是简单的是否可访问)，有待研究
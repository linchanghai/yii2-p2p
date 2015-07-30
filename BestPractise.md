Yii2最佳实践 -- 个人心得(lujie)
1. 控制器跟视图不能包含任何逻辑，逻辑代码应该表单模型或者AR模型
2. 前台的表单提交必须有一个表单模型来处理，包括ajax，不能直接在控制器中走逻辑

前台表单的代码规范.
表单提交的逻辑复杂，涉及到多个表，会出现当前表无错误，但是其他关联表有错误;
代码的逻辑应该尽量先全部执行验证代码，保证当前表和关联表都没有错误;
然后执行流程代码，流程代码的错误只能是未知异常

关于服务层的考虑
在DDD中，model为贫血模型，只有数据，没有逻辑，逻辑层为服务层，model无状态;
在元编程中，AR为富血模型，包含数据和逻辑，model有状态;
个人建议，除了表单模型里的业务逻辑外，其他业务逻辑应该放在model
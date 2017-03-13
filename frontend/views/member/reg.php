
<div class="login w990 bc mt10 regist">
    <div class="login_hd">
        <h2>用户注册</h2>
        <b></b>
    </div>
    <div class="login_bd">
        <div class="login_form fl">
            <?php
            $form=\yii\widgets\ActiveForm::begin(
                [
                    'fieldConfig'=>[
                        'options'=>['tag'=>'li'],
                        'errorOptions'=>['tag'=>'p'],
                        'inputOptions'=>['class'=>'txt']
                    ]
                ]
            );
            ?>
            <ul>
                <?php $a=\yii\helpers\Html::button('获取验证码',['id'=>'best'])?>
                <?=$form->field($model,'username')->textInput(['placeholder'=>'3-20位字符，可由中文、字母、数字和下划线组成'])?>
                <?=$form->field($model,'password')->passwordInput(['placeholder'=>'6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号'])?>
                <?=$form->field($model,'relpassword')->passwordInput(['placeholder'=>'6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号'])?>
                <?=$form->field($model,'email')->textInput(['placeholder'=>'邮箱必须合法'])?>
                <?=$form->field($model,'tel')->textInput(['placeholder'=>'6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号'])?>
                <?=$form->field($model,'code',['template'=>"{label}\n{input}\n$a\n{hint}\n{error}"])->textInput(['disabled'=>!boolval($model->code)])->label('短信验证码')?>


                <?=$form->field($model,'captcha',['options'=>['class'=>'checkcode']])->label('验证码')->widget(\yii\captcha\Captcha::className(),
                    ['template'=>'
                          {input}
                         {image}
                       '])
                ?>
                <li>
                    <label for="">&nbsp;</label>
                    <input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
                </li>

                <?=\yii\helpers\Html::submitInput('',['class'=>'login_btn']) ?>

            </ul>
            <?php
            \yii\widgets\ActiveForm::end();
            ?>

<?php
/**
 * @var $this yii\web\View
 */
use frontend\assets\CommonAsset;
$this->registerCssFile('@web/style/login.css');
?>
<!--            <script type="text/javascript">-->
<!---->
<!--                    //启用输入框-->
<!--                    $('#best').click(function(){-->
<!---->
<!--                        var tel=$('#member-tel').val();-->
<!--                        $.get("http://www.jx.com/member/msn",{'tel':tel})-->
<!---->
<!--                    });-->
<!---->
<!---->


<?php
/**
 * @var $this yii\web\View
 */


$this->registerJs('$("#best").click(function(){
            var time=30;
			var interval = setInterval(function(){
				time--;
				if(time<=0){
					clearInterval(interval);
					var html = "获取验证码";
					$(this).prop("disabled",false);
				} else{
					var html = time + " 秒后再次获取";
					$(this).prop("disabled",true);
				}

				$(this).val(html);
			},1000);
    var num = $("#member-tel").val();


    $.post("'.\yii\helpers\Url::to(["member/sms"]).'",{num:num},function(data){
        if(data == "success"){
            $("#member-code").prop("disabled",false);
        }else{
            alert(data);
            $("#best").prop("disabled",false);
        }
    });
});
');

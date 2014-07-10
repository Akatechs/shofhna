<div id="signup_form_wrapper" class="right">
    <h3>مستخدم جديد</h3>
<!--    <form id="signup_form" action="/" method="post">-->
    {{ Form::open(array('route'=>'account-create')) }}
        <div id="signup_form_inputs">
            <p>{{ Form::text('username', null, array( 'placeholder'=>"اسم المستخدم",'class'=>'inputtext')) }}</p>
<!--            <p><input name="username" class="inputtext" placeholder="اسم المستخدم" type="text"></p>-->
            
            <p>{{ Form::text('email', null, array( 'placeholder'=>"بريدك الالكتروني",'class'=>"inputtext")) }}</p>
<!--        <p><input name="email_address" class="inputtext" placeholder="بريدك الالكتروني" type="text"></p>-->
            
<!--            <p><input name="password" class="inputtext" placeholder="كلمة المرور" type="password"></p>-->
            <p>{{ Form::password('password', array( 'placeholder'=>"كلمة المرور",'class'=>"inputtext")) }}
            
            </p>
            <p>{{ Form::password('password_confirmation', array( 'placeholder'=>"كلمة المرور مرة أخرى ",'class'=>"inputtext")) }}</p>
            
            
            
            <input name="follow_category" value="" type="hidden">
            
            <div class="clear"></div>
            
                
        </div>
    <p><br><br>
            {{ Form::submit("تسجيل", array("class"=>"button"))}}
<!--            <input value="تسجيل" class="button" type="submit">-->
        </p>
    {{ Form::close() }}
<!--    </form>-->
</div>


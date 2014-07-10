<div id="login_form_wrapper" class="right">
            <h3>تسجيل دخول</h3>
            <form id="login_form" action="{{route('account-login')}}" method="post">
                <div id="login_form_inputs">
                    <p><input name="username" class="inputtext" placeholder="اسم المستخدم" type="text"></p>
                    <p><input name="password" class="inputtext" placeholder="كلمة المرور" type="password"></p>
                    <p><a id="password_btn" href="#"><span class="smalltext">فقدت كلمة المرور؟</span></a></p>
                    
                    <div class="clear"></div>
                    {{Form::token()}}
                </div>
                <p><input value="دخول" class="button" type="submit"></p>
            </form>
        </div>
        <div id="password_form_wrapper" class="hidden right">
                <h3>استعادة كلمة المرور</h3>
                <form id="password_form" action="{{route('account-recover-password')}}" method="post">
                    <div id="password_form_inputs">
                        <p><input name="email" class="inputtext" placeholder="بريدك الالكتروني" type="text"></p>
                        <p><a id="relogin_btn" href="#"><span class="smalltext">تسجيل دخول</span></a></p>
                        <div class="clear"></div>
                        
                    </div>
                    <p>
                        
                        <input value="أرسل" class="button" type="submit"></p>
                    {{Form::token()}}
                </form>
        </div>

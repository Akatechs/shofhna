<div class="linput">
    {{ Form::open(array('url'=>route('user-settings',['username'=>$user->username]),'class'=>'form largeform')) }}
<!--    <form action="/account" method="post" class="form largeform">-->
        <p class="rinput">
            <label>الاسم الكامل</label>
            {{ Form::text('fullname', $user->fullname, array( 
                        'class'=>'largeinput longinput',
                        'maxlength' => '50',     
                            )) 
            }}
<!--            <input name="full_name" class="largeinput longinput" maxlength="50" value="هشام محمد" type="text">-->
        </p>
        <div class="clear"></div>
        <p class="rinput">
            <label>بريدك الالكتروني</label>
            {{ Form::text('email', $user->email, array( 
                        'class'=>'largeinput longinput ltr',
                            )) 
            }}
<!--            <input name="email_address" class="largeinput longinput ltr" value="mr.hichem@gmail.com" type="text">-->
        </p>
        <div class="clear"></div>
<!--        <p class="rinput">
            <label>الموقع</label>
            <input name="website" class="largeinput longinput ltr" value="" type="text">
        </p>-->
        <div class="clear"></div>
        <p class="rinput">
            <label>نبذة عنك</label>
            {{ Form::textarea('bio', $user->bio, array( 
                        'class'=>'largearea',
                        'maxlength'=>'200'
                            )) 
            }}
<!--            <textarea name="bio" maxlength="200" class="largearea">مهندس تونسي</textarea>-->
        </p>
        <div class="clear"></div>
        @if (!$user->getIsTwitterUser())
        <p class="rinput">
            <label>تعديل كلمة السر </label>
            {{ Form::password('oldPassword', array( 'placeholder'=>'كلمة السر الحالية ','class'=>'largeinput longinput')) }}
            <br>
            {{ Form::password('newPassword', array( 'placeholder'=>'كلمة السر الجديدة ','class'=>'largeinput longinput')) }}
            <br>
            {{ Form::password('newPassword_confirmation', array('placeholder'=>'كلمة السر الجديدة مرة أخرى ','class'=>'largeinput longinput')) }}
        </p>
        @endif
        <p>
            
            <br>
            <input class="largebutton" value="تحديث" type="submit">
        </p>
    {{ Form::close() }}
</div>
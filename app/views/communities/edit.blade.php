@extends('layouts.main')
@section('title',"تعديل المجتمع ")
@section('content')
<div id="edit">
    <div id="content_nav">
    <h2 id="nav_title"> تعديل المجتمع </h2>
    <!--<ul><li class="active"><a href="/add/link?community=programming">رابط</a></li><li><a href="/add/post?community=programming">موضوع</a></li></ul>-->

    <div class="clear"></div>
    </div>
<form action="{{$community->getEditRoute()}}" method="post" class="form largeform" id="community_form">

<!--<form id="community_form" action="/communities/create" method="post" class="form largeform">-->
    
    <p class="rinput">
        <label>اسم المجتمع</label>
        {{Form::text('community_title',$community->name,['class'=>'largeinput longinput',
                'maxlength'=>"35",
            ])}}
<!--        <input name="community_title" class="largeinput longinput" maxlength="35" value="" type="text">-->
        <span class="infotext">اختر اسماً مناسباً للمجتمع. ان كان المجتمع عاماً وليس خاصاً، تأكد أنه غير موجود مسبقاً.</span>
    </p>
    <p class="rinput">
        <label>الاسم القصير</label>
        {{Form::text('community_slug',$community->slug,['class'=>"largeinput longinput" ,'maxlength'=>"35"])}}
<!--        <input name="community_slug" class="largeinput longinput" maxlength="35" value="" type="text">-->
        <span class="infotext">لن تتمكن من تغييره لاحقاً. أدخل أحرفاً انجليزية فقط. مثال: {{Request::root()}}/community/<span class="strong community_slug_example">example</span></span>
    </p>
    <p class="rinput">
        <label>نبذة عن المجتمع</label>
        {{Form::textArea('community_description',$community->description,['maxlength'=>"500" ,'class'=>"largearea"])}}
<!--        <textarea name="community_description" maxlength="200" class="largearea"></textarea>-->
        <span class="infotext">عدد الأحرف المتبقي: <span id="community_description_chars">500</span></span>
    </p>
<!--    <div id="private_community_options" class="hidden">
        <p class="rinput">
            <label>رابط الموقع (اختياري)</label>
            <input name="community_link" class="largeinput longinput" value="" type="text"><span class="infotext">سيظهر هذا الرابط ان اخترت شعاراً للمجتمع فقط بالضغط على صورة الشعار.</span>
        </p>
    </div>-->
    <div class="clear"></div>
<!--    <p class="rinput autowidth">
        <label>شعار المجتمع (اختياري)</label>
        <input id="community_logo" name="community_logo" value="" type="hidden"><span class="infotext">حجم الصورة: 210x80px | الامتدادات: jpg, gif, png | الحجم:200 KB</span>
    </p>
    <p class="linput autowidth"></p>
    <div id="community_image_uploader">
        <div class="qq-uploader">
            <div style="display: none;" class="qq-upload-drop-area"><span></span>
            </div>
            <div style="position: relative; overflow: hidden; direction: ltr;" class="qq-upload-button button">اختيار
                <input style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;" name="file" type="file">
            </div>
            <ul class="qq-upload-list"></ul>
        </div>
    </div>-->
    <p></p>
<!--    <div class="clear"></div>
    <img id="community_logo_preview" class="hidden" src="">-->
    <div class="clear"></div>
    <p>
<!--        <input id="user_token" name="token" value="491d4440dfdc7a9d32d9f12ed9c42cf0e81ad1d8" type="hidden">
        <br>-->
        {{ Form::submit(" تعديل المجتمع ", array("class"=>"largebutton"))}}
        {{Form::token()}}
<!--        <input class="largebutton" value="انشاء المجتمع" type="submit">-->
    </p>
{{Form::close()}}
</div>
@stop
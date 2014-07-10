<div id="edit">
    <div id="content_nav">
    <h2 id="nav_title">تعديل المساهمة </h2>
    <!--<ul><li class="active"><a href="/add/link?community=programming">رابط</a></li><li><a href="/add/post?community=programming">موضوع</a></li></ul>-->

    <div class="clear"></div>
    </div>
<div id="page_content">
	<form action="{{$post->getEditRoute()}}" method="post" class="form largeform">
		<p>
			<label>المجتمع:</label>
                        {{Form::select('community_id',$communities,$post->community_id,array('class'=>'chosen-select chosen-rtl'))}}

		</p>
		<div class="clear">
		</div>
		<p>
			<label>العنوان كاملاً يصف الموضوع بدقة</label><input id="post_title" name="title" class="largeinput fullwidth" value="{{$post->title}}" type="text" disabled><span class="infotext">يجب أن يفهم الزائر المشاركة بقراءة العنوان فقط. لا تدخل عناوين غير واضحة مثل: "موضوع مهم"، "استفسار بسيط"، "مشكلة أرجو المساعدة"، "أحتاج رأيكم"...</span>
		</p>
		<div class="clear">
		</div>
                <p>

                   <label> الرابط المباشر</label>
                    <input class="largeinput fullwidth ltr" type="text" value="{{$post->link}}" name="link"></input>

                </p>
                <div class="clear">
		</div>
		<p>
			<label>المحتوى (اختياري ان كان العنوان للنقاش)</label><textarea id="post_content" name="content" class="largearea largearea_tall fullwidth post_textarea">{{$post->getRawContent()}}</textarea>
		</p>
		<div class="clear">
		</div>
		
		
		<p>
			<input name="confirm" value="0" type="checkbox"> أنا شخص مثقّف، أعلم أني لست في منتدى ولقد قرأت <a href="/terms" target="_blank">قوانين المشاركة وارشادات الاستخدام</a>. هذه المساهمة ذات فائدة، ليست سبام ولا تخالف أي شرط.<br>
			<br>
		</p>
		<div class="clear">
		</div>
		<p>
			{{Form::token()}}
<!--                        <input id="format_post_btn" class="largebutton rightf" value="طريقة تنسيق الموضوع" type="button">
                        <input id="preview_post_btn" class="largebutton leftf" value="معاينة" type="button">-->
                        <input class="largebutton leftf" value="أرسل" type="submit">
		</p>
	</form>
	<div class="clear">
	</div>
</div>
</div>

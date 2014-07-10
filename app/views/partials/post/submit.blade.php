<div id="add">
    <div id="content_nav">
    <h2 id="nav_title">أرسل مساهمة جديدة</h2>
    <!--<ul><li class="active"><a href="/add/link?community=programming">رابط</a></li><li><a href="/add/post?community=programming">موضوع</a></li></ul>-->

    <div class="clear"></div>
    </div>
<div id="page_content">
	<form action="{{route('post-submit')}}" method="post" class="form largeform">
		<p>
			<label>المجتمع:</label>
<!--			<div id="s2id_autogen1" class="select2-container category-select2 largeinput halfwidth">
				<a href="javascript:void(0)" onclick="return false;" class="select2-choice" tabindex="-1">
				<span class="select2-chosen">برمجة عامة</span>
				<abbr class="select2-search-choice-close"></abbr>
				<span class="select2-arrow"><b></b></span>
				</a>
				<input id="s2id_autogen2" class="select2-focusser select2-offscreen" type="text">
				<div class="select2-drop select2-display-none select2-with-searchbox">
					<div class="select2-search">
						<input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" type="text">
					</div>
					<ul class="select2-results">
					</ul>
				</div>
			</div>-->
                        {{Form::select('community_id',$communities,0,array('class'=>'chosen-select chosen-rtl'))}}
<!--			<select tabindex="-1" name="community" class="chosen-select chosen-rtl">
				<option value=""></option>
				<option value="webdev" alt="تطوير الويب">تطوير الويب</option>
				<option value="programming" alt="برمجة عامة" selected="selected">برمجة عامة</option>
				<option value="design" alt="التصميم وقابلية الاستخدام">التصميم وقابلية الاستخدام</option>
				<option value="entrepreneurship" alt="ريادة الاعمال">ريادة الأعمال</option>
				<option value="ecommerce" alt="التجارة الالكترونية">التجارة الالكترونية</option>
				<option value="marketing" alt="التسويق الالكتروني">التسويق الإلكتروني</option>
				<option value="freelancing" alt="العمل الحر">العمل الحر</option>
				<option value="content" alt="التدوين وصناعة المحتوى">التدوين وصناعة المحتوى</option>
				<option value="general" alt="عام">عام</option>
				<option value="AsnadStore" alt="اسناد">أسناد</option>
				<option value="jobs" alt="الوظائف وفرص العمل">الوظائف وفرص العمل</option>
				<option value="Ideas" alt="افكار">افكار</option>
				<option value="git" alt="git">Git</option>
				<option value="DOTNET" alt="مطوري الدوت نت net">مطوري الدوت نت .NET</option>
				<option value="AsnadPublicStore" alt="منتجات اسناد">منتجات أسناد</option>
			</select>-->
		</p>
		<div class="clear">
		</div>
		<p>
			<label>العنوان كاملاً يصف الموضوع بدقة</label><input id="post_title" name="title" class="largeinput fullwidth" value="" type="text"><span class="infotext">يجب أن يفهم الزائر المشاركة بقراءة العنوان فقط. لا تدخل عناوين غير واضحة مثل: "موضوع مهم"، "استفسار بسيط"، "مشكلة أرجو المساعدة"، "أحتاج رأيكم"...</span>
		</p>
		<div class="clear">
		</div>
                <p>

                   <label> الرابط المباشر</label>
                    <input class="largeinput fullwidth ltr" type="text" value="" name="link"></input>

                </p>
                <div class="clear">
		</div>
		<p>
			<label>المحتوى (اختياري ان كان العنوان للنقاش)</label><textarea id="post_content" name="content" class="largearea largearea_tall fullwidth post_textarea"></textarea>
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

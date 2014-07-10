<!DOCTYPE html>
<html>
<head>
<title>@yield('title') |  شوف هنا</title>
<meta name="description" content="شوف هنا هي مجموعة قنوات تهتم بجمع و نشر المواد المرئية الاستثنائية على الإنترنت إلى الجمهور العربي" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge" />
@yield('meta')
{{ HTML::style('/css/style.css'); }}
{{ HTML::style('/css/font-awesome.css'); }}
{{ HTML::style('/css/typicons.min.css'); }}
{{ HTML::style('/chosen/chosen.css'); }}
<link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}" />
@yield('styles')
<!--[if IE 7]>  <link rel="stylesheet" href="/css/font-awesome-ie7.min.css"><![endif]-->
<script type="text/javascript" src="{{asset('js/jquery-1.8.3.min.js')}}"></script>
<script type="text/javascript" src="/js/jquery-ui-1.8.22.min.js')}}">
</script><script type="text/javascript" src="{{asset('js/jquery.tag-it.js')}}">
</script><script type="text/javascript" src="{{asset('js/select2.jquery.min.js')}}">
</script><script type="text/javascript" src="{{asset('js/jquery.dropdown.js')}}"></script>
<script src="{{asset('chosen/chosen.jquery.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/application.js')}}"></script>
@yield('scripts')
</head>
<body>

@include('partials.navigation')


<div class="clear"></div>

@include('partials.header')

<div id="content">
<div class="inside">
<noscript><div id="noscript" class="msg_box yellow_box tcenter">هذا الموقع يحتاج JavaScript ليعمل بشكل صحيح. فعّل جافاسكريبت في المتصفح الذي تستخدمه أو استخدم متصفح أحدث.</div></noscript>

@include('partials.alerts')

<div id="page">
@yield('content')
</div>
</div>

<div class="clear"></div>

</div>

@include('partials.footer')


@include('partials.footer_partners')
<!--

-->


@include('partials.footer_copyright')
<!---->
<!-- drop down menu when  logged in -->


<input id="user_token" type='hidden' name='_token' value='{{csrf_token()}}' />
<input id="base_url" type='hidden' name='_baseUrl' value='{{Request::root()}}' />

<!--
<div id="shadow_box"></div>

<div id="dialog_form"><div id="dialog_title"></div>

<div id="dialog_body"></div>

<div id="dialog_buttons" class="clear"></div>


<div class="clear"></div></div>-->>
@include('search.searchbox')
@include('widgets.analytics')

</body>
</html>
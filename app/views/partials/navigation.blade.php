@if(isset($navLinks))
<div id="menu">
    <div class="inside">
        <div id="nav">
            
                @foreach($navLinks as $navLink)
                    <a href="{{ $navLink->getRouteToCommunity() }}">{{ $navLink->name() }}</a>
                @endforeach
            
<!--            <a href="/webdev">تطوير الويب </a>
            <a href="/programming">برمجة عامة </a>
            <a href="/design">التصميم وقابلية الاستخدام </a>
            <a href="/entrepreneurship">ريادة الأعمال </a><a href="/ecommerce">التجارة الالكترونية </a><a href="/marketing">التسويق الإلكتروني </a>
            <a href="/freelancing">العمل الحر</a><a href="/content">التدوين وصناعة المحتوى </a>
            <a href="/general">عام </a>-->
            <a href="{{route('communities-browse')}}"><i class="fa fa-angle-double-left"></i></a>
            
        </div>
        <div class="clear"></div>
    </div>
</div>
@endif
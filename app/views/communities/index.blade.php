@extends('communities.layout')
@section('title',"مجتمعات ")
@section('pageContent')
<ul id="categories_list" class="table_ul">
            <li class="table_title"><span class="category_title">اسم المجتمع</span><span class="followers_count">عدد المتابعين</span><span class="posts_count">عدد المواضيع</span><span class="date">آخر تفاعل</span><span class="actions"></span>
            </li>
            @foreach($communities as $community)
                @include('partials.community.listitem')
            @endforeach
</ul>
@stop
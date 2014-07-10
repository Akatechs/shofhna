@extends('layouts.main')
@section('title',"مركز التنبيهات")
@section('content')
<div id="notifications" class="page_sidebar">
    <div id="content_nav">
        <h2 id="nav_title">مركز التنبيهات</h2>
        <div class="clear"></div>
    </div>
    <div id="page_content">
        <ul id="notifications_list" class="table_ul">
            @foreach($notifications as $notification)
            <li id="notification-{{$notification->id}}" class="notification ">
                
                {{$notification->getHTML()}}
                
            </li>
            @endforeach
        </ul>
        {{$notifications->links()}}
    </div>
</div>
@stop


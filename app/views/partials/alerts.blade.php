<!--<div class="msg_box tcenter error">لم تكتب أي تعليق بعد</div>-->
@if($errors->count())
    <div class="msg_box tcenter error">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </div>
@endif

@if(Session::has('success'))
    <div class="msg_box tcenter success">
        @foreach(Session::get('success') as $success)
        <li>{{$success}}</li>
        @endforeach
    </div>
@endif
@if(Session::has('info'))
    <div class="msg_box tcenter info">
        @foreach(Session::get('info') as $info)
        <li>{{$info}}</li>
        @endforeach
    </div>
@endif


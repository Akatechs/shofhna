<div id="header">
    <div class="inside">
        <div id="logo" class="right">
            <h1><a href="{{route('default')}}"><img src="{{asset('/images/arabiaio.png')}}" alt="Shofhna" /></a></h1>
            
        </div>
        <div id="user_nav" class="left">
            
        	<a id="user_btn" 
                   @if(Auth::check()) href="{{route('user-index',[Auth::user()->username])}}" 
                   @else href="{{route('account-login')}}" 
                   @endif >
                
                
            	<i class="{{$config->get('config.icons.user')}}"></i>
            </a>
           
            @if(Auth::check())
             <a id="notifications_btn" href="{{route('notifications-browse')}}"    title="التنبيهات">
                 <i class="{{$config->get('config.icons.notifications')}}" >
                     @if($notificationsCount > 0)
                     <span class="upper_count">{{$notificationsCount}}</span>
                     @endif
                 </i>
                 
            </a> 
            @endif
                @if(Auth::check())
           	<a id="add_btn" href="{{route('post-submit')}}"   title="أضف مساهمة جديدة">
           		<i class="{{$config->get('config.icons.addPost')}}"></i>
           	</a> 
                @endif
           	<a id="search_btn" href="#" title="بحث" data-dropdown="#dropdown-search">
           		<i class="{{$config->get('config.icons.search')}}"></i></a> 
       		<a id="categories_btn" href="{{route('communities-browse')}}" title="المجتمعات" >
       			<i class="{{$config->get('config.icons.communities')}}"></i>
       		</a> 
                
                @if(Auth::check())
       		<a id="logout_btn" href="{{route('account-logout')}}" title="خروج" >
       			<i class="{{$config->get('config.icons.logout')}}"></i>
       		</a> 
                @endif
       	</div>
        
    </div>

<div class="clear"></div>
</div>

<li class="header">Overview</li>
<li>
   <a href="{{ action('DashboardController@agenda') }}">
      {{trans('group.latest_actions')}}
   </a>
</li>

<li>
   <a href="{{ action('DashboardController@users') }}">
      {{trans('messages.users_list')}}
   </a>
</li>



<li>
   <a href="{{ action('DashboardController@unreadDiscussions') }}">
      {{ trans('messages.latest_discussions') }}
      @if ($unread_discussions > 0) <span class="badge">{{$unread_discussions}}</span>
      @endif
   </a>
</li>




<li class="header">{{ trans('messages.your_groups') }}</li>

@forelse ($user_groups as $group)
   <li class="treeview">
      <a href="{{ action('GroupController@show', $group->id)}}">{{$group->name}}</a>
      <ul class="treeview-menu">
         <li role="presentation" @if (isset($tab) && ($tab == 'home')) class="active" @endif>
            <a href="{{ action('GroupController@show', $group->id) }}">
               <i class="fa fa-home"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.group_home') }}</span>
            </a>
         </li>

         <li role="presentation" @if (isset($tab) && ($tab == 'discussion')) class="active" @endif>
            <a href="{{ action('DiscussionController@index', $group->id) }}">
               <i class="fa fa-comments"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.discussions') }}</span>
            </a>
         </li>

         <li role="presentation" @if (isset($tab) && ($tab == 'action')) class="active" @endif>
            <a href="{{ action('ActionController@index', $group->id) }}">
               <i class="fa fa-calendar"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.actions') }}</span>
            </a>
         </li>

         <li role="presentation" @if (isset($tab) && ($tab == 'files')) class="active" @endif>
            <a href="{{ action('FileController@index', $group->id) }}">
               <i class="fa fa-file-o"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.files') }}</span>
            </a>
         </li>

         <li role="presentation" @if (isset($tab) && ($tab == 'users')) class="active" @endif>
            <a href="{{ action('UserController@index', $group->id) }}">
               <i class="fa fa-users"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.members') }}</span>
            </a>
         </li>

         <li role="presentation" @if (isset($tab) && ($tab == 'settings')) class="active" @endif>
            <a href="{{ action('MembershipController@settingsForm', $group->id) }}">
               <i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.settings') }}</span>
            </a>
         </li>
      </ul>
   </li>


@empty
   <li><a href="{{ action('DashboardController@index')}}">{{ trans('membership.not_subscribed_to_group_yet') }}</a></li>
@endforelse
<li><a href="{{ action('GroupController@create') }}">
   <i class="fa fa-bolt"></i> {{ trans('group.create_a_group_button') }}</a>
</li>


@if ($user->isAdmin())
   <li class="header">ADMIN</li>
   <li><a href="{{ url('/logs') }}">Logs</a></li>
@endif

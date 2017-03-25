<div class="ui header">
    <h1>
        <a href="{{ action('DashboardController@index') }}"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right"></i>
        @if (isset($tab) && ($tab <> 'home'))
            <a href="{{ action('GroupController@show', $group->id) }}">{{ $group->name }}</a>
        @else
            {{ $group->name }}
        @endif

        <span class="small">
            @if ($group->isPublic())
                <i class="fa fa-globe" title="{{trans('group.open')}}"></i>
            @else
                <i class="fa fa-lock" title="{{trans('group.closed')}}"></i>
            @endif
        </span>
    </h1>
</div>


@if (Auth::check())

    <div class="ui pointing secondary menu">


        <a href="{{ action('GroupController@show', $group->id) }}" class="item @if (isset($tab) && ($tab == 'home')) active @endif">
            <i class="home icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.group_home') }}</span>
        </a>


        @can ('viewDiscussions', $group)
            <a href="{{ action('DiscussionController@index', $group->id) }}" class="item @if (isset($tab) && ($tab == 'discussion')) active @endif">
                <i class="comments icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.discussions') }}</span>
            </a>
        @endcan

        @can ('viewActions', $group)
            <a href="{{ action('ActionController@index', $group->id) }}" class="item @if (isset($tab) && ($tab == 'action')) active @endif">
                <i class="calendar icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.agenda') }}</span>
            </a>
        @endcan

        @can ('viewFiles', $group)
            <a href="{{ action('FileController@index', $group->id) }}" class="item @if (isset($tab) && ($tab == 'files')) active @endif">
                <i class="file icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.files') }}</span>
            </a>
        @endcan

        @can ('viewMembers', $group)
            <a href="{{ action('UserController@index', $group->id) }}" class="item @if (isset($tab) && ($tab == 'users')) active @endif">
                <i class="users icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.members') }}</span>
            </a>
        @endcan


        @can ('viewMembers', $group)
            <a href="{{ action('MapController@map', $group->id) }}" class="item @if (isset($tab) && ($tab == 'map')) active @endif">
                <i class="map icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.map') }}</span>
            </a>
        @endcan

        @if ($group->isMember())
            <a href="{{ action('MembershipController@settingsForm', $group->id) }}"  class="item @if (isset($tab) && ($tab == 'settings')) active @endif">
                <i class="setting icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.settings') }}</span>
            </a>
        @else
            @can ('join', $group)
                <a href="{{ action('MembershipController@joinForm', $group->id) }}"  class="item @if (isset($tab) && ($tab == 'settings')) active @endif">
                    <i class="setting icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.join') }}</span>
                </a>
            @else
                <a href="{{ action('MembershipController@howToJoin', $group->id) }}"  class="item @if (isset($tab) && ($tab == 'settings')) active @endif">
                    <i class="setting icon"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.join') }}</span>
                </a>
            @endcan
        @endif
    </div>

@else

    <ul class="nav nav-tabs">

        <li role="presentation" @if (isset($tab) && ($tab == 'home')) class="active" @endif>
            <a href="{{ action('GroupController@show', $group->id) }}">
                <i class="fa fa-home"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.group_home') }}</span>
            </a>
        </li>


        @if ($group->isPublic() )
            <li role="presentation" @if (isset($tab) && ($tab == 'discussion')) class="active" @endif>
                <a href="{{ action('DiscussionController@index', $group->id) }}">
                    <i class="fa fa-comments"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.discussions') }}</span>
                </a>
            </li>
        @endif

        @if ($group->isPublic() )
            <li role="presentation" @if (isset($tab) && ($tab == 'action')) class="active" @endif>
                <a href="{{ action('ActionController@index', $group->id) }}">
                    <i class="fa fa-calendar"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.agenda') }}</span>
                </a>
            </li>
        @endif

        @if ($group->isPublic() )
            <li role="presentation" @if (isset($tab) && ($tab == 'files')) class="active" @endif>
                <a href="{{ action('FileController@index', $group->id) }}">
                    <i class="fa fa-file-o"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.files') }}</span>
                </a>
            </li>
        @endif

        @if ($group->isPublic() )
            <li role="presentation" @if (isset($tab) && ($tab == 'users')) class="active" @endif>
                <a href="{{ action('UserController@index', $group->id) }}">
                    <i class="fa fa-users"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.members') }}</span>
                </a>
            </li>
        @endif


        @if ($group->isPublic() )
            <li role="presentation" @if (isset($tab) && ($tab == 'settings')) class="active" @endif>
                <a href="{{ action('MembershipController@joinForm', $group->id) }}">
                    <i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm">{{ trans('messages.join') }}</span>
                </a>
            </li>
        @endif
    </ul>


@endif

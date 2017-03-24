<div class="ui fixed menu">

  <div class="ui container">
    <a href="{{ action('DashboardController@index') }}" class="header item">
      <i class="child icon"></i> {{Config::get('mobilizator.name')}}
    </a>
  </div>




  <div class="ui simple dropdown item">
    {{ trans('messages.overview') }} <i class="dropdown icon"></i>

    <div class="menu">
      <a class="item" href="{{ action('DashboardController@groups') }}">
        <i class="fa fa-cubes"></i> {{trans('messages.groups')}}
      </a>


      <a class="item" href="{{ action('DashboardController@discussions') }}">
        <i class="fa fa-comments-o"></i> {{trans('messages.discussions')}}
      </a>



      <a class="item" href="{{ action('DashboardController@agenda') }}">
        <i class="fa fa-calendar"></i> {{trans('messages.agenda')}}
      </a>



      <a class="item" href="{{ action('DashboardController@users') }}">
        <i class="fa fa-users"></i> {{trans('messages.users_list')}}
      </a>


      <a class="item" href="{{ action('DashboardController@map') }}">
        <i class="fa fa-map-marker"></i> {{trans('messages.map')}}
      </a>
    </div>
  </div>


  @if ($user_logged)

    <div class="ui simple dropdown item">

      {{ trans('messages.your_groups') }} <i class="dropdown icon"></i>

      <div class="menu">
        @if (Auth::check())
          @forelse ($user->groups()->orderBy('name')->get() as $group)
            <a class="item" href="{{ action('GroupController@show', $group->id)}}">{{$group->name}}</a>
          @empty
            <a class="item" href="{{ action('DashboardController@index')}}">{{ trans('membership.not_subscribed_to_group_yet') }}</a>
          @endforelse
        @endif

        <div class="divider"></div>


        <a class="item" href="{{ action('DashboardController@groups') }}">
          {{trans('messages.all_groups')}}
        </a>


        <div class="divider"></div>

        <a class="item" href="{{ action('GroupController@create') }}">
          <i class="bolt icon"></i> {{ trans('group.create_a_group_button') }}
        </a>
      </div>

    @endif

  </div>




  @if ($user_logged)
    <div class="item">
      <form role="search" action="{{url('search')}}">
        <div class="ui icon input">
          <input placeholder="{{trans('messages.search')}}..." type="text" name="query">
          <i class="circular search link icon"></i>
        </div>
      </form>
    </div>



    <div class="ui simple dropdown item">

      <img src="{{Auth::user()->avatar()}}"/> {{ Auth::user()->name }} <i class="dropdown icon"></i>
      <div class="menu">
        <a class="item" href="{{action('UserController@show', $user->id)}}"><i class="fa fa-btn fa-user"></i> {{ trans('messages.profile') }}</a>
        <a class="item" href="{{action('UserController@edit', $user->id)}}"><i class="fa fa-btn fa-edit"></i> {{ trans('messages.edit_my_profile') }}</a>
        <a class="item" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('messages.logout') }}</a>
      </div>

      @if ($user->isAdmin())
        <div class="ui simple dropdown item">
          Admin <i class="dropdown icon"></i>

          <div class="menu">

            <a class="item" href="{{ url('/admin/user') }}">Users</a>
            <a class="item" href="{{ url('/translations') }}">Translations</a>
            <a class="item" href="{{ url('/admin/logs') }}">Logs</a>
          </div>

        @endif
      </div>

    @else
      <a class="item" href="{{ url('register') }}">{{ trans('messages.register') }}</a>
      <a class="item" href="{{ url('login') }}">{{ trans('messages.login') }}</a>
    @endif

    @if(\Config::has('app.locales'))
      <div class="ui simple dropdown item">

        {{ strtoupper(app()->getLocale()) }} <i class="dropdown icon"></i>

        <div class="menu">
          @foreach(\Config::get('app.locales') as $lang => $locale)
            @if($lang !== app()->getLocale())

              <a class="item" href="<?= count($_GET) ? '?'.http_build_query(array_merge($_GET, ['force_locale' => $lang])) : '?force_locale='.$lang ?>">
                <?= strtoupper($lang); ?>
              </a>

            @endif
          @endforeach
        </div>

      </div>


    @endif
  </div>

</div>


@if (isset($user->verified) && ($user->verified == 0))
  <div class="container">
    <div class="alert alert-warning alert-dismissible fade in" id="message">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <i class="fa fa-info-circle"></i>
      {{trans('messages.email_not_verified')}}
      <br/>
      <a style="font-size: 0.6em" href="{{action('UserController@sendVerificationAgain', $user->id)}}">{{trans('messages.email_not_verified_send_again_verification')}}</a>
    </div>
  </div>
@endif

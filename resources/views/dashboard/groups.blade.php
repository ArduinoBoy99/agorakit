@extends('app')

@section('content')

  <div class="page_header">
    <h1><a href="{{ action('DashboardController@index') }}"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right"></i> {{ trans('messages.all_groups') }}</h1>
  </div>

  <div class="ui four stackable cards">


    @forelse( $groups as $group )
      <a class="card" href="{{ action('GroupController@show', $group->id) }}">
        <div class="image">
          <img src="{{action('GroupController@cover', $group->id)}}"/>
        </div>

        <div class="content">
          <div class="header">
            {{ $group->name }}
            @if ($group->isPublic())
              <i class="globe icon" title="{{trans('group.open')}}"></i>
            @else
              <i class="lock icon" title="{{trans('group.closed')}}"></i>
            @endif

          </div>
          <div class="meta">
            {{ summary($group->body, 150) }}
          </div>
        </div>
      </a>

    @empty
      {{trans('group.no_group_yet')}}
    @endforelse

    <a class="card" href="{{ action('GroupController@create') }}">
      <div class="image">
        <div style="margin: auto; text-align: center; width: 100%; height:auto;"><i class="fa fa-plus-circle" style="font-size: 150px;" aria-hidden="true"></i></div>
      </div>

      <div class="content">
        <div class="header">
          <a href="{{ action('GroupController@create') }}">{{ trans('group.your_group_here') }}</a>
        </div>
        <div class="description">{{ trans('group.create_a_group_intro') }}</div>
      </div>
    </a>

  </div>



@endsection

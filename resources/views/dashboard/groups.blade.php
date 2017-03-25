@extends('app')

@section('content')


    <div class="ui massive breadcrumb">

        <a class="section" href="{{ action('DashboardController@index') }}">
            <i class="home icon"></i>
        </a>
        <i class="right chevron icon divider"></i>
        <div class="active section">{{ trans('messages.all_groups') }}</div>
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
                    <div class="description">
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
                    {{ trans('group.your_group_here') }}
                </div>
                <div class="description">
                    {{ trans('group.create_a_group_intro') }}
                </div>
            </div>

        </a>

    </div>



@endsection

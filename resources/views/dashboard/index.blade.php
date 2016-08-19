@extends('adminlte::page')


@section('content_header')
    <h1><i class="fa fa-home"></i>
        {{Config::get('mobilizator.name')}}
    </h1>
@stop




@section('content')
    {!! setting('homepage_presentation', trans('documentation.intro')) !!}

    @if (Auth::check())
        <a class="btn btn-primary btn-xs" href="{{action('SettingsController@settings')}}">
            <i class="fa fa-pencil"></i> {{trans('messages.modify_intro_text')}}
        </a>
    @endif




    <div>
        <h1>MY *** {{ trans('messages.latest_discussions') }}</h1>
        <table class="table table-hover special">
            <thead>
                <tr>
                    <th style="width: 75%">{{ trans('messages.title') }}</th>
                    <th>{{ trans('messages.date') }}</th>
                    <th>{{ trans('messages.to_read') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $my_discussions as $discussion )
                    <tr>
                        <td class="content">
                            <a href="{{ action('DiscussionController@show', [$discussion->group_id, $discussion->id]) }}">
                                <span class="name">{{ $discussion->name }}</span>
                                <span class="summary">{{ summary($discussion->body) }}</span>
                            </a>
                            <br/>
                            <span class="group-name"><a href="{{ action('GroupController@show', [$discussion->group_id]) }}">{{ $discussion->group->name }}</a></span>
                        </td>

                        <td>
                            {{ $discussion->updated_at->diffForHumans() }}
                        </td>

                        <td>
                            @if ($discussion->unReadCount() > 0)
                                <i class="fa fa-comment"></i>
                                <span class="badge">{{ $discussion->unReadCount() }}</span>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div>
        <h1>{{ trans('messages.latest_discussions') }}</h1>
        <table class="table table-hover special">
            <thead>
                <tr>
                    <th style="width: 75%">{{ trans('messages.title') }}</th>
                    <th>{{ trans('messages.date') }}</th>
                    <th>{{ trans('messages.to_read') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $all_discussions as $discussion )
                    <tr>
                        <td class="content">
                            <a href="{{ action('DiscussionController@show', [$discussion->group_id, $discussion->id]) }}">
                                <span class="name">{{ $discussion->name }}</span>
                                <span class="summary">{{ summary($discussion->body) }}</span>
                            </a>
                            <br/>
                            <span class="group-name"><a href="{{ action('GroupController@show', [$discussion->group_id]) }}">{{ $discussion->group->name }}</a></span>
                        </td>

                        <td>
                            {{ $discussion->updated_at->diffForHumans() }}
                        </td>

                        <td>
                            @if ($discussion->unReadCount() > 0)
                                <i class="fa fa-comment"></i>
                                <span class="badge">{{ $discussion->unReadCount() }}</span>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <div>
        <h1>MY *** {{ trans('messages.latest_actions') }}</h1>
        <table class="table table-hover special">
            <thead>
                <tr>
                    <th style="width: 50%">{{ trans('messages.title') }}</th>
                    <th>{{ trans('messages.date') }}</th>
                    <th>{{ trans('messages.where') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $my_actions as $action )
                    <tr>
                        <td class="content">
                            <a href="{{ action('ActionController@show', [$action->group_id, $action->id]) }}">
                                <span class="name">{{ $action->name }}</span>
                                <span class="summary">{{ summary($action->body) }}</span>
                            </a>
                            <br/>
                            <span class="group-name"><a href="{{ action('GroupController@show', [$action->group_id]) }}">{{ $action->group->name }}</a></span>
                        </td>

                        <td>
                            {{$action->start->format('d/m/Y H:i')}}
                        </td>

                        <td class="content">
                            {{$action->location}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <div>
        <h1>All {{ trans('messages.latest_actions') }}</h1>
        <table class="table table-hover special">
            <thead>
                <tr>
                    <th style="width: 50%">{{ trans('messages.title') }}</th>
                    <th>{{ trans('messages.date') }}</th>
                    <th>{{ trans('messages.where') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $all_actions as $action )
                    <tr>
                        <td class="content">
                            <a href="{{ action('ActionController@show', [$action->group_id, $action->id]) }}">
                                <span class="name">{{ $action->name }}</span>
                                <span class="summary">{{ summary($action->body) }}</span>
                            </a>
                            <br/>
                            <span class="group-name"><a href="{{ action('GroupController@show', [$action->group_id]) }}">{{ $action->group->name }}</a></span>
                        </td>

                        <td>
                            {{$action->start->format('d/m/Y H:i')}}
                        </td>

                        <td class="content">
                            {{$action->location}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>




    @if ($my_groups)
        <div>
            <h1>{{ trans('messages.my_groups') }}</h1>

            <div class="row">
                @forelse( $my_groups as $group )

                    <li><a href="{{ action('GroupController@show', $group->id) }}">{{$group->name}}</a></li>

                @empty
                    <p>{{trans('group.no_group_joined_yet')}}</p>
                @endforelse
            </div>

        </div>
    @endif




    <div>

        <h1>{{ trans('messages.all_groups') }}</h1>


        <div class="row">
            @forelse( $all_groups as $group )
                <div class="col-xs-6 col-md-3">
                    <div class="thumbnail group">
                        <a href="{{ action('GroupController@show', $group->id) }}">
                            <img src="{{action('GroupController@cover', $group->id)}}"/>
                        </a>
                        <div class="caption">
                            <h4><a href="{{ action('GroupController@show', $group->id) }}">{{ $group->name }}</a></h4>
                            <p class="summary">{{ summary($group->body, 150) }}</p>
                            <p>



                                @unless ($group->isMember())
                                    <a class="btn btn-primary" href="{{ action('MembershipController@join', $group->id) }}"><i class="fa fa-sign-in"></i>
                                        {{ trans('group.join') }}</a>
                                    @endunless

                                    <a class="btn btn-primary" href="{{ action('GroupController@show', $group->id) }}">{{ trans('group.visit') }}</a>

                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    {{trans('group.no_group_yet')}}
                @endforelse

                <div class="col-xs-6 col-md-3">
                    <div class="thumbnail group">
                        <a href="{{ action('GroupController@create') }}">
                            <div style="margin: auto; text-align: center; width: 100%; height:auto;"><i class="fa fa-plus-circle" style="font-size: 150px;" aria-hidden="true"></i></div>

                        </a>
                        <div class="caption">
                            <h4><a href="{{ action('GroupController@create') }}">{{ trans('group.your_group_here') }}</a></h4>
                            <p class="summary">{{ trans('group.create_a_group_intro') }}</p>
                            <p>

                                <a class="btn btn-primary" href="{{ action('GroupController@create') }}">{{ trans('group.create') }}</a>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

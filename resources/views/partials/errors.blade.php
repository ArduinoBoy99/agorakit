@if (count($errors) > 0)
    <div class="ui error message">
        <div class="header">
            <i class="fa fa-exclamation-triangle"></i>
            {{ trans('messages.howdy') }} {{ trans('messages.something_wrong') }}
        </div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if ( Session::has('message') )
    <div class="ui message">
        <div class="header">
            {!! Session::get('message') !!}
        </div>
    </div>
@endif


@if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible fade in" id="error">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-exclamation-triangle"></i>
        {{ Session::get('error') }}
    </div>
@endif



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

@include('flash::messages')

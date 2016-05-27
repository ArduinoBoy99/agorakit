<?php $__env->startSection('content'); ?>

    <div class="page_header">
        <h1><i class="fa fa-home"></i>
            <?php echo e(Config::get('mobilizator.name')); ?>

        </h1>
    </div>


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">

        <li role="presentation" <?php if ( ! (Auth::check())): ?> class="active" <?php endif; ?>>
            <a href="#presentation" aria-controls="presentation" role="tab" data-toggle="tab">
                <i class="fa fa-info-circle"></i>
                <span class="hidden-sm hidden-xs"><?php echo e(trans('messages.presentation')); ?></span>
            </a>
        </li>

        <li role="presentation" <?php if(Auth::check()): ?> class="active" <?php endif; ?>>
            <a href="#discussions" aria-controls="discussions" role="tab" data-toggle="tab">
                <i class="fa fa-comments"></i>
                <span class="hidden-sm hidden-xs"><?php echo e(trans('messages.latest_discussions')); ?></span>
            </a>
        </li>
        <li role="presentation">
            <a href="#actions" aria-controls="actions" role="tab" data-toggle="tab">
                <i class="fa fa-calendar"></i>
                <span class="hidden-sm hidden-xs"><?php echo e(trans('group.latest_actions')); ?></span>
            </a>
        </li>

        <?php if($my_groups): ?>
            <li role="presentation">
                <a href="#mygroups" aria-controls="groups" role="tab" data-toggle="tab">
                    <i class="fa fa-cube"></i>
                    <span class="hidden-sm hidden-xs"><?php echo e(trans('messages.my_groups')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <li role="presentation">
            <a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">
                <i class="fa fa-cubes"></i>
                <span class="hidden-sm hidden-xs"><?php echo e(trans('messages.all_groups')); ?></span>
            </a>
        </li>

    </ul>

    <div class="tab_content">

        <!-- Tab panes -->
        <div class="tab-content">


            <div role="tabpanel" class="tab-pane <?php if ( ! (Auth::check())): ?> active <?php endif; ?>" id="presentation">
                <?php echo setting('homepage_presentation', trans('documentation.intro')); ?>


                <?php if(Auth::check()): ?>
                    <a class="btn btn-primary btn-xs" href="<?php echo e(action('SettingsController@settings')); ?>">
                        <i class="fa fa-pencil"></i> <?php echo e(trans('messages.modify_intro_text')); ?>

                    </a>
                <?php endif; ?>
            </div>



            <div role="tabpanel" class="tab-pane <?php if(Auth::check()): ?> active <?php endif; ?>" id="discussions">
                <h1><?php echo e(trans('messages.latest_discussions')); ?></h1>

                <?php if(Auth::check() && Auth::user()->getPreference('show', 'all') == 'all'): ?>

                    <?php echo e(trans('messages.you_see_all')); ?>

                    <a href="<?php echo e(action('DashboardController@index')); ?>?show=my"><?php echo e(trans('messages.show_only_my_groups')); ?></a>
                <?php endif; ?>

                <?php if(Auth::check() && Auth::user()->getPreference('show', 'all') == 'my'): ?>
                    <?php echo e(trans('messages.you_see_only_your_stuff')); ?>

                    <a href="<?php echo e(action('DashboardController@index')); ?>?show=all"><?php echo e(trans('messages.show_all')); ?></a>
                <?php endif; ?>

                <table class="table table-hover special">
                    <thead>
                        <tr>
                            <th style="width: 75%"><?php echo e(trans('messages.title')); ?></th>
                            <th><?php echo e(trans('messages.date')); ?></th>
                            <th><?php echo e(trans('messages.to_read')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach( $all_discussions as $discussion ): ?>
                            <tr>
                                <td class="content">
                                    <a href="<?php echo e(action('DiscussionController@show', [$discussion->group_id, $discussion->id])); ?>">
                                        <span class="name"><?php echo e($discussion->name); ?></span>
                                        <span class="summary"><?php echo e(summary($discussion->body)); ?></span>
                                    </a>
                                    <br/>
                                    <span class="group-name"><a href="<?php echo e(action('GroupController@show', [$discussion->group_id])); ?>"><?php echo e($discussion->group->name); ?></a></span>
                                </td>

                                <td>
                                    <?php echo e($discussion->updated_at->diffForHumans()); ?>

                                </td>

                                <td>
                                    <?php if($discussion->unReadCount() > 0): ?>
                                        <i class="fa fa-comment"></i>
                                        <span class="badge"><?php echo e($discussion->unReadCount()); ?></span>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>


            <div role="tabpanel" class="tab-pane" id="actions">
                <h1><?php echo e(trans('group.latest_actions')); ?></h1>

                <?php if(Auth::check() && Auth::user()->getPreference('show', 'all') == 'all'): ?>
                    <?php echo e(trans('messages.you_see_all')); ?>

                    <a class="btn btn-default btn-sm" href="<?php echo e(action('DashboardController@index')); ?>?show=my"><?php echo e(trans('messages.show_only_my_groups')); ?></a>
                <?php endif; ?>

                <?php if(Auth::check() && Auth::user()->getPreference('show', 'all') == 'my'): ?>
                    <?php echo e(trans('messages.you_see_only_your_stuff')); ?>

                    <a class="btn btn-default btn-sm" href="<?php echo e(action('DashboardController@index')); ?>?show=all"><?php echo e(trans('messages.show_all')); ?></a>
                <?php endif; ?>

                <table class="table table-hover special">
                    <thead>
                        <tr>
                            <th style="width: 50%"><?php echo e(trans('messages.title')); ?></th>
                            <th><?php echo e(trans('messages.date')); ?></th>
                            <th><?php echo e(trans('messages.where')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach( $all_actions as $action ): ?>
                            <tr>
                                <td class="content">
                                    <a href="<?php echo e(action('ActionController@show', [$action->group_id, $action->id])); ?>">
                                        <span class="name"><?php echo e($action->name); ?></span>
                                        <span class="summary"><?php echo e(summary($action->body)); ?></span>
                                    </a>
                                    <br/>
                                    <span class="group-name"><a href="<?php echo e(action('GroupController@show', [$action->group_id])); ?>"><?php echo e($action->group->name); ?></a></span>
                                </td>

                                <td>
                                    <?php echo e($action->start->format('d/m/Y H:i')); ?>

                                </td>

                                <td class="content">
                                    <?php echo e($action->location); ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>

            <?php if($my_groups): ?>
                <div role="tabpanel" class="tab-pane" id="mygroups">

                    <h1><?php echo e(trans('messages.my_groups')); ?></h1>

                    <div class="row">
                        <?php $__empty_1 = true; foreach( $my_groups as $group ): $__empty_1 = false; ?>

                            <div class="col-xs-6 col-md-3">
                                <div class="thumbnail group">
                                    <a href="<?php echo e(action('GroupController@show', $group->id)); ?>">
                                        <img src="<?php echo e(action('GroupController@cover', $group->id)); ?>"/>
                                    </a>
                                    <div class="caption">
                                        <h4><a href="<?php echo e(action('GroupController@show', $group->id)); ?>"><?php echo e($group->name); ?></a></h4>
                                        <p class="summary"><?php echo e(summary($group->body, 150)); ?></p>
                                        <p>
                                            <a class="btn btn-primary" href="<?php echo e(action('MembershipController@leave', $group->id)); ?>">
                                                <i class="fa fa-sign-out"></i><?php echo e(trans('group.leave')); ?>

                                            </a>
                                            <a class="btn btn-primary" href="<?php echo e(action('GroupController@show', $group->id)); ?>">
                                                <?php echo e(trans('group.visit')); ?>

                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; if ($__empty_1): ?>
                            <p><?php echo e(trans('group.no_group_joined_yet')); ?></p>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endif; ?>




            <div role="tabpanel" class="tab-pane" id="groups">

                <h1><?php echo e(trans('messages.all_groups')); ?></h1>


                <div class="row">
                    <?php $__empty_1 = true; foreach( $groups as $group ): $__empty_1 = false; ?>
                        <div class="col-xs-6 col-md-3">
                            <div class="thumbnail group">
                                <a href="<?php echo e(action('GroupController@show', $group->id)); ?>">
                                    <img src="<?php echo e(action('GroupController@cover', $group->id)); ?>"/>
                                </a>
                                <div class="caption">
                                    <h4><a href="<?php echo e(action('GroupController@show', $group->id)); ?>"><?php echo e($group->name); ?></a></h4>
                                    <p class="summary"><?php echo e(summary($group->body, 150)); ?></p>
                                    <p>



                                        <?php if ( ! ($group->isMember())): ?>
                                            <a class="btn btn-primary" href="<?php echo e(action('MembershipController@join', $group->id)); ?>"><i class="fa fa-sign-in"></i>
                                                <?php echo e(trans('group.join')); ?></a>
                                            <?php endif; ?>

                                            <a class="btn btn-primary" href="<?php echo e(action('GroupController@show', $group->id)); ?>"><?php echo e(trans('group.visit')); ?></a>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; if ($__empty_1): ?>
                            <?php echo e(trans('group.no_group_yet')); ?>

                        <?php endif; ?>

                        <div class="col-xs-6 col-md-3">
                            <div class="thumbnail group">
                                <a href="<?php echo e(action('GroupController@create')); ?>">
                                    <div style="margin: auto; text-align: center; width: 100%; height:auto;"><i class="fa fa-plus-circle" style="font-size: 150px;" aria-hidden="true"></i></div>

                                </a>
                                <div class="caption">
                                    <h4><a href="<?php echo e(action('GroupController@create')); ?>"><?php echo e(trans('group.your_group_here')); ?></a></h4>
                                    <p class="summary"><?php echo e(trans('group.create_a_group_intro')); ?></p>
                                    <p>

                                        <a class="btn btn-primary" href="<?php echo e(action('GroupController@create')); ?>"><?php echo e(trans('group.create')); ?></a>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
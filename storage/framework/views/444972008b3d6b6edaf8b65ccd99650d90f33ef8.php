<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo e(url('/home')); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>ZT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><?php echo e(Config::get('mobilizator.name')); ?></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?php echo e(trans('messages.toggle_navigation')); ?></span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li>
                    <a href="<?php echo e(action('DashboardController@agenda')); ?>">
                        <?php echo e(trans('group.latest_actions')); ?>

                    </a>
                </li>

                <?php if(Auth::check()): ?>
                    <li>
                        <a href="<?php echo e(action('DashboardController@unreadDiscussions')); ?>">
                            <?php echo e(trans('messages.latest_discussions')); ?>

                            <?php if($unread_discussions > 0): ?> <span class="badge"><?php echo e($unread_discussions); ?></span><?php endif; ?>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(trans('messages.your_groups')); ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php $__empty_1 = true; foreach($user_groups as $user_group): $__empty_1 = false; ?>
                                    <li><a href="<?php echo e(action('GroupController@show', $user_group->id)); ?>"><?php echo e($user_group->name); ?></a></li>
                                <?php endforeach; if ($__empty_1): ?>
                                    <li><a href="<?php echo e(action('DashboardController@index')); ?>"><?php echo e(trans('membership.not_subscribed_to_group_yet')); ?></a></li>
                                <?php endif; ?>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo e(action('GroupController@create')); ?>">
                                    <i class="fa fa-bolt"></i> <?php echo e(trans('group.create_a_group_button')); ?></a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo e(action('DashboardController@users')); ?>">
                                <?php echo e(trans('messages.users_list')); ?>

                            </a>
                        </li>
                    <?php endif; ?>


                    <?php if($user_logged): ?>

                        <form class="navbar-form navbar-left" role="search" action="<?php echo e(url('search')); ?>">
                            <div class="input-group">
                                <input type="text" name="query" class="form-control" placeholder="<?php echo e(trans('messages.search')); ?>...">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </span>
                            </div><!-- /input-group -->
                        </form>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="avatar"><img src="<?php echo e(Auth::user()->avatar()); ?>" class="img-circle" style="width:24px; height:24px"/></span> <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(action('UserController@show', $user->id)); ?>"><i class="fa fa-btn fa-user"></i> <?php echo e(trans('messages.profile')); ?></a></li>
                                <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i> <?php echo e(trans('messages.logout')); ?></a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="<?php echo e(url('register')); ?>"><?php echo e(trans('messages.register')); ?></a></li>
                        <li><a href="<?php echo e(url('login')); ?>"><?php echo e(trans('messages.login')); ?></a></li>
                    <?php endif; ?>

                    <?php if(\Config::has('app.locales')): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(strtoupper(app()->getLocale())); ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach(\Config::get('app.locales') as $lang => $locale): ?>
                                    <?php if($lang !== app()->getLocale()): ?>
                                        <li>
                                            <a href="<?= count($_GET) ? '?'.http_build_query(array_merge($_GET, ['force_locale' => $lang])) : '?force_locale='.$lang ?>">
                                                <?= strtoupper($lang); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>


                    <!-- Tasks Menu -->
                    <li class="dropdown tasks-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo e(trans('adminlte_lang::message.tasks')); ?></li>
                            <li>
                                <!-- Inner menu: contains the tasks -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <!-- Task title and progress text -->
                                            <h3>
                                                <?php echo e(trans('adminlte_lang::message.tasks')); ?>

                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <!-- The progress bar -->
                                            <div class="progress xs">
                                                <!-- Change the css width attribute to simulate progress -->
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% <?php echo e(trans('adminlte_lang::message.complete')); ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#"><?php echo e(trans('adminlte_lang::message.alltasks')); ?></a>
                            </li>
                        </ul>
                    </li>
                    <?php if(Auth::guest()): ?>
                        <li><a href="<?php echo e(url('/register')); ?>"><?php echo e(trans('adminlte_lang::message.register')); ?></a></li>
                        <li><a href="<?php echo e(url('/login')); ?>"><?php echo e(trans('adminlte_lang::message.login')); ?></a></li>
                    <?php else: ?>
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?php echo e(asset('/img/user2-160x160.jpg')); ?>" class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?php echo e(asset('/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo e(Auth::user()->name); ?>

                                        <small><?php echo e(trans('adminlte_lang::message.login')); ?> Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#"><?php echo e(trans('adminlte_lang::message.followers')); ?></a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#"><?php echo e(trans('adminlte_lang::message.sales')); ?></a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#"><?php echo e(trans('adminlte_lang::message.friends')); ?></a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat"><?php echo e(trans('adminlte_lang::message.profile')); ?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo e(url('/logout')); ?>" class="btn btn-default btn-flat"><?php echo e(trans('adminlte_lang::message.signout')); ?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

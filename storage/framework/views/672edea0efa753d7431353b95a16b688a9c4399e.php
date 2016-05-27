<?php $__env->startSection('content'); ?>

    <div class="page_header">
        <h1><a href="<?php echo e(action('DashboardController@index')); ?>"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right"></i> <?php echo e(trans('messages.users')); ?></h1>
    </div>

    <div class="tab_content">
        <div class="users_list">
            <?php if($users): ?>
                <?php foreach( $users->chunk(3) as $users_rows): ?>
                    <div class="row">
                        <?php foreach( $users_rows as $user): ?>
                            <div class="col-xs-12 col-md-4 col">
                                <div class="user">
                                    <a href="<?php echo e(action('UserController@show', $user)); ?>">
                                        <img src="<?php echo e($user->avatar()); ?>" class="img-circle" style="float:right; width:60px; height:60px"/>
                                    </a>
                                    <strong><a href="<?php echo e(action('UserController@show', $user)); ?>"><?php echo e($user->name); ?></a></strong>
                                    <div class="summary"><?php echo e(summary($user->body, 200)); ?></div>
                                    <?php if($user->groups->count() > 0): ?>
                                        <?php foreach($user->groups as $group): ?>
                                            <span class="label label-default"><a href="<?php echo e(action('GroupController@show', $group)); ?>"><?php echo e($group->name); ?></a></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <?php echo $users->render(); ?>

            <?php else: ?>
                <?php echo e(trans('messages.nothing_yet')); ?>

            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
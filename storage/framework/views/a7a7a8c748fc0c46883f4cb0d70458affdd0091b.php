<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.grouptab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="tab_content container">




        <h2><?php echo e(trans('group.about_this_group')); ?>  </h2>

        <div class="row">
            <div class="col-md-6">
                <?php echo filter($group->body); ?>


                <p>
                    <?php if (app('Illuminate\Contracts\Auth\Access\Gate')->check('update', $group)): ?>
                        <a class="btn btn-default btn-xs" href="<?php echo e(action('GroupController@edit', [$group->id])); ?>">
                            <i class="fa fa-pencil"></i>
                            <?php echo e(trans('messages.edit')); ?>

                        </a>
                    <?php endif; ?>


                    <?php if($group->revisionHistory->count() > 0): ?>
                        <a class="btn btn-default btn-xs" href="<?php echo e(action('GroupController@history', $group->id)); ?>">
                            <i class="fa fa-history"></i>
                            <?php echo e(trans('messages.show_history')); ?>

                        </a>
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-md-6">
                <img class="img-responsive img-rounded" src="<?php echo e(action('GroupController@cover', $group->id)); ?>"/>
            </div>
        </div>







        <h2><?php echo e(trans('group.latest_actions')); ?></h2>

        <?php if($actions->count() > 0): ?>
            <table class="table table-hover special">
                <thead>
                    <tr>
                        <th><?php echo e(trans('messages.date')); ?></th>
                        <th style="width: 75%"><?php echo e(trans('messages.title')); ?></th>

                        <th><?php echo e(trans('messages.where')); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($actions as $action): ?>
                        <tr>

                            <td>
                                <?php echo e($action->start->format('d/m/Y H:i')); ?>

                            </td>

                            <td class="content">
                                <a href="<?php echo e(action('ActionController@show', [$group->id, $action->id])); ?>">
                                    <span class="name"><?php echo e($action->name); ?></span>
                                    <span class="summary"><?php echo e(summary($action->body)); ?></span></a>
                                </td>

                                <td class="content">
                                    <?php echo e($action->location); ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <?php echo e(trans('messages.nothing_yet')); ?>

                <?php endif; ?>



                <h2><?php echo e(trans('group.latest_discussions')); ?></h2>

                <table class="table table-hover">
                    <?php $__empty_1 = true; foreach( $discussions as $discussion ): $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(action('DiscussionController@show', [$group->id, $discussion->id])); ?>"><?php echo e($discussion->name); ?></a>
                            </td>

                            <td>
                                <?php if ( ! (is_null ($discussion->user))): ?>
                                    <a href="<?php echo e(action('UserController@show', $discussion->user->id)); ?>"><?php echo e($discussion->user->name); ?></a>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="<?php echo e(action('DiscussionController@show', [$group->id, $discussion->id])); ?>"><?php echo e($discussion->updated_at->diffForHumans()); ?></a>
                            </td>

                            <td>
                                <?php if($discussion->unReadCount() > 0): ?>
                                    <i class="fa fa-comment"></i>
                                    <span class="badge"><?php echo e($discussion->unReadCount()); ?></span>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; if ($__empty_1): ?>
                        <?php echo e(trans('messages.nothing_yet')); ?>

                    <?php endif; ?>
                </table>







                <h2><?php echo e(trans('group.latest_files')); ?></h2>

                <table class="table table-hover">
                    <?php $__empty_1 = true; foreach($files as $file): $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(action('FileController@show', [$group->id, $file->id])); ?>"><img src="<?php echo e(action('FileController@thumbnail', [$group->id, $file->id])); ?>"/></a>
                            </td>

                            <td>
                                <a href="<?php echo e(action('FileController@show', [$group->id, $file->id])); ?>"><?php echo e($file->name); ?></a>
                            </td>

                            <td>
                                <a href="<?php echo e(action('FileController@show', [$group->id, $file->id])); ?>"><?php echo e(trans('file.download')); ?></a>
                            </td>

                            <td>
                                <?php if ( ! (is_null ($file->user))): ?>
                                    <a href="<?php echo e(action('UserController@show', $file->user->id)); ?>"><?php echo e($file->user->name); ?></a>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php echo e($file->created_at->diffForHumans()); ?>

                            </td>

                        </tr>
                    <?php endforeach; if ($__empty_1): ?>
                        <?php echo e(trans('messages.nothing_yet')); ?>


                    <?php endif; ?>
                </table>

            </div>

        <?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
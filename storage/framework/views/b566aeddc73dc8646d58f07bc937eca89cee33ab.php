<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.grouptab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="tab_content">

  <?php echo $__env->make('partials.invite', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
  <h2><?php echo e(trans('discussion.all_in_this_group')); ?>


    <?php if (app('Illuminate\Contracts\Auth\Access\Gate')->check('create-discussion', $group)): ?>
    <a class="btn btn-primary btn-xs" href="<?php echo e(action('DiscussionController@create', $group->id )); ?>">
      <i class="fa fa-plus"></i> <?php echo e(trans('discussion.create_one_button')); ?>

    </a>
    <?php endif; ?>
    </h2>

    <table class="table table-hover special">
      <thead>
        <tr>
          <th style="width: 75%">Titre</th>
          <th>Date</th>
          <th>A lire</th>
        </tr>
      </thead>

      <tbody>
        <?php $__empty_1 = true; foreach( $discussions as $discussion ): $__empty_1 = false; ?>
        <tr>

          <td class="content">
            <a href="<?php echo e(action('DiscussionController@show', [$discussion->group_id, $discussion->id])); ?>">
              <span class="name"><?php echo e($discussion->name); ?></span>
              <span class="summary"><?php echo e(summary($discussion->body)); ?></span>
            </a>
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
        <?php endforeach; if ($__empty_1): ?>
        <?php echo e(trans('messages.nothing_yet')); ?>

        <?php endif; ?>
      </tbody>
    </table>


    <?php echo $discussions->render(); ?>



  </div>




  <?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.grouptab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<div class="tab_content">

  <?php echo $__env->make('partials.invite', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <h2><?php echo e(trans('messages.files_in_this_group')); ?>


    <?php if (app('Illuminate\Contracts\Auth\Access\Gate')->check('create-file', $group)): ?>
    <a class="btn btn-primary btn-xs" href="<?php echo e(action('FileController@create', $group->id )); ?>">
      <i class="fa fa-plus"></i>
      <?php echo e(trans('messages.create_file_button')); ?>

    </a>
    <?php endif; ?>

  </h2>

  <p>
    <a class="btn btn-default btn-xs" href="<?php echo e(action('FileController@gallery', $group->id )); ?>">
      <i class="fa fa-camera-retro "></i>
      <?php echo e(trans('messages.show_gallery')); ?></a>
    </p>

    <table class="table table-hover">
      <?php $__empty_1 = true; foreach( $files as $file ): $__empty_1 = false; ?>
      <tr>

        <td>
          <a href="<?php echo e(action('FileController@show', [$group->id, $file->id])); ?>"><img src="<?php echo e(action('FileController@thumbnail', [$group->id, $file->id])); ?>"/></a>
        </td>

        <td>
          <a href="<?php echo e(action('FileController@show', [$group->id, $file->id])); ?>"><?php echo e($file->name); ?></a>
        </td>

        <td>
          <a class="btn btn-default btn-xs"href="<?php echo e(action('FileController@show', [$group->id, $file->id])); ?>">Download</a>

          <?php if (app('Illuminate\Contracts\Auth\Access\Gate')->check('delete', $file)): ?>
            <a class="btn btn-default btn-xs" href="<?php echo e(action('FileController@destroyConfirm', [$group->id, $file->id])); ?>"><i class="fa fa-trash"></i>
            <?php echo e(trans('messages.delete')); ?></a>
          <?php endif; ?>

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

    <?php echo $files->render(); ?>


  </div>


  <?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(count($errors) > 0): ?>
<div class="alert alert-danger">
  <strong><i class="fa fa-exclamation-triangle"></i><?php echo e(trans('messages.howdy')); ?></strong> <?php echo e(trans('messages.something_wrong')); ?><br><br>
  <ul>
    <?php foreach($errors->all() as $error): ?>
    <li><?php echo e($error); ?></li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>


<?php if( Session::has('message') ): ?>
<div class="alert alert-info alert-dismissible fade in" id="message">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <i class="fa fa-info-circle"></i>
    <?php echo Session::get('message'); ?>

  </div>
<?php endif; ?>


<?php if( Session::has('error') ): ?>
<div class="alert alert-danger alert-dismissible fade in" id="error">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <i class="fa fa-exclamation-triangle"></i>
    <?php echo e(Session::get('error')); ?>

  </div>
<?php endif; ?>

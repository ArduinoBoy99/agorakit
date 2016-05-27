<?php if(auth::guest()): ?>
  <div class="help" role="alert">
    <i class="fa fa-info-circle" aria-hidden="true"></i>
    <?php echo e(trans('messages.if_you_want_participate_in_this_group')); ?>

    <a href="<?php echo e(url('login')); ?>"><?php echo e(trans('messages.you_login')); ?></a>
    <?php echo e(trans('messages.or')); ?>

    <a href="<?php echo e(url('register')); ?>"><?php echo e(trans('messages.you_register')); ?></a>.
  </div>
<?php elseif(!auth::user()->isMemberOf($group)): ?>
  <div class="help" role="alert">
    <i class="fa fa-info-circle" aria-hidden="true"></i>
    <?php echo e(trans('messages.if_you_want_participate_in_this_group')); ?>

    <a href="<?php echo e(action('MembershipController@join', $group)); ?>">
      <?php echo e(trans('messages.join_this_group')); ?></a>
    </div>
  <?php endif; ?>

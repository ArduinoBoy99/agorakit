<div class="page_header">
  <h1>
    <a href="<?php echo e(action('DashboardController@index')); ?>"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right"></i>
    <?php if(isset($tab) && ($tab <> 'home')): ?>
      <a href="<?php echo e(action('GroupController@show', $group->id)); ?>"><?php echo e($group->name); ?></a>
    <?php else: ?>
      <?php echo e($group->name); ?>

    <?php endif; ?>
  </h1>
</div>

<ul class="nav nav-tabs">
  <li role="presentation" <?php if(isset($tab) && ($tab == 'home')): ?> class="active" <?php endif; ?>>
    <a href="<?php echo e(action('GroupController@show', $group->id)); ?>">
      <i class="fa fa-home"></i> <span class="hidden-xs hidden-sm"><?php echo e(trans('messages.group_home')); ?></span>
    </a>
  </li>

  <li role="presentation" <?php if(isset($tab) && ($tab == 'discussion')): ?> class="active" <?php endif; ?>>
    <a href="<?php echo e(action('DiscussionController@index', $group->id)); ?>">
      <i class="fa fa-comments"></i> <span class="hidden-xs hidden-sm"><?php echo e(trans('messages.discussions')); ?></span>
    </a>
  </li>

  <li role="presentation" <?php if(isset($tab) && ($tab == 'action')): ?> class="active" <?php endif; ?>>
    <a href="<?php echo e(action('ActionController@index', $group->id)); ?>">
      <i class="fa fa-calendar"></i> <span class="hidden-xs hidden-sm"><?php echo e(trans('messages.actions')); ?></span>
    </a>
  </li>

  <li role="presentation" <?php if(isset($tab) && ($tab == 'files')): ?> class="active" <?php endif; ?>>
    <a href="<?php echo e(action('FileController@index', $group->id)); ?>">
      <i class="fa fa-file-o"></i> <span class="hidden-xs hidden-sm"><?php echo e(trans('messages.files')); ?></span>
    </a>
  </li>

  <li role="presentation" <?php if(isset($tab) && ($tab == 'users')): ?> class="active" <?php endif; ?>>
    <a href="<?php echo e(action('UserController@index', $group->id)); ?>">
      <i class="fa fa-users"></i> <span class="hidden-xs hidden-sm"><?php echo e(trans('messages.members')); ?></span>
    </a>
  </li>

  <?php if($group->isMember()): ?>
    <li role="presentation" <?php if(isset($tab) && ($tab == 'settings')): ?> class="active" <?php endif; ?>>
      <a href="<?php echo e(action('MembershipController@settingsForm', $group->id)); ?>">
        <i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm"><?php echo e(trans('messages.settings')); ?></span>
      </a>
    </li>
  <?php else: ?>
    <li role="presentation" <?php if(isset($tab) && ($tab == 'settings')): ?> class="active" <?php endif; ?>>
      <a href="<?php echo e(action('MembershipController@joinForm', $group->id)); ?>">
        <i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm"><?php echo e(trans('messages.join')); ?></span>
      </a>
    </li>
  <?php endif; ?>

</ul>

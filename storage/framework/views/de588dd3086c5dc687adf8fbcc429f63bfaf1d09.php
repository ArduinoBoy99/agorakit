<?php $__env->startSection('footer'); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang-all.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>



<script>
$(document).ready(function() {
  $('#calendar').fullCalendar({
    lang: '<?php echo e(App::getLocale()); ?>',
    events: '<?php echo e(action('DashboardController@agendaJson')); ?>',
    header: {
      left: 'prev,next',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    eventClick:  function(event, jsEvent, view) {
      $('#modalTitle').html(event.title);
      $('#modal-body').html(event.body);
      $('#modal-location').html(String(event.location));
      $('#modal-start').html(event.start.format('LLL'));
      $('#modal-stop').html(event.end.format('LLL'));
      $('#eventUrl').attr('href',String(event.url));

      $('#modal-group-url').attr('href',String(event.group_url));
      $('#modal-group-url').html(String(event.group_name));

      $('#fullCalModal').modal();
      return false;
    },
  eventRender: function(event, element)
  {
    $(element).tooltip({title: event.group_name + ' : ' + event.title + ' : ' + event.summary});
  }
});
});
</script>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>



<div class="page_header">
  <h1><a href="<?php echo e(action('DashboardController@index')); ?>"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right"></i> <?php echo e(trans('messages.agenda')); ?></h1>
  <p>Si vous souhaitez ajouter des événements, rendez vous dans l'agenda d'un groupe précis</p>
</div>

<div class="tab_content">
<div id="calendar"></div>

<p><a href="<?php echo e(action('IcalController@index')); ?>">Téléchargez le calendrier au format iCal</a></p>

</div>

<div id="fullCalModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        <h4 id="modalTitle" class="modal-title"></h4>
      </div>

      <div class="modal-body">
        <p>
          <strong><?php echo e(trans('messages.description')); ?></strong> : <span id="modal-body"></span>
        </p>

        <strong><?php echo e(trans('messages.agenda')); ?> : </strong><a id="modal-group-url" target="_blank"></a>
        <br/>
        <strong><?php echo e(trans('messages.location')); ?> : </strong><span id="modal-location"></span>
        <br/>
        <strong><?php echo e(trans('messages.start')); ?> : </strong><span id="modal-start"></span>
        <br/>
        <strong><?php echo e(trans('messages.stop')); ?> : </strong><span id="modal-stop"></span>
        <br/>

      </div>

      <div class="modal-footer">
        <a class="btn btn-primary" id="eventUrl"><?php echo e(trans('messages.details')); ?></a>
      </div>

    </div>
  </div>
</div>

<!--

<?php if($actions): ?>
    <?php foreach( $actions as $action ): ?>
    <div class="action">
      <h2 class="name">
        <?php echo e($action->name); ?></a>
      </h2>

      <div class="meta"><?php echo e(trans('messages.started_by')); ?> <span class="user"><?php echo e($action->user->name); ?></span>, <?php echo e(trans('messages.in')); ?> <?php echo e($action->group->name); ?> <?php echo e($action->created_at->diffForHumans()); ?> </div>

      <h4><?php echo e(trans('messages.what')); ?> ?</h4>
      <p class="body">
        <?php echo e($action->body); ?>

      </p>
      <p><?php echo e(trans('messages.begins')); ?> : <?php echo e($action->start->format('d/m/Y H:i')); ?></p>
      <p><?php echo e(trans('messages.ends')); ?> : <?php echo e($action->stop->format('d/m/Y H:i')); ?></p>
      <p><?php echo e(trans('messages.location')); ?> : <?php echo e($action->location); ?></p>

    </div>
    <?php endforeach; ?>

  </tbody>
</table>
<?php else: ?>
<?php echo e(trans('messages.nothing_yet')); ?>

<?php endif; ?>

-->







<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
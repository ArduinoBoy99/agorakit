<?php $__env->startSection('footer'); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang-all.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>



<script>
$(document).ready(function() {
  $('#calendar').fullCalendar({
    lang: '<?php echo e(App::getLocale()); ?>',
    events: '<?php echo e(action('ActionController@indexJson', $group->id)); ?>',
    header: {
      left: 'prev,next',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },

    selectable: true,
		selectHelper: true,
    select: function(start, end) {
				var title = prompt('Titre de l\'action');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
          window.location.href = "<?php echo e(action('ActionController@create', $group->id )); ?>?start=" + encodeURIComponent(start.format('YYYY-MM-DD HH:mm')) + "&stop=" + encodeURIComponent(end.format('YYYY-MM-DD HH:mm')) + "&title=" + encodeURIComponent(title);
				}
        $('#calendar').fullCalendar('unselect');
			},

    eventClick:  function(event, jsEvent, view) {
      $('#modalTitle').html(event.title);
      $('#modal-body').html(event.body);
      $('#modal-location').html(String(event.location));
      $('#modal-start').html(event.start.format('LLL'));
      $('#modal-stop').html(event.end.format('LLL'));
      $('#eventUrl').attr('href',String(event.url));
      $('#fullCalModal').modal();
      return false;
    },

    eventRender: function(event, element)
    {
      $(element).tooltip({title: event.summary});
    }
  });
});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.grouptab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="tab_content">

  <?php echo $__env->make('partials.invite', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <h2><?php echo e(trans('action.agenda_of_this_group')); ?>

    <?php if (app('Illuminate\Contracts\Auth\Access\Gate')->check('create-action', $group)): ?>
    <a class="btn btn-primary btn-xs" href="<?php echo e(action('ActionController@create', $group->id )); ?>">
      <i class="fa fa-plus"></i> <?php echo e(trans('action.create_one_button')); ?>

    </a>
    <?php endif; ?>

  </h2>


  <div class="spacer"></div>



  <div id="calendar"></div>


  <p><a href="<?php echo e(action('IcalController@group', $group->id)); ?>">Téléchargez le calendrier de ce groupe au format iCal</a></p>


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







</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
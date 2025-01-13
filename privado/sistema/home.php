<?php
$msgSuccess = filter_input(INPUT_GET, 'msg_sucesso');
$msg = filter_input(INPUT_GET, 'msg');
if($msgSuccess) { ?>
	<script>
		$( document ).ready(function() {
			alertify.set('notifier','position', 'bottom-right');
			var msg = alertify.success('<?= $msgSuccess ?>', 0);

			$('body').one('click', function(){
				msg.dismiss();
			});

		});
	</script>
<?php } ?>

<?php if($msg) { ?>
	<script>
		$( document ).ready(function() {
			alertify.set('notifier','position', 'top-center');
			var msg = alertify.error('<?= $msg ?>', 0);

			$('body').one('click', function(){
				msg.dismiss();
			});

		});
	</script>
<?php } ?>

<div id="home" class="div-home" style="height: 600px; display: flex; flex-direction: column;  justify-content: center; align-items: center;">
	<img src="<?= $caminhoImg ?>/logo_inga_digital.png" style=" filter: grayscale(1); webkit-filter: grayscale(1); opacity: 0.5"/>
</div>

<!-- Chat do Movidesk -->
<script type="text/javascript">var mdChatClient="478C2850EC3048BC86BE160E407D3380";</script>
<script src="https://chat.movidesk.com/Scripts/chat-widget.min.js"></script>
<!-- Chat do Movidesk fim -->


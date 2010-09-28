<? $consumer = KFactory::get('site::com.oauthserver.model.consumers')->set('consumer_key', KRequest::get('get.client_id', 'string'))->getItem(); ?>

<? if (KFactory::get('lib.joomla.user')->guest) : ?>
	<p>Please login first</p>
<? else : ?>
	<p>Authorize <?=$consumer->name?> to access this site with your credentials</p>
	
	<form action="<?='index.php?option=com_oauthserver&view=code'?>" method="post" class="adminform" name="adminForm">	
		<input type="hidden" id="action" name="action" value="save" />
		<input type="hidden" id="oauthserver_consumer_id" name="oauthserver_consumer_id" value="<?=$consumer->id?>" />
		<input type="submit" value="Authorize">
	</form>
<? endif; ?>
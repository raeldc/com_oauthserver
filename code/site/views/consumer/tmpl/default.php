<? if ($consumer->id) : ?>
<h1>Edit application <?=$consumer->title?></h1>
<? else : ?>
<h1>Add application</h1>
<? endif; ?>

<a href="<?=@route('view=consumers')?>">Back to all consumers</a>
<br />

<form action="<?= 'index.php?option=com_oauthserver&view=consumer&id='.$consumer->id?>" method="post" class="adminform" name="adminForm">

	<h2>Name</h2>
	<p>
		<input type="text" value="<?=$consumer->name?>" id="name" name="name" />
	</p>
	
	<h2>consumer_key</h2>
	<p>
		<input type="text" value="<?=$consumer->consumer_key?>" id="consumer_key" name="consumer_key" />
	</p>
	
	<h2>consumer_secret</h2>
	<p>
		<input type="text" value="<?=$consumer->consumer_secret?>" id="consumer_secret" name="consumer_secret" />
	</p>
	
	<h2>redirect_uri</h2>
	<p>
		<input type="text" value="<?=$consumer->redirect_uri?>" id="redirect_uri" name="redirect_uri" />
	</p>
	
	<? if ($consumer->id) : ?>

		<input type="hidden" id="action" name="action" value="apply" />
		<input type="hidden" id="id" name="id" value="<?=$consumer->id?>" />

		<a class="readon">
			<button class="button validate" type="submit"><?=@text('Save changes')?></button>	
		</a>
	<? else: ?>
		<input type="hidden" id="action" name="action" value="save" />
		<a class="readon">
			<button class="button validate" type="submit"><?=@text('Add consumer')?></button>
		</a>
	<? endif;?>
</form>
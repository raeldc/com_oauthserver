<? if (!KFactory::get('lib.joomla.user')->guest) : ?>
	<a href="<?=@route('view=consumer')?>">Add application</a>
	
	<? if (count($consumers)) : ?>		
		<ul>
		    <? foreach ($consumers as $consumer) : ?>
		    	<!-- TODO: do this in a better way, while preserving accessing consumers via KFactory in other contexts -->
		    	<? if ($consumer->created_by == KFactory::get('lib.joomla.user')->id) : ?>
		    	<li>		
		    		<?=$consumer->name?>
		    		<a href="<?=@route('view=consumer&id='.$consumer->id)?>">Edit details</a>
				</li>
				<? endif ; ?>
			<? endforeach; ?>
		</ul>
	<? endif; ?>
<? else : ?>
Login first
<? endif; ?>
<ul>
<?php foreach($this->tLink as $sLibelle => $sLink): ?>
	<?php list($sModule,$foo)=explode(':',$sLink);?>
	
	<?php if( $sModule== _root::getModule() ):?>
		<li class="selectionne"><a href="<?php echo $this->getLink($sLink) ?>"><?php echo $sLibelle ?></a></li>
	<?php else:?>
		<li><a href="<?php echo $this->getLink($sLink) ?>"><?php echo $sLibelle ?></a></li>
	<?php endif;?>
	
<?php endforeach;?>
</ul>


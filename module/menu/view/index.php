<ul>
<?php foreach($this->tLink as $sLibelle => $sLink): ?>
	<?php if(is_array($sLink)){
		$tDetail=$sLink;
		$sLink=$tDetail[0];
		$tParam=$tDetail[1];
		$bLink=false;
	}else{
		$bLink=true;
	}
	?>
	
	<?php if($sLink == 'title'):?>
		<li class="title"><?php echo $sLibelle?></li>
	<?php elseif(_root::getParamNav()==$sLink):?>
		<li class="selectionne"><a href="<?php echo $this->getLink($sLink,$tParam) ?>"><?php echo $sLibelle ?></a></li>
	<?php elseif($bLink):?>
		<li><a href="<?php echo $sLink ?>"><?php echo $sLibelle ?></a></li>
	<?php else:?>
		<li><a href="<?php echo $this->getLink($sLink,$tParam) ?>"><?php echo $sLibelle ?></a></li>
	<?php endif;?>
	
<?php endforeach;?>
</ul>


 

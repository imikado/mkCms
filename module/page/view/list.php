<style>
	h2{
		margin:0px;
	}
	h4{
		text-align:right;margin:0px;
	}
</style>
	<?php if($this->tContent):?>
	<?php foreach($this->tContent as $oContent):?>
		
		<h2><?php echo $oContent->cont_title ?></h2>
		<h4><?php echo $oContent->cont_datetime?></h4>

		<p><?php echo $oContent->cont_text ?></p>

		 
		 
	<?php endforeach;?>
	<?php endif;?>



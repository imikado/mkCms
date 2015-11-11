<?php
$tIndexed=array();
if($this->tPictures){
	foreach($this->tPictures as $oPictures){
		$tIndexed[(string)$oPictures->directory][]=$oPictures;
	}
}

$directory=_root::getParam('directory');
?>
<style>
	.dir{
		background:url('css/images/directory.jpg') no-repeat;
		padding-left:20px;
	}
	.dir a{
		text-decoration:none;
	}
	.selected{
		font-weight: bold;
	}
	.image{
		background:url('css/images/file.jpg') no-repeat 20px 0px;
		width:30px;
		height: 14px;
	}
</style>

<table>
 
	<?php if($tIndexed):?>
		<?php foreach($tIndexed as $sCat => $tPictures):?>
			
			<?php if($directory==$sCat):?>
				<tr>
					<td class="dir selected" colspan="2"><a href="<?php echo _root::getLink('admin_picturespopup::list')?>"><?php echo str_replace('/',' / ',$sCat)?></a></td>

				</tr>
				<?php foreach($tPictures as $oPictures):?>
					<tr>
						<td class="image">&nbsp;&nbsp;</td>
						<td ><a href="<?php echo $this->getLink('admin_picturespopup::show',array(
																	'id'=>$oPictures->getId()
																) 
										)?>"><?php echo $oPictures->name ?></a></td>

					</tr>	
				<?php endforeach;?>
			<?php else:?>
				<tr>
					<td class="dir" colspan="2"><a href="<?php echo _root::getLink('admin_picturespopup::list',array('directory'=>$sCat))?>"><?php echo str_replace('/',' / ',$sCat)?></a></td>

				</tr>
			<?php endif;?>
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="4">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>



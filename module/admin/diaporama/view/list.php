<table class="tb_list">
	<tr>
		
		<th>nom</th>
		
		<th></th>
	</tr>
	<?php if($this->tDiaporama):?>
		<?php foreach($this->tDiaporama as $oDiaporama):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oDiaporama->nom ?></td>
		
			<td>
				
				
 
<a href="<?php echo $this->getLink('admin_diaporama::show',array(
										'id'=>$oDiaporama->getId()
									) 
							)?>">Show</a>

										| 
<a href="<?php echo $this->getLink('admin_diaporama::pictures',array(
										'id'=>$oDiaporama->getId()
									) 
							)?>">Ajouter photos</a>
			
				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="2">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a href="<?php echo $this->getLink('admin_diaporama::new') ?>">Nouveau diaporama</a></p>
			

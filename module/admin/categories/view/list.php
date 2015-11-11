<table class="tb_list">
	<tr>
		
		<th>Titre</th>

		<th></th>
	</tr>
	<?php if($this->tCategories):?>
		<?php foreach($this->tCategories as $oCategories):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oCategories->cat_title ?></td>

			<td>
				
				
<a href="<?php echo $this->getLink('admin_categories::edit',array(
										'id'=>$oCategories->getId()
									) 
							)?>">Modifier</a>
 

				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="2">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a href="<?php echo $this->getLink('admin_categories::new') ?>">New</a></p>


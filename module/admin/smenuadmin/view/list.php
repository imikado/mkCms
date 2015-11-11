<table class="tb_list">
	<tr>
		
		<th>Titre</th>

		<th>Ordre</th>

		<th>Type</th>

		<th>Page</th>

		<th>Categorie</th>

		<th>Menu</th>

		<th></th>
	</tr>
	<?php if($this->tSmenu):?>
		<?php foreach($this->tSmenu as $oSmenu):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oSmenu->smen_title ?></td>

		<td><?php echo $oSmenu->smen_order ?></td>

		<td><?php if(isset($this->tJoinmodel_type[$oSmenu->smen_type])){ echo $this->tJoinmodel_type[$oSmenu->smen_type];}else{ echo $oSmenu->smen_type ;}?></td>

		<td><?php if(isset($this->tJoinmodel_content[$oSmenu->content_id])){ echo $this->tJoinmodel_content[$oSmenu->content_id];}else{ echo $oSmenu->content_id ;}?></td>

		<td><?php if(isset($this->tJoinmodel_categories[$oSmenu->category_id])){ echo $this->tJoinmodel_categories[$oSmenu->category_id];}else{ echo $oSmenu->category_id ;}?></td>

		<td><?php if(isset($this->tJoinmodel_menu[$oSmenu->menu_id])){ echo $this->tJoinmodel_menu[$oSmenu->menu_id];}else{ echo $oSmenu->menu_id ;}?></td>

			<td>
				
				
<a href="<?php echo $this->getLink('admin_smenuadmin::edit',array(
										'id'=>$oSmenu->getId()
									) 
							)?>">Edit</a>
| 
<a href="<?php echo $this->getLink('admin_smenuadmin::delete',array(
										'id'=>$oSmenu->getId()
									) 
							)?>">Delete</a>
| 
<a href="<?php echo $this->getLink('admin_smenuadmin::show',array(
										'id'=>$oSmenu->getId()
									) 
							)?>">Show</a>

				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="7">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a href="<?php echo $this->getLink('admin_smenuadmin::new') ?>">New</a></p>


<h2>Par cat&eacute;gorie</h2>
<table class="tb_list">
	<tr>
		
		<th>Titre</th>

		 

		<th>Date</th>

		 

		<th>Categorie</th>

		<th></th>
	</tr>
	<?php if($this->tContent):?>
		<?php foreach($this->tContent as $oContent):?>
		<?php if(!$oContent->category_id):?>
			<?php continue;?>
		<?php endif;?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td style="width:370px;"><?php echo $oContent->cont_title ?></td>

 
		<td><?php echo $oContent->cont_datetime ?></td>


		<td><?php if(isset($this->tJoinmodel_categories[$oContent->category_id])){ echo $this->tJoinmodel_categories[$oContent->category_id];}else{ echo $oContent->category_id ;}?></td>

			<td>
				
				
<a href="<?php echo $this->getLink('admin_page::edit',array(
										'id'=>$oContent->getId()
									) 
							)?>">Modifier</a>


				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="6">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<h2 style="margin-top:20px">Sans cat&eacute;gorie</h2>
<table class="tb_list">
	<tr>
		
		<th style="width:370px;">Titre</th>

 
		<th>Date</th>

		 


		<th></th>
	</tr>
	<?php if($this->tContent):?>
		<?php foreach($this->tContent as $oContent):?>
		<?php if($oContent->category_id):?>
			<?php continue;?>
		<?php endif;?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oContent->cont_title ?></td>

 
		<td><?php echo $oContent->cont_datetime ?></td>

 

			<td>
				
				
<a href="<?php echo $this->getLink('admin_page::edit',array(
										'id'=>$oContent->getId()
									) 
							)?>">Modifier</a>
 

				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="6">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>




<p><a href="<?php echo $this->getLink('admin_page::new') ?>">Nouvelle page</a></p>


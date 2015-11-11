<table class="tb_list">
	<tr>
		
		<th>login</th>

		<th>pass</th>

		<th></th>
	</tr>
	<?php if($this->tUsers):?>
		<?php foreach($this->tUsers as $oUsers):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oUsers->login ?></td>

		<td><?php echo $oUsers->pass ?></td>

			<td>
				
				
<a href="<?php echo $this->getLink('users::edit',array(
										'id'=>$oUsers->getId()
									) 
							)?>">Edit</a>
| 
<a href="<?php echo $this->getLink('users::delete',array(
										'id'=>$oUsers->getId()
									) 
							)?>">Delete</a>
| 
<a href="<?php echo $this->getLink('users::show',array(
										'id'=>$oUsers->getId()
									) 
							)?>">Show</a>

				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="3">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a href="<?php echo $this->getLink('users::new') ?>">New</a></p>


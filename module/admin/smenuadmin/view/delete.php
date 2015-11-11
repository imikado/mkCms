<form action="" method="POST">
<table class="tb_delete">
	
	<tr>
		<th>smen_title</th>
		<td><?php echo $this->oSmenu->smen_title ?></td>
	</tr>

	<tr>
		<th>smen_order</th>
		<td><?php echo $this->oSmenu->smen_order ?></td>
	</tr>

	<tr>
		<th>smen_type</th>
		<td><?php echo $this->tJoinmodel_type[$this->oSmenu->smen_type]?></td>
	</tr>

	<tr>
		<th>content_id</th>
		<td><?php echo $this->tJoinmodel_content[$this->oSmenu->content_id]?></td>
	</tr>

	<tr>
		<th>category_id</th>
		<td><?php echo $this->tJoinmodel_categories[$this->oSmenu->category_id]?></td>
	</tr>

	<tr>
		<th>menu_id</th>
		<td><?php echo $this->tJoinmodel_menu[$this->oSmenu->menu_id]?></td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<input type="submit" value="Confirmer la suppression" /> <a href="<?php echo $this->getLink('admin_smenuadmin::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>


<input type="hidden" name="token" value="<?php echo $this->token?>" />
<?php if($this->tMessage and isset($this->tMessage['token'])): echo $this->tMessage['token']; endif;?>


</form>

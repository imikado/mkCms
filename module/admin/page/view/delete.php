<form action="" method="POST">
<table class="tb_delete">
	
	<tr>
		<th>Titre</th>
		<td><?php echo $this->oContent->cont_title ?></td>
	</tr>

	<tr>
		<th>Texte</th>
		<td><?php echo $this->oContent->cont_text ?></td>
	</tr>

	<tr>
		<th>Date</th>
		<td><?php echo $this->oContent->cont_datetime ?></td>
	</tr>

	<tr>
		<th>order</th>
		<td><?php echo $this->oContent->cont_order ?></td>
	</tr>

	<tr>
		<th>Categorie</th>
		<td><?php echo $this->tJoinmodel_categories[$this->oContent->category_id]?></td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<input type="submit" value="Confirmer la suppression" /> <a href="<?php echo $this->getLink('admin_page::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>


<input type="hidden" name="token" value="<?php echo $this->token?>" />
<?php if($this->tMessage and isset($this->tMessage['token'])): echo $this->tMessage['token']; endif;?>


</form>

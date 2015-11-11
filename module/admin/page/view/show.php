<table class="tb_show">
	
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
				<a href="<?php echo $this->getLink('admin_page::list')?>">Retour</a>
			</p>
		</td>
	</tr>
</table>

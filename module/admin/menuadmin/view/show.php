<table class="tb_show">
	
	<tr>
		<th>Titre</th>
		<td><?php echo $this->oMenu->men_title ?></td>
	</tr>

	<tr>
		<th>Ordre</th>
		<td><?php echo $this->oMenu->men_order ?></td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<a href="<?php echo $this->getLink('admin_menuadmin::list')?>">Retour</a>
			</p>
		</td>
	</tr>
</table>

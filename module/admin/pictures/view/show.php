<table class="tb_show">
	
	<tr>
		<th>Nom</th>
		<td><?php echo $this->oPictures->name ?></td>
	</tr>

	<tr>
		<th>Chemin</th>
		<td><input style="width:300px" type="text" value="<?php echo $this->oPictures->path ?>"/>
		</td>
	</tr>

	<tr>
		<th>Repertoire</th>
		<td><?php echo $this->oPictures->directory ?></td>
	</tr>
	
	<tr>
		<th></th>
		<td>
			<?php if(substr($this->oPictures->path,-4)=='.pdf'):?>
				[Ceci est un PDF (pas de previsualisation)]
			<?php else:?>
				<img style="width:200px" src="<?php echo $this->oPictures->path ?>" />
			<?php endif;?>
		</td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<a href="<?php echo $this->getLink('admin_pictures::list')?>">Retour</a>
			</p>
		</td>
	</tr>
</table>

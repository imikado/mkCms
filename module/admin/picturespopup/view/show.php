<script>
function mySubmit(url) {
    top.tinymce.activeEditor.windowManager.getParams().oninsert(url);
    top.tinymce.activeEditor.windowManager.close();
}
</script>


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
		<th></th>
		<td>
			<?php if(substr($this->oPictures->path,-4)=='.pdf'):?>
				[Ceci est un PDF (pas de previsualisation)]
			<?php else:?>
				<a href="#" onclick="mySubmit('<?php echo $this->oPictures->path?>')"><img style="width:100px" src="<?php echo $this->oPictures->path ?>" /></a>
			<?php endif;?>
		</td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<a href="<?php echo $this->getLink('admin_picturespopup::list')?>">Retour</a>
			</p>
		</td>
	</tr>
</table>

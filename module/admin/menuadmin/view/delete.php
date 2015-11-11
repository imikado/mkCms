<form action="" method="POST">
<table class="tb_delete">
	
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
				<input type="submit" value="Confirmer la suppression" /> <a href="<?php echo $this->getLink('admin_menuadmin::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>


<input type="hidden" name="token" value="<?php echo $this->token?>" />
<?php if($this->tMessage and isset($this->tMessage['token'])): echo $this->tMessage['token']; endif;?>


</form>

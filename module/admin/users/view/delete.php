<form action="" method="POST">
<table class="tb_delete">
	
	<tr>
		<th>login</th>
		<td><?php echo $this->oUsers->login ?></td>
	</tr>

	<tr>
		<th>pass</th>
		<td><?php echo $this->oUsers->pass ?></td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<input type="submit" value="Confirmer la suppression" /> <a href="<?php echo $this->getLink('users::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>


<input type="hidden" name="token" value="<?php echo $this->token?>" />
<?php if($this->tMessage and isset($this->tMessage['token'])): echo $this->tMessage['token']; endif;?>


</form>

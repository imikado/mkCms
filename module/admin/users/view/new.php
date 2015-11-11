<?php 
$oForm=new plugin_form($this->oUsers);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST" >

<table class="tb_new">
	
	<tr>
		<th>login</th>
		<td><?php echo $oForm->getInputText('login')?></td>
	</tr>

	<tr>
		<th>pass</th>
		<td><?php echo $oForm->getInputText('pass')?></td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<input type="submit" value="Ajouter" /> <a href="<?php echo $this->getLink('users::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>

<?php echo $oForm->getToken('token',$this->token)?>

</form>

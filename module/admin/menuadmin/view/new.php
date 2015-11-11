<?php 
$oForm=new plugin_form($this->oMenu);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST" >

<table class="tb_new">
	
	<tr>
		<th>Titre</th>
		<td><?php echo $oForm->getInputText('men_title')?></td>
	</tr>

	<tr>
		<th>Ordre</th>
		<td><?php echo $oForm->getInputText('men_order')?></td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<input type="submit" value="Ajouter" /> <a href="<?php echo $this->getLink('admin_menuadmin::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>

<?php echo $oForm->getToken('token',$this->token)?>

</form>

<?php 
$oForm=new plugin_form($this->oSmenu);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST" >
<table class="tb_edit">
	
	<tr>
		<th>Titre</th>
		<td><?php echo $oForm->getInputText('smen_title')?></td>
	</tr>

	<tr>
		<th>Ordre</th>
		<td><?php echo $oForm->getInputText('smen_order')?></td>
	</tr>

	<tr>
		<th>Menu parent</th>
		<td><?php echo $oForm->getSelect('menu_id',$this->tJoinmodel_menu);?></td>
	</tr>
	
	<tr>
		<th><br/>S&eacute;lectionnez</th>
		<td></td>
	</tr>

	<tr>
		<th><?php echo $oForm->getInputRadio('smen_type',0);?>Affiche une Page </th>
		<td><?php echo $oForm->getSelect('content_id',$this->tJoinmodel_content);?></td>
	</tr>
	
	<tr>
		<th> </th>
		<td>ou</td>
	</tr>

	<tr>
		<th><?php echo $oForm->getInputRadio('smen_type',1);?> Liste par Categorie </th>
		<td><?php echo $oForm->getSelect('category_id',$this->tJoinmodel_categories);?></td>
	</tr>
	<tr>
		<th> </th>
		<td>ou</td>
	</tr>

	<tr>
		<th><?php echo $oForm->getInputRadio('smen_type',2);?> Lien </th>
		<td><?php echo $oForm->getInputText('url');?></td>
	</tr>
	

	
	<tr>
		<th></th>
		<td>
			<p>
				<input type="submit" value="Modifier" /> <a href="<?php echo $this->getLink('admin_menuadmin::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>

<?php echo $oForm->getToken('token',$this->token)?>

</form>


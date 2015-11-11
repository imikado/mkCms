<style>
	p{
		text-align: left;
	}
</style>
<?php 
$oForm=new plugin_form($this->oSmenu);
$oForm->setMessage($this->tMessage);
?>
<p><a href="<?php echo _root::getLink('admin_menuadmin::list')?>">Liste</a> &gt;&gt; <?php echo $this->oMenu->men_title?></p>

<form action="" method="POST" >

<table class="tb_new">
	
	<tr>
		<th>Titre</th>
		<td><?php echo $oForm->getInputText('smen_title')?></td>
	</tr>

	<tr>
		<th>Order</th>
		<td><?php echo $oForm->getInputText('smen_order')?></td>
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
		<th><?php echo $oForm->getInputRadio('smen_type',2);?> Lien</th>
		<td><?php echo $oForm->getInputText('url');?></td>
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

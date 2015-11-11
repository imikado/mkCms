<style>
    .tb_new{
        width:580px;
    }
    .tb_new input,.tb_new textarea{
        width:460px;
    }.tb_new textarea{
     height:260px;   
    }
    .tb_new  .btn{
        width:auto;
    }
    
</style><?php 
$oForm=new plugin_form($this->oPictures);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST"  enctype="multipart/form-data">
<table class="tb_new">
	
	<tr>
		<th>Nom</th>
		<td><?php echo $oForm->getInputText('name')?></td>
	</tr>

	<tr>
		<th>Chemin</th>
		<td><?php echo $oForm->getInputUpload('path')?></td>
	</tr>

	<tr>
		<th>Repertoire</th>
		<td><?php echo $oForm->getInputText('directory')?></td>
	</tr>

	
	<tr>
		<th></th>
		<td>
			<p>
				<input class="btn" type="submit" value="Modifier" /> <a href="<?php echo $this->getLink('admin_pictures::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>

<?php echo $oForm->getToken('token',$this->token)?>

</form>


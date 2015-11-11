<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
function closePopup(){
	var a=getById('popup');
	if(a){
		a.style.display='none';
	}
}
function openPopup(){
	var a=getById('popup');
	if(a){
		a.style.display='block';
	}
}
function openPopupImage(fieldname){
	var a=getById('popup');
	if(a){
		a.style.display='block';
		var b=getById('myframe');
		if(b){
			b.src='<?php echo _root::getLink('admin_picturespopup::index')?>&fieldname='+fieldname;
		}
	}
}

tinymce.init({
    selector: "textarea",
	menubar: "edit insert view format table tools",
    plugins: [
        "autolink lists link image charmap preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	file_picker_callback: function(callback, value, meta) {
        myImagePicker(callback, value, meta);
    }
 });
 
 
 function myImagePicker(callback, value, meta) {
    tinymce.activeEditor.windowManager.open({
        title: 'Image Browser',
        url: '<?php echo _root::getLink('admin_picturespopup::index')?>&onclick=1&' + meta.filetype,
        width: 800,
        height: 550,
    }, {
        oninsert: function (url) {
            callback(url);
        }
    });
};
 function setValueById(field_name,value){
	var a=getById(field_name);
	if(a){
		a.value=value;
	}
 }
</script>
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
    #popup{
		position:absolute;
		top:150px;
		border:2px solid #000;
		background:white;
		display:none;
	}
	#popup iframe{
		width:400px;
		height:230px;
	}
	#popup p{
		background:#000;
		margin:0px;
		text-align: right;
		padding:3px;
	}
	#popup p a{
		color:#fff;
		text-decoration:none;
	}
</style>
<?php 
$oForm=new plugin_form($this->oContent);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST" >
<table class="tb_new">
	
	<tr>
		<th>Titre</th>
		<td><?php echo $oForm->getInputText('cont_title')?></td>
	</tr>

	<tr>
		<th></th>
		<td><p><a href="#" onclick="openPopup();return false;">Voir la mediath&egrave;que</a></p>
			<?php echo $oForm->getInputTextarea('cont_text')?></td>
	</tr>

	<tr>
		<th>Date</th>
		<td><?php echo $oForm->getInputDate('cont_datetime')?></td>
	</tr>

	<tr>
		<th>Ordre</th>
		<td><?php echo $oForm->getInputText('cont_order')?></td>
	</tr>

	<tr>
		<th>Categorie</th>
		<td><?php echo $oForm->getSelect('category_id',$this->tJoinmodel_categories);?></td>
	</tr> 

	
	<tr>
		<th></th>
		<td>
			<p>
				<input class="btn" type="submit" value="Modifier" /> <a href="<?php echo $this->getLink('admin_page::list')?>">Annuler</a>
			</p>
		</td>
	</tr>
</table>

<?php echo $oForm->getToken('token',$this->token)?>

</form>

<div id="popup">
	<p><a href="#" onclick="closePopup();">Fermer</a></p>
	<div >
		<iframe id="myframe" src="<?php echo _root::getLink('admin_picturespopup::index')?>"/>
	</div>
</div>
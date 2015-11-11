<h2><?php echo $this->oDiaporama->nom ?>/</h2>
<form action="" method="POST" enctype="multipart/form-data">
<p>S&eacute;lectionnez le repertoire contenant les photos</p>
<input type="file" name="tFileInput[]" id="tFileInput" multiple webkitdirectory="">


<p style="margin-top:30px"> <input type="submit" value="T&eacute;lecharger le repertoire"/></p>

			<p>
				<a href="<?php echo $this->getLink('admin_diaporama::list')?>">Retour</a>
			</p>
 </form>
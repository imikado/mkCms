<h2><?php echo $this->oDiaporama->nom ?>/</h2>


<?php foreach($this->tImg as $sImg): ?>
	<img src="<?php echo $this->uploadDir.$sImg?>" style="width:80px"/>
<?php endforeach;?>
		
	
<p>
<a href="<?php echo $this->getLink('admin_diaporama::list')?>">Retour</a>
</p>
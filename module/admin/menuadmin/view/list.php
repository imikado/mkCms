<style>
	p {
		text-align: left;
	}
	td{
		text-align: left;
	}
	td.noborder{
		border:0px;
	}
</style>
<table class="tb_list">
	<tr>
		
		<th colspan="2">Titre</th>

		<th>Ordre</th>
		
		<th>Type</th>

		<th></th>
	</tr>
	<?php if($this->tMenu):?>
		<?php foreach($this->tMenu as $oMenu):?>
			<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>

				<td colspan="2"><?php echo $oMenu->men_title ?></td>

				<td><?php echo $oMenu->men_order ?></td>

				<td></td>
				
				<td>


					<a href="<?php echo $this->getLink('admin_menuadmin::edit',array(
															'id'=>$oMenu->getId()
														) 
												)?>">Editer</a>
					| 
					<a href="<?php echo $this->getLink('admin_menuadmin::delete',array(
															'id'=>$oMenu->getId()
														) 
												)?>">Supprimer</a>
					 



				</td>
			</tr>

			<?php if(isset($this->tsMenu[$oMenu->id])):?>
				<?php foreach($this->tsMenu[$oMenu->id] as $oSMenu):?>
				<tr>
					<td class="noborder"></td>
					<td><?php echo $oSMenu->smen_title?></td>
					<td><?php echo $oSMenu->smen_order?></td>
					
					<td><?php echo plugin_tpl::getIfInTab($this->tJoinmodel_type, $oSMenu->smen_type)?>
						:
						<?php if($oSMenu->smen_type==model_type::CONTENT):
							echo plugin_tpl::getIfInTab($this->tJoinmodel_content,$oSMenu->content_id);
						elseif ($oSMenu->smen_type==model_type::BYCATEGORY):
							echo plugin_tpl::getIfInTab($this->tJoinmodel_categories,$oSMenu->category_id);
						elseif ($oSMenu->smen_type==model_type::URL):
							echo $oSMenu->url;

						endif;?>
					</td>
					
					<td>
							
						<a href="<?php echo $this->getLink('admin_smenuadmin::edit',array(
																'id'=>$oSMenu->getId()
															) 
													)?>">Editer</a>
						| 
						<a href="<?php echo $this->getLink('admin_smenuadmin::delete',array(
																'id'=>$oSMenu->getId()
															) 
													)?>">Supprimer</a>
					</td>
				</tr>
				<?php endforeach;?>
			<?php endif;?>
			<tr>
				<td class="noborder" colspan="4"></td>
				<td class="noborder" colspan="1"><a href="<?php echo $this->getLink('admin_smenuadmin::new',array('menu_id'=>$oMenu->id)) ?>">Nouveau sous menu</a></td>
			</tr>
			
			<tr>
				<td class="noborder" colspan="5">&nbsp;</td>
			</tr>
			
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="3">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a href="<?php echo $this->getLink('admin_menuadmin::new') ?>">Nouveau menu</a></p>


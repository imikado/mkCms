<table class="tb_show">
	
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
				<a href="<?php echo $this->getLink('users::list')?>">Retour</a>
			</p>
		</td>
	</tr>
</table>

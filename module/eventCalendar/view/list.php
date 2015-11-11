<style>
	.eventCalendar td{
		width:40px;
		height:40px;
		
		border:1px solid #c0dcf8;
	}
	.eventCalendar td p{
		text-align:right;
		background:#ddd;
		margin-top:0px;
	}
	.eventCalendar .empty{
		border:0px;
	}
	.eventCalendar .info{
		position:absolute;
		border:1px solid #ccc;
		background:white;
		padding:5px;
		display:none;
	}
	.eventCalendar td:hover .info{
		display:block;
	}
	.eventCalendar td:hover{
		border:1px solid #444;
	}
	.eventCalendar .event{
		background:#c8def4;
	}
	.eventCalendar td{
		text-align:center;
	}
</style>
<?php

	list($sYear,$sMonth,$sDay)=explode('-',$this->sDate);

	$jourJ=$sDay;
	$iMois=(int)$sMonth;
	$iAnnee=(int)$sYear;
	
	
	$sMois=sprintf('%02d',$iMois);
	$sAnnee=sprintf('%04d',$iAnnee);
	
	
	$sDate=$sAnnee.'-'.$sMois.'-01';
	
	$tabJ=array(
		'',
		'Lun',
		'Mar',
		'Mer',
		'Jeu',
		'Ven',
		'Sam',
		'Dim'
		);
	
	
	$navAnnee=" ".$sAnnee." ";
	$navMois=" ".$this->tMois[$iMois]." ";
	
?><table class="eventCalendar">
	<tr>
		<th colspan="7" style="text-align:center">
		<?php echo $navMois;?> <?php echo $navAnnee;?>
		<th>
	</tr>
	<tr>
		<?php for($j=1;$j<=7;$j++):?>
		<th><?php echo $tabJ[$j] ?></th>
		<?php endfor;?>
	</tr>
	<?php
	//$s semaine
	//$j jour
	$jour=0;
	$finDuMois=false;
	
	
	$jour=1;
	$premierJour=intVal( date("w", mktime(0, 0, 0, $iMois, 1, $iAnnee) ));
	$dernierJour=intval( date("j", mktime(0, 0, 0, $iMois+1, 0, $iAnnee) ) );
	?>
	<?php for($semaine=0;$semaine <= 6; $semaine++):?>
		<tr>
		<?php for($j=1;$j<=7;$j++):?>
			 
			<?php if($semaine==0):?>
				<?php if($j >= $premierJour):?>
					<td <?php if(isset($this->tEvent[$sAnnee.'-'.$sMois.'-'.$jour])):?>class="event"<?php endif;?>>
						<p><?php echo $jour?></p>
						<?php if(isset($this->tEvent[$sAnnee.'-'.$sMois.'-'.$jour])):?>
							X
							<div class="info">
								<?php echo implode(" ",$this->tEvent[$sAnnee.'-'.$sMois.'-'.$jour]);?>
							</div>
						<?php endif;?>
					</td>
					<?php $jour+=1;?>
				<?php else:?>
					<td class="empty"></td>
				<?php endif;?>
			<?php else:?>
				<?php if($jour <= $dernierJour):?>
					<td <?php if(isset($this->tEvent[$sAnnee.'-'.$sMois.'-'.$jour])):?>class="event"<?php endif;?>>
						<p><?php echo $jour?></p>
						<?php if(isset($this->tEvent[$sAnnee.'-'.$sMois.'-'.$jour])):?>
						X
							<div class="info">
								<?php echo implode(" ",$this->tEvent[$sAnnee.'-'.$sMois.'-'.$jour]);?>
							</div>
						<?php endif;?>
					</td>
					<?php $jour+=1;?>
				<?php else:?>
					<td class="empty"></td>
				<?php endif;?>
			<?php endif;?>
		<?php endfor;?>
		</tr>
	<?php endfor;?>
</table>

<h2><?php echo $this->oContent->cont_title ?></h2>
<?php $sText=$this->oContent->cont_text;?>
<?php $tLine=explode("\n",$sText);
$sText2=null;
$startCalendar=false;
$sCalendar=null;

$ret="\n";

foreach($tLine as $sLine){

	if(preg_match('/##diaporama/',$sLine)){

		preg_match('/##diaporama(.*)diaporama##/',$sLine,$tMatch);

		$diaporama=trim($tMatch[1]);

		$idImage='diaporamaImg'.$diaporama;
		$idNbImage='diaporamaNb'.$diaporama;

		$iImageDiap='iDiap'.$diaporama;
		$tImageDiap='tDiap'.$diaporama;

		$functDiapPrec='showDiapPrec'.$diaporama;
		$functDiapSuiv='showDiapSuiv'.$diaporama;
		$functDiapRefresh='showDiapRefresh'.$diaporama;

		//recup pictures
		$uploadDir=_root::getConfigVar('path.upload').'/diaporama/'.$diaporama.'/';

		$sText2.='<style>.diaporama img{ width:500px; }</style>'.$ret;
		$sText2.='<script>';
		$sText2.='var '.$iImageDiap.'=0;'.$ret;
		$sText2.='var '.$tImageDiap.'=new Array();'.$ret;


		$sText2.='function '.$functDiapPrec.'(){'.$ret;
			$sText2.='var a=getById(\''.$idImage.'\');'.$ret;
			$sText2.='if(a){'.$ret;
				$sText2.=$iImageDiap.'--;'.$ret;
				$sText2.='if('.$iImageDiap.' < 0){'.$ret;
					$sText2.=$iImageDiap.'=0;'.$ret;
				$sText2.='}'.$ret;
				$sText2.='a.src='.$tImageDiap.'['.$iImageDiap.'];'.$ret;

				$sText2.=$functDiapRefresh.'();'.$ret;

			$sText2.='}'.$ret;	
		$sText2.='}'.$ret;

		$sText2.='function '.$functDiapRefresh.'(){'.$ret;
		
			$sText2.='var a=getById(\''.$idNbImage.'\');'.$ret;
			$sText2.='if(a){'.$ret;
				$sText2.='a.innerHTML=('.$iImageDiap.'+1)+\'/\'+'.$tImageDiap.'.length;  '.$ret;	
			$sText2.='}'.$ret;	
		$sText2.='}'.$ret;


		$sText2.='function '.$functDiapSuiv.'(){'.$ret;
			$sText2.='var a=getById(\''.$idImage.'\');'.$ret;
			$sText2.='if(a){'.$ret;
				$sText2.=$iImageDiap.'++;'.$ret;
				$sText2.='if('.$iImageDiap.' >= '.$tImageDiap.'.length){'.$ret;
					$sText2.=$iImageDiap.'=0;'.$ret;
				$sText2.='}'.$ret;
				$sText2.='a.src='.$tImageDiap.'['.$iImageDiap.'];'.$ret;

				$sText2.=$functDiapRefresh.'();'.$ret;
			$sText2.='}'.$ret;	
		$sText2.='}'.$ret;

		$tImg=array();
		$tFile=scandir($uploadDir);
		if($tFile){
			foreach($tFile as $sFile){
				if(substr($sFile,0,1)=='.'){ continue;}
				$tImg[]=$sFile;

				$sText2.=$tImageDiap.'.push(\''.$uploadDir.$sFile.'\');'.$ret;
			}
		}
		$sText2.='</script>'.$ret;


		$sText2.='<div class="diaporama"><table>';
		$sText2.='<tr><td colspan="3"><img src="'.$uploadDir.'/'.$tImg[0].'" id="'.$idImage.'" /></td></tr>';
		$sText2.='<tr><td><input type="button" onclick="'.$functDiapPrec.'()" value="Pr&eacute;cedente"/></td>';

		$sText2.='<td style="text-align:center"><div id="'.$idNbImage.'"></div></td>';

		$sText2.='<td style="text-align:right"><input type="button" onclick="'.$functDiapSuiv.'()" value="Suivante"/></td></tr>';

		$sText2.='</table>';


		$sText2.='</div>';

		$sText2.='<script>'.$functDiapRefresh.'();</script>';

		$sText2.=print_r($tMatch[1],1);
		$sLine=null;
	}



	
	if(preg_match('/##calendrier/',$sLine)){
		$sCalendar=null;
		$startCalendar=true;
		$sLine=null;
		
		
	}
	
	if(preg_match('/calendrier##/',$sLine)){
		
		$tEvent=explode('---',$sCalendar);
		
		$oCalendar=new module_eventCalendar();
		foreach($tEvent as $sEvent){
			$sEvent=trim($sEvent);
			$sDate=substr(str_replace(array('<p>','</p>'),null,$sEvent),0,10);
			
			$sEvent=str_replace($sDate,null,$sEvent);
			
			$oCalendar->addEvent($sDate,$sEvent);
		}
		echo $oCalendar->build()->show();
		
		$oDate=new plugin_date(date('Y-m-d'));
		$oDate->addMonth(1);
		
		$oCalendar2=new module_eventCalendar($oDate->toString('Y-m-d'));
		foreach($tEvent as $sEvent){
			$sEvent=trim($sEvent);
			$sDate=substr(str_replace(array('<p>','</p>'),null,$sEvent),0,10);
			
			$sEvent=str_replace($sDate,null,$sEvent);
			
			$oCalendar2->addEvent($sDate,$sEvent);
		}
		echo $oCalendar2->build()->show();
		
		$startCalendar=false;
		$sCalendar=null;
		$sLine=null;
	}
	if($startCalendar){
		$sCalendar.=$sLine;
		$sLine=null;
	}

	if(preg_match('/#contact#/',$sLine)){

		$sLine='<form action="'._root::getLink('page::contact').'" method="POST">';
		$sLine.='<input type="hidden" name="form" value="contact"/>';
		$sLine.='<label>Titre</label><br/> <input style="width:90%" type="text" name="titre"/><br/>';
		$sLine.='<label>Texte</label><br/> <textarea style="width:90%;height:100px" type="text" name="body"></textarea><br/>';
		$sLine.='<p><input type="submit" value="Envoyer"/></p>';
		$sLine.='</form>';


		
	}

	$sText2.=$sLine;
}
?>
<?php echo ($sText2) ?>




<?php
/*
This file is part of Mkframework.

Mkframework is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License.

Mkframework is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with Mkframework.  If not, see <http://www.gnu.org/licenses/>.

*/
/** 
* plugin_form classe pour generer des elements de formulaire
* @author Mika
* @link http://mkf.mkdevs.com/
*/
class plugin_form{
	
	protected $oObject;
	protected $tMessage;
	protected $isPost;
	
	/** 
	* constructeur
	* @access public
	* @param object $oObject objet en edition
	*/
	public function __construct($oObject=null){
		
		$this->oObject=$oObject;
		
		$this->isPost=false;
		if(_root::getRequest()->isPost()){
			$this->isPost=true;
		}
	}
	
	/** 
	* initialise le tableau de message d'erreur
	* @access public
	* @param array $tMessage tableau de message d'erreur
	*/
	public function setMessage($tMessage){
		$this->tMessage=$tMessage;
	}
	/** 
	* retourne un champ input cache
	* @access public
	* @param string $sName nom du champ
	* @param array $tOption options du champ texte
	*/
	public function getInputHidden($sName,$tOption=null){
		$sHtml=null;
		$sHtml.='<input type="hidden" name="'.$sName.'" value="'.$this->getValue($sName).'" '.$this->getOption($tOption).'/>';
		return $sHtml;
	}
	/** 
	* retourne un champ input de jeton (xsrf)
	* @access public
	* @param string $sName nom du champ
	* @param string $sValue valeur du jeton
	* @param array $tOption options du champ texte
	*/
	public function getToken($sName,$sValue,$tOption=null){
		$sHtml=null;
		$sHtml.='<input type="hidden" type="text" name="'.$sName.'" value="'.$sValue.'" '.$this->getOption($tOption).'/>';
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
	}
	/** 
	* retourne un champ input texte
	* @access public
	* @param string $sName nom du champ
	* @param array $tOption options du champ texte
	*/
	public function getInputText($sName,$tOption=null){
		$sHtml=null;
		$sHtml.='<input type="text" name="'.$sName.'" value="'.$this->getValue($sName).'" '.$this->getOption($tOption).'/>';
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
	}
	
	
	/** 
	* retourne un champ input date
	* @access public
	* @param string $sName nom du champ
	* @param array $tOption options du champ texte
	*/
	public function getInputDate($sName,$tOption=null){
		$sDate=$this->getValue($sName);
		if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$sDate)){
			list($year,$month,$day)=explode('-',$sDate);
			$this->setValue($sName.'_year',$year);
			$this->setValue($sName.'_month',$month);
			$this->setValue($sName.'_day',$day);
		}
		
		$sHtml=null;
		
		$sName2=$sName.'_day';
		$sHtml.='<input style="width:20px" type="text" name="'.$sName2.'" value="'.$this->getValue($sName2).'" '.$this->getOption($tOption).'/>';
		
		$sName2=$sName.'_month';
		$sHtml.=$this->getSelect($sName2,array(null,'Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre'));
		
		//$sHtml.='<input style="width:20px" type="text" name="'.$sName2.'" value="'.$this->getValue($sName2).'" '.$this->getOption($tOption).'/>';
		
		$sName2=$sName.'_year';
		$sHtml.='<input style="width:60px" type="text" name="'.$sName2.'" value="'.$this->getValue($sName2).'" '.$this->getOption($tOption).'/>';
		
		
		
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
	}
	
	public function getDate($sName){
		return $this->getValue($sName.'_year').'-'.$this->getValue($sName.'_month').'-'.$this->getValue($sName.'_day');
	}
	
	/** 
	* retourne un champ input textarea
	* @access public
	* @param string $sName nom du champ
	* @param array $tOption options du champ texte
	*/
	public function getInputTextarea($sName,$tOption=null){
		$sHtml=null;
		$sHtml.='<textarea type="text" name="'.$sName.'" '.$this->getOption($tOption).'>';
		$sHtml.=$this->getValue($sName).'</textarea>';
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
	}
	/** 
	* retourne un champ upload
	* @access public
	* @param string $sName nom du champ
	* @param array $tOption options du champ upload
	*/
	public function getInputUpload($sName,$tOption=null){
		$sHtml=null;
		$sHtml.='<input type="file" name="'.$sName.'" '.$this->getOption($tOption).'/>';
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
	}
	/** 
	* retourne un champ menu deroulant
	* @access public
	* @param string $sName nom du champ
	* @param array @tValue tableau des valeurs du menu deroulant
	* @param array $tOption options du champ 
	*/
	public function getSelect($sName,$tValue,$tOption=null){
		
		$sCurrentValue=$this->getValue($sName);
		
		$sHtml=null;
		$sHtml.='<select name="'.$sName.'" '.$this->getOption($tOption).'>';
			foreach($tValue as $sValue => $sLabel){
				$sHtml.='<option '; 
				if($sValue==$sCurrentValue){ 
					$sHtml.=' selected="selected"'; 
				} 
				$sHtml.=' value="'.$sValue.'">'.$sLabel.'</option>';
			}
		$sHtml.='</select>';
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
		
	}
	/** 
	* retourne une liste de champs radio
	* @access public
	* @param string $sName nom du champ
	* @param array @tValue tableau des valeurs de champ radio
	* @param array $tOption options des champs 
	*/
	public function getListRadio($sName,$tValue,$tOption=null){
		$sCurrentValue=$this->getValue($sName);
		
		$sHtml=null;
	
		foreach($tValue as $sValue => $sLabel){
			$sHtml.='<input type="radio" name="'.$sName.'" '; 
			if($sValue==$sCurrentValue){ 
				$sHtml.=' checked="checked"'; 
			} 
			$sHtml.=' value="'.$sValue.'" '.$this->getOption($tOption).'/>'.$sLabel.' ';
		}
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
	}
	/** 
	* retourne un champ input checkbox
	* @access public
	* @param string $sName nom du champ
	* @param string $sValue valeur du champ checkbox
	* @param array $tOption options du champ 
	*/
	public function getInputCheckbox($sName,$sValue,$tOption=null){
		$sCurrentValue=$this->getValue($sName);
		
		$sHtml='<input type="checkbox" '; 
		if($sCurrentValue==$sValue){ 
			$sHtml.='checked="checked" '; 
		} 
		$sHtml.=' name="'.$sName.'" value="'.$sValue.'" '.$this->getOption($tOption).'/>';
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
	}
	
	public function getInputRadio($sName,$sValue,$tOption=null){
		$sCurrentValue=$this->getValue($sName);
		
		$sHtml='<input type="radio" '; 
		if($sCurrentValue==$sValue){ 
			$sHtml.='checked="checked" '; 
		} 
		$sHtml.=' name="'.$sName.'" value="'.$sValue.'" '.$this->getOption($tOption).'/>';
		$sHtml.=$this->getMessage($sName);
		return $sHtml;
	}
	
	private function setValue($sName,$sValue){
		$this->oObject->$sName=$sValue;
	}
	
	private function getValue($sName){
		if($this->isPost){
			return _root::getParam($sName);
		}else if($this->oObject){
			if($this->oObject->$sName){
				return $this->oObject->$sName;
			} 
		}
	}
	
	private function getMessage($sName){
		if(isset($this->tMessage[$sName])){
			if(is_array($this->tMessage[$sName])){
				return '<p class="error">'.implode(',',$this->tMessage[$sName]).'</p>';
			}else{
				return '<p class="error">'.$this->tMessage[$sName].'</p>';
			}
		}
		return null;
	}
	
	private function getOption($tOption=null){
		
		if(!$tOption){
			return null;
		}
		
		$sHtml=null;
		foreach($tOption as $sKey => $sValue){
			$sHtml.=$sKey.'="'.$sValue.'" ';
			
		}
		return $sHtml;
		
	}
}

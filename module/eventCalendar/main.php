<?php
Class module_eventCalendar extends abstract_module{
	
	public $tMois;
	public $tEvent;
	public $sDate;
	
	public function __construct($sDate=null){
		
		if($sDate==null){
			$sDate=date('Y-m-d');
		}
		
		$this->sDate=$sDate;
		
		$this->tMois=array(
		'',
		'Janvier',
		'Fevrier',
		'Mars',
		'Avril',
		'Mai',
		'Juin',
		'Juillet',
		'Aout',
		'Septembre',
		'Octobre',
		'Novembre',
		'Decembre',
		);
	}
	
	public function addEvent($sDate,$sText){
		$this->tEvent[$sDate][]=$sText;
	}
	
	public function build(){
		$oView=new _view('eventCalendar::list');
		
		plugin_debug::addSpy('tE',$this->tEvent);
		//-----------------------------CONFIGURATION------------------------------
		
		$oView->tMois=$this->tMois;
		$oView->tEvent=$this->tEvent;
		$oView->sDate=$this->sDate;
		//-----------------------------Fin CONFIGURATION----------------------------
		return $oView;
	}
	
}

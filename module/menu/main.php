<?php
Class module_menu extends abstract_moduleembedded{
		
	public function _index(){
		
		$tMenu=model_menu::getInstance()->getSelect();
		$tSMenu=  model_smenu::getInstance()->getSelectIndexed();
		
		foreach($tMenu as $menu_id => $title){
			$tLink[$title]='title';
			
			if(isset($tSMenu[$menu_id])){
				foreach($tSMenu[$menu_id] as $oSMenu){
					$tDetail=array();
					if($oSMenu->smen_type==model_type::CONTENT){
						$tDetail=array('page::show',array('id'=>$oSMenu->content_id));
					}else if($oSMenu->smen_type==model_type::BYCATEGORY){
						$tDetail=array('page::listByCat',array('id'=>$oSMenu->category_id));
					}else{
						$tDetail=$oSMenu->url;
					}
					$tLink[$oSMenu->smen_title]=$tDetail;
			
				}
			}
			
		}
		
		$oView=new _view('menu::index');
		$oView->tLink=$tLink;
		
		return $oView;
	}
}

<?php 
class module_admin_menuadmin extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
		
		$this->oLayout->addModule('menu','admin_menuback::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tMenu=model_menu::getInstance()->findAll();
		$tsMenu=model_smenu::getInstance()->getSelectIndexed();
		
		$oView=new _view('admin/menuadmin::list');
		$oView->tMenu=$tMenu;
		$oView->tsMenu=$tsMenu;
		
		$oView->tJoinmodel_type=model_type::getInstance()->getSelect();	
		$oView->tJoinmodel_content=model_content::getInstance()->getSelect();		
		$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();	
		
		
		$this->oLayout->add('main',$oView);
		 
	}

	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oMenu=new row_menu;
		
		$oView=new _view('admin/menuadmin::new');
		$oView->oMenu=$oMenu;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oMenu=model_menu::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/menuadmin::edit');
		$oView->oMenu=$oMenu;
		$oView->tId=model_menu::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _show(){
		$oMenu=model_menu::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/menuadmin::show');
		$oView->oMenu=$oMenu;
		
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oMenu=model_menu::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/menuadmin::delete');
		$oView->oMenu=$oMenu;
		
		

		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	

	private function processSave(){
		if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
			return null;
		}
		
		$oPluginXsrf=new plugin_xsrf();
		if(!$oPluginXsrf->checkToken( _root::getParam('token') ) ){ //on verifie que le token est valide
			return array('token'=>$oPluginXsrf->getMessage() );
		}
	
		$iId=_root::getParam('id',null);
		if($iId==null){
			$oMenu=new row_menu;	
		}else{
			$oMenu=model_menu::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('men_title','men_order');
		foreach($tColumn as $sColumn){
			$oMenu->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oMenu->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('admin_menuadmin::list');
		}else{
			return $oMenu->getListError();
		}
		
	}
	
	
	public function processDelete(){
		if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
			return null;
		}
		
		$oPluginXsrf=new plugin_xsrf();
		if(!$oPluginXsrf->checkToken( _root::getParam('token') ) ){ //on verifie que le token est valide
			return array('token'=>$oPluginXsrf->getMessage() );
		}
	
		$oMenu=model_menu::getInstance()->findById( _root::getParam('id',null) );
				
		$oMenu->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('admin_menuadmin::list');
		
	}


	
	public function after(){
		$this->oLayout->show();
	}
	
	
}


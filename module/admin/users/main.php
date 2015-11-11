<?php 
class module_users extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
		
		//$this->oLayout->addModule('menu','menu::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tUsers=model_users::getInstance()->findAll();
		
		$oView=new _view('users::list');
		$oView->tUsers=$tUsers;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}

	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oUsers=new row_users;
		
		$oView=new _view('users::new');
		$oView->oUsers=$oUsers;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oUsers=model_users::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('users::edit');
		$oView->oUsers=$oUsers;
		$oView->tId=model_users::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _show(){
		$oUsers=model_users::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('users::show');
		$oView->oUsers=$oUsers;
		
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oUsers=model_users::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('users::delete');
		$oView->oUsers=$oUsers;
		
		

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
			$oUsers=new row_users;	
		}else{
			$oUsers=model_users::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('login','pass');
		foreach($tColumn as $sColumn){
			$oUsers->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oUsers->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('users::list');
		}else{
			return $oUsers->getListError();
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
	
		$oUsers=model_users::getInstance()->findById( _root::getParam('id',null) );
				
		$oUsers->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('users::list');
		
	}


	
	public function after(){
		$this->oLayout->show();
	}
	
	
}


<?php 
class module_admin_categories extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
		
		$this->oLayout->addModule('menu','admin_menuback::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tCategories=model_categories::getInstance()->findAll();
		
		$oView=new _view('admin/categories::list');
		$oView->tCategories=$tCategories;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}

	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oCategories=new row_categories;
		
		$oView=new _view('admin/categories::new');
		$oView->oCategories=$oCategories;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oCategories=model_categories::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/categories::edit');
		$oView->oCategories=$oCategories;
		$oView->tId=model_categories::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _show(){
		$oCategories=model_categories::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/categories::show');
		$oView->oCategories=$oCategories;
		
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oCategories=model_categories::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/categories::delete');
		$oView->oCategories=$oCategories;
		
		

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
			$oCategories=new row_categories;	
		}else{
			$oCategories=model_categories::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('cat_title');
		foreach($tColumn as $sColumn){
			$oCategories->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oCategories->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('categories::list');
		}else{
			return $oCategories->getListError();
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
	
		$oCategories=model_categories::getInstance()->findById( _root::getParam('id',null) );
				
		$oCategories->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('categories::list');
		
	}


	
	public function after(){
		$this->oLayout->show();
	}
	
	
}


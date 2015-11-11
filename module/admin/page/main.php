<?php 
class module_admin_page extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
		
		$this->oLayout->addModule('menu','admin_menuback::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tContent=model_content::getInstance()->findAll();
		
		$oView=new _view('admin/page::list');
		$oView->tContent=$tContent;
		
		$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();
		
		$this->oLayout->add('main',$oView);
		 
	}

	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oContent=new row_content;
		$oContent->cont_datetime=date('Y-m-d');
		
		$oView=new _view('admin/page::new');
		$oView->oContent=$oContent;
		
		$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oContent=model_content::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/page::edit');
		$oView->oContent=$oContent;
		$oView->tId=model_content::getInstance()->getIdTab();
		
				$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _show(){
		$oContent=model_content::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/page::show');
		$oView->oContent=$oContent;
		
				$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oContent=model_content::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/page::delete');
		$oView->oContent=$oContent;
		
				$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();

		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	

	private function processSave(){
		if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
			return null;
		}
		
		$oForm=new plugin_form();
		
		$oPluginXsrf=new plugin_xsrf();
		if(!$oPluginXsrf->checkToken( _root::getParam('token') ) ){ //on verifie que le token est valide
			return array('token'=>$oPluginXsrf->getMessage() );
		}
	
		$iId=_root::getParam('id',null);
		if($iId==null){
			$oContent=new row_content;	
		}else{
			$oContent=model_content::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('cont_title','cont_text','cont_order','category_id');
		foreach($tColumn as $sColumn){
			$oContent->$sColumn=_root::getParam($sColumn,null) ;
		}
		$oContent->cont_datetime=$oForm->getDate('cont_datetime');
		$oContent->cont_text= $_POST['cont_text'];
		
		if($oContent->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('admin_page::list');
		}else{
			return $oContent->getListError();
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
	
		$oContent=model_content::getInstance()->findById( _root::getParam('id',null) );
				
		$oContent->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('page::list');
		
	}


	
	public function after(){
		$this->oLayout->show();
	}
	
	
}


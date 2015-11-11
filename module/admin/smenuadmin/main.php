<?php 
class module_admin_smenuadmin extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
		
		$this->oLayout->addModule('menu','admin_menuback::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tSmenu=model_smenu::getInstance()->findAll();
		
		$oView=new _view('admin/smenuadmin::list');
		$oView->tSmenu=$tSmenu;
		
		$oView->tJoinmodel_type=model_type::getInstance()->getSelect();	
		$oView->tJoinmodel_content=model_content::getInstance()->getSelect();		
		$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();		
		$oView->tJoinmodel_menu=model_menu::getInstance()->getSelect();
		
		$this->oLayout->add('main',$oView);
		 
	}

	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oMenu=  model_menu::getInstance()->findById(_root::getParam('menu_id'));
		
		$oSmenu=new row_smenu;
		
		$oView=new _view('admin/smenuadmin::new');
		$oView->oSmenu=$oSmenu;
		
				$oView->tJoinmodel_type=model_type::getInstance()->getSelect();		$oView->tJoinmodel_content=model_content::getInstance()->getSelect();		$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();		$oView->tJoinmodel_menu=model_menu::getInstance()->getSelect();
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		$oView->oMenu=$oMenu;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oSmenu=model_smenu::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/smenuadmin::edit');
		$oView->oSmenu=$oSmenu;
		$oView->tId=model_smenu::getInstance()->getIdTab();
		
				$oView->tJoinmodel_type=model_type::getInstance()->getSelect();		$oView->tJoinmodel_content=model_content::getInstance()->getSelect();		$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();		$oView->tJoinmodel_menu=model_menu::getInstance()->getSelect();
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _show(){
		$oSmenu=model_smenu::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/smenuadmin::show');
		$oView->oSmenu=$oSmenu;
		
				$oView->tJoinmodel_type=model_type::getInstance()->getSelect();		$oView->tJoinmodel_content=model_content::getInstance()->getSelect();		$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();		$oView->tJoinmodel_menu=model_menu::getInstance()->getSelect();
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oSmenu=model_smenu::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/smenuadmin::delete');
		$oView->oSmenu=$oSmenu;
		
				$oView->tJoinmodel_type=model_type::getInstance()->getSelect();		$oView->tJoinmodel_content=model_content::getInstance()->getSelect();		$oView->tJoinmodel_categories=model_categories::getInstance()->getSelect();		$oView->tJoinmodel_menu=model_menu::getInstance()->getSelect();

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
			$oSmenu=new row_smenu;	
		}else{
			$oSmenu=model_smenu::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('smen_title','smen_order','smen_type','content_id','category_id','menu_id','url');
		foreach($tColumn as $sColumn){
			$oSmenu->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oSmenu->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('admin_menuadmin::list');
		}else{
			return $oSmenu->getListError();
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
	
		$oSmenu=model_smenu::getInstance()->findById( _root::getParam('id',null) );
				
		$oSmenu->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('admin_smenuadmin::list');
		
	}


	
	public function after(){
		$this->oLayout->show();
	}
	
	
}


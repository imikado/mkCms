<?php 
class module_admin_pictures extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
		
		$this->oLayout->addModule('menu','admin_menuback::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tPictures=model_pictures::getInstance()->findAll();
		
		$oView=new _view('admin/pictures::list');
		$oView->tPictures=$tPictures;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}

	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oPictures=new row_pictures;
		
		$oView=new _view('admin/pictures::new');
		$oView->oPictures=$oPictures;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oPictures=model_pictures::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/pictures::edit');
		$oView->oPictures=$oPictures;
		$oView->tId=model_pictures::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}

	
	
	public function _show(){
		$oPictures=model_pictures::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/pictures::show');
		$oView->oPictures=$oPictures;
		
		
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
			$oPictures=new row_pictures;	
		}else{
			$oPictures=model_pictures::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('name','directory');
		foreach($tColumn as $sColumn){
			$oPictures->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		$tColumnUpload=array('path');
		if($tColumnUpload){
			foreach($tColumnUpload as $sColumnUpload){
				$oPluginUpload=new plugin_upload($sColumnUpload);
				if($oPluginUpload->isValid()){
					$sNewFileName=_root::getConfigVar('path.upload').$sColumnUpload.'_'.date('Ymdhis');

					$oPluginUpload->saveAs($sNewFileName);
					$oPictures->$sColumnUpload=$oPluginUpload->getPath();
				}
			}
		}

		
		if($oPictures->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('admin_pictures::list');
		}else{
			return $oPictures->getListError();
		}
		
	}
	
	

	
	public function after(){
		$this->oLayout->show();
	}
	
	
}


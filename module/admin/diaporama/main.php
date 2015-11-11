<?php 
class module_admin_diaporama extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
		
		$this->oLayout->addModule('menu','admin_menuback::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tDiaporama=model_diaporama::getInstance()->findAll();
		
		$oView=new _view('admin/diaporama::list');
		$oView->tDiaporama=$tDiaporama;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}
		
	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oDiaporama=new row_diaporama;
		
		$oView=new _view('admin/diaporama::new');
		$oView->oDiaporama=$oDiaporama;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
			
	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oDiaporama=model_diaporama::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/diaporama::edit');
		$oView->oDiaporama=$oDiaporama;
		$oView->tId=model_diaporama::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _show(){
		$oDiaporama=model_diaporama::getInstance()->findById( _root::getParam('id') );
		
		$uploadDir=_root::getConfigVar('path.upload').'/diaporama/'.$oDiaporama->nom.'/';

		$tImg=array();
		$tFile=scandir($uploadDir);
		if($tFile){
			foreach($tFile as $sFile){
				if(substr($sFile,0,1)=='.'){ continue;}
				$tImg[]=$sFile;
			}
		}

		$oView=new _view('admin/diaporama::show');
		$oView->oDiaporama=$oDiaporama;
		$oView->uploadDir=$uploadDir;
		
		$oView->tImg=$tImg;

		$this->oLayout->add('main',$oView);
	}

	

	public function _pictures(){
		
		$oDiaporama=model_diaporama::getInstance()->findById( _root::getParam('id') );

		$this->message=$this->processPictures($oDiaporama->nom);
		
		$oView=new _view('admin/diaporama::pictures');
		$oView->oDiaporama=$oDiaporama;
		
		

		$this->oLayout->add('main',$oView);
	}
	private function processPictures($nom){
		if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
			return null;
		}

		if($_FILES['tFileInput']){
			$uploads = $this->UpFilesTOObj($_FILES['tFileInput']);
			
			$fileUploader=new FileUploader($uploads,$nom); 
		}

	}
	private function UpFilesTOObj($fileArr){
		$uploads=array();
		foreach($fileArr['name'] as $keyee => $info)
		{
			$uploads[$keyee]=new stdclass;
			$uploads[$keyee]->name=$fileArr['name'][$keyee];
			$uploads[$keyee]->type=$fileArr['type'][$keyee];
			$uploads[$keyee]->tmp_name=$fileArr['tmp_name'][$keyee];
			$uploads[$keyee]->error=$fileArr['error'][$keyee];
		}
		return $uploads;
	}
	
		
	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oDiaporama=model_diaporama::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/diaporama::delete');
		$oView->oDiaporama=$oDiaporama;
		
		

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
			$oDiaporama=new row_diaporama;	
		}else{
			$oDiaporama=model_diaporama::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('nom');
		foreach($tColumn as $sColumn){
			$oDiaporama->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oDiaporama->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('admin_diaporama::list');
		}else{
			return $oDiaporama->getListError();
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
	
		$oDiaporama=model_diaporama::getInstance()->findById( _root::getParam('id',null) );
				
		$oDiaporama->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('admin_diaporama::list');
		
	}
		
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}
class FileUploader{
	public function __construct($uploads,$rep){

		$uploadDir=_root::getConfigVar('path.upload').'/diaporama/'.$rep.'/';

		mkdir($uploadDir,0777,true);

		foreach($uploads as $current)
		{
			$this->uploadFile=$uploadDir.$current->name.".".$this->get_file_extension($current->name);
			if($this->upload($current,$this->uploadFile)){
				//echo "Successfully uploaded ".$current->name."n";
			}
		}
	}
	
	public function upload($current,$uploadFile){
		if(move_uploaded_file($current->tmp_name,$uploadFile)){
		return true;
		}
	}

	private function get_file_extension($file_name){
	  return substr(strrchr($file_name,'.'),1);
	}
}

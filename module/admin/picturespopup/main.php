<?php 
class module_admin_picturespopup extends abstract_module{
	
	public function before(){
		_root::setConfigVar('site.mode','prod');
		
		$this->oLayout=new _layout('popup');
		
		//$this->oLayout->addModule('menu','admin_menuback::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tPictures=model_pictures::getInstance()->findAll();
		
		$oView=new _view('admin/picturespopup::list');
		$oView->tPictures=$tPictures;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}

	
	
	
	
	public function _show(){
		$oPictures=model_pictures::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('admin/picturespopup::show');
		$oView->oPictures=$oPictures;
		
		
		$this->oLayout->add('main',$oView);
	}

	
	public function after(){
		$this->oLayout->show();
	}
	
	
}


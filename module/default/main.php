<?php 
class module_default extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
                
                $this->oLayout->addModule('menu','menu::index');
	}
	
	public function _index(){
//page::listByCat&id=1
		_root::redirect('page::listByCat',array('id'=>1));
	}
        
	
	public function after(){
		$this->oLayout->show();
	}
}

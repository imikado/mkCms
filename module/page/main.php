<?php 
class module_page extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('template1');
		
		$this->oLayout->addModule('menu','menu::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	public function _listByCat(){
		
		$tContent=model_content::getInstance()->findListByCat(_root::getParam('id'));
		
		$oView=new _view('page::list');
		$oView->tContent=$tContent;
		
		

		$this->oLayout->add('main',$oView);
	}

	public function _show(){

		$oContent=model_content::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('page::show');
		$oView->oContent=$oContent;
		
		
		$this->oLayout->add('main',$oView);
	}

	public function _contact(){
		$message=$this->processContact();

		$oView=new _view('page::contact');
		$oView->message=$message;

		$this->oLayout->add('main',$oView);
	}
	private function processContact(){
		if(_root::getRequest()->isPost()==false or _root::getParam('form')!='contact'){
			return false;
		}

		$sMailFrom='contact@marchedecoeuilly.com';
		$sMailTo='contact@marchedecoeuilly.com';

		$oPluginMail=new plugin_mail();
		$oPluginMail->setFrom('MarcheDeCoeuilly',$sMailFrom);
		$oPluginMail->addTo($sMailTo);
		$oPluginMail->setTitle(_root::getParam('titre'));
		$oPluginMail->setBodyHtml(_root::getParam('body'));
		$oPluginMail->send();

		return "Message envoy&eacute;";

	}
	
	public function _calendar(){
		
		$oModuleCalendrier=new module_eventCalendar();
		$oModuleCalendrier->addEvent('2015-05-20','tiiit'); //indiquer le couple module::action de la page parente
		
		$this->oLayout->add('main',$oModuleCalendrier->build() ); 
	}
	
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}


/*variables
#select		$oView->tJoincontent=content::getInstance()->getSelect();#fin_select
variables*/

<?php
Class module_admin_menuback extends abstract_moduleembedded{
		
	public function _index(){
		
		$tLink=array(
			'Categories' => 'admin_categories::list',
			'Modifier menu' => 'admin_menuadmin::list',
			'Pages' => 'admin_page::list',
			'Mediatheque'=>'admin_pictures::list',
			'Diaporama'=>'admin_diaporama::list',
			'Se deconnecter' => 'auth::logout',

		);
		
		$oView=new _view('admin/menuback::index');
		$oView->tLink=$tLink;
		
		return $oView;
	}
}

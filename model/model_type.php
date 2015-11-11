<?php
class model_type extends abstract_model{
	
	const CONTENT=0;
	const BYCATEGORY=1;
	const URL=2;
	
	public static function getInstance(){
		return self::_getInstance(__CLASS__);
	}
	
	public function getSelect(){
		$tType=array();
		$tType[self::CONTENT]='Page';
		$tType[self::BYCATEGORY]='Liste par categorie';
		$tType[self::URL]='Lien';
		
		return $tType;
	}

}
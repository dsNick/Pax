<?php
namespace Pax;

class Task{
    
	public function __construct($mParams = [], $sAction = NULL){
        
        if(is_null($sAction)){
	       $oClass = new \ReflectionClass(get_called_class());
           $sAction = lcfirst (preg_replace('/Task$/', '', $oClass->getShortName()));
        }
        $aParams = [];
        if(is_array($mParams) && count($mParams)){
            $aParams = $mParams;
        }elseif(isset(debug_backtrace()[0]['args'][0])){
            $aParams = debug_backtrace()[0]['args'][0];
        }elseif(isset(debug_backtrace()[1]['args'][0]) ){
            $aParams = debug_backtrace()[1]['args'];
        }
        
        if(is_string($aParams))
            $aParams = [$aParams];
        
		$this->_id = uniqid();
		$this->_do = $sAction;
		$this->applyParams($aParams);
	}
	
	public function applyParams(array $aParams){
		foreach ($aParams as $aAttribute => $mValue){
			$this->$aAttribute = $mValue;
		}
	}
	
	public function __isset($sAttribute){
		if(isset($this->$sAttribute))
			return true;
		return false;
	}
	
	public function __get($sAttribute){
		if(isset($this->$sAttribute)){
			return $this->$sAttribute;
		}
		return null;
	}
	
	public function __set($sAttribute, $mValue){
		$this->$sAttribute = $mValue;
	}
	
	static protected function init(){
	    $reflect  = new \ReflectionClass(get_called_class());
	    return $reflect->newInstanceArgs(func_get_args());
	}
	
}
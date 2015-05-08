<?php
namespace Pax;

class Response extends Responder{
	
	public function bind($sDestination, $sEvent, $sFunction){
		return $this->addTask(['d'=>$sDestination, 'e'=>$sEvent,'f'=>$sFunction]);
	}
	public function unbind($sDestination, $sEvent){
		return $this->addTask(['d'=>$sDestination, 'e'=>$sEvent]);
	}
	public function html($sDestination, $sContent){
		return $this->addTask(['d'=>$sDestination, 'c'=>$sContent], 'html');
	}
	public function append($sDestination, $sContent){
		return $this->addTask(['d'=>$sDestination, 'c'=>$sContent]);
	}
	public function prepend($sDestination, $sContent){
		return $this->addTask(['d'=>$sDestination, 'c'=>$sContent]);
	}
	public function before($sDestination, $sContent){
		return $this->addTask(['d'=>$sDestination, 'c'=>$sContent]);
	}
	public function after($sDestination, $sContent){
		return $this->addTask(['d'=>$sDestination, 'c'=>$sContent]);
	}
	public function attr($sDestination, $sAttribute, $sContent){
		return $this->addTask(['d'=>$sDestination, 'a'=>$sAttribute, 'c'=>$sContent]);
	}
	public function console($sContent){
		return $this->addTask();
	}
	public function alert($sContent){
		return $this->addTask();
	}
	public function script($sContent){
		return $this->addTask(['c'=>$sContent]);
	}
	public function _debug($args){
		return $this->addTask();
	}
	public function css($sDestination, $sPropertyName, $sValue){
		return $this->addTask(['d'=>$sDestination, 'p'=>$sPropertyName, 'v'=>$sValue]);
	}
	public function addClass($sDestination, $sClassName){
		return $this->addTask(['d'=>$sDestination, 'c'=>$sClassName]);
	}
	public function removeClass($sDestination, $sClassName=null){
		return $this->addTask(['d'=>$sDestination, 'c'=>$sClassName]);
	}
	public function remove($sDestination){
	    return $this->addTask(['d'=>$sDestination]);
	}
	public function replaceWith($sDestination, $sContent=null){
	    return $this->addTask(['d'=>$sDestination, 'c'=>$sContent]);
	}
}
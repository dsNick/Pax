<?php
namespace Pax\Tasks;

class RemoveClassTask extends \Pax\Task{
    
    static public function create($sDestination, $sClassName = NULL){
        return self::init(['d'=>$sDestination, 'c'=>$sClassName]);
    }
    
}
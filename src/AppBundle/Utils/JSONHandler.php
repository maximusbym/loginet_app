<?php
namespace AppBundle\Utils;

class JSONHandler
{
    
    static function prepareJSON($data)
    {
        $resNew = array();

        foreach ($data as $key => $val) {
            $resTmp = [];
            foreach ($val as $key2 => $val2) {
                
                if( $val2 instanceof \DateTime ) {
                    $val2 = $val2->format('Y-m-d H:i');
                }
                $resTmp[] = $val2;
            }
            $resNew[] = $resTmp;
        }

        return $resNew;
    }
}
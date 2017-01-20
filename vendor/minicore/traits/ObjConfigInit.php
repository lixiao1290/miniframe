<?php
namespace minicore\traits;

use minicore\lib\Mini;

trait ObjConfigInit
{
    public function miniObj($members=null)
    {
        if (empty($members)) {
            $members=Mini::$app->getExtention(static::class);
    
        }
        foreach ($members as $key => $value) {
            if (property_exists(get_called_class(), $key))
                $this->$key = $value;
        }
    
    }
    
    public static function miniObjStatic($members)
    {
        if (empty($members)) {
            $members=Mini::$app->getExtention(static::class);
    
        }
        foreach ($members as $key => $value) {
            if (property_exists(get_called_class(), $key))
                static::$$key = $value;
        }
    }
}


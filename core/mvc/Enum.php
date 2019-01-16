<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 15/11/2018
 * Time: 19:06
 */

namespace core\mvc;

use ReflectionClass;

abstract class Enum {

    private static $constCacheArray = NULL;

    public static function getConstants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

}
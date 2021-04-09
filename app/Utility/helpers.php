<?php


if ( ! function_exists('getClassName')) {
    function getClassName($class)
    {
        $classNameWithNamespace = get_class($class);
        $class_name             = substr($classNameWithNamespace, strrpos($classNameWithNamespace, '\\') + 1);

        return strtolower($class_name);
    }

}

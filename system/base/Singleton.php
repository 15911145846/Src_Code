<?php
namespace System;
abstract class Singleton
{
    protected static $instance = array();
    public static function instance() {
        $clz = get_called_class();
        if ( ! isset(self::$instance[$clz])) {
            $args = func_get_args();
            switch(func_num_args()) {
                case 0:
                    $instance = new $clz();
                    break;
                case 1:
                    $instance = new $clz($args[0]);
                    break;
                case 2:
                    $instance = new $clz($args[0],$args[1]);
                    break;
                case 3:
                    $instance = new $clz($args[0],$args[1],$args[2]);
                    break;
                case 4:
                    $instance = new $clz($args[0],$args[1],$args[2],$args[3]);
                    break;
                case 5:
                    $instance = new $clz($args[0],$args[1],$args[2],$args[3],$args[4]);
                    break;
                default:
                    $instance = new $clz($args[0],$args[1],$args[2],$args[3],$args[4],$args[5]);
            }
            self::$instance[$clz] = $instance;
        }
        return self::$instance[$clz];
    }


    protected function __construct() {
    }

    protected function __clone() {
    }
}

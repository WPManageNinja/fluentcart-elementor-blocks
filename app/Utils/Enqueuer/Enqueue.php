<?php

namespace FluentCartElementorBlocks\App\Utils\Enqueuer;

class Enqueue
{

    private static $enqueuer = Vite::class;

    public static function style($handle, $src, $dependency = [], $version = null){
        (static::$enqueuer)::enqueueStyle($handle, $src, $dependency, $version);
    }

    public static function staticStyle($handle, $src, $dependency, $version){
        (static::$enqueuer)::enqueueStaticStyle($handle, $src, $dependency, $version);
    }

    public static function script($handle, $src, $dependency = [], $version = null, $inFooter = false){
        return (static::$enqueuer)::enqueueScript($handle, $src, $dependency, $version, $inFooter);
    }

    public static function staticScript($handle, $src, $dependency = [], $version = null, $inFooter = false){
        return (static::$enqueuer)::enqueueStaticScript($handle, $src, $dependency, $version, $inFooter);
    }

    public static function getStaticFilePath($path){
        return (static::$enqueuer)::getStaticFilePath($path);
    }

}
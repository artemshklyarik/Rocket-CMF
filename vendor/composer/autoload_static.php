<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit057ec6f2fd454f238518cdd9ee48655c
{
    public static $files = array (
        'cc8a56d5385b4433e9523f989cdb0fae' => __DIR__ . '/../..' . '/app/config/general.php',
        'e2064fe8e794f989a7911adab15dbc03' => __DIR__ . '/../..' . '/app/config/database.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
        array (
            0 => __DIR__ . '/..' . '/framework',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/..' . '/core',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit057ec6f2fd454f238518cdd9ee48655c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit057ec6f2fd454f238518cdd9ee48655c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit154c2051dc6867c3b7cbb4ca5a67a658
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit154c2051dc6867c3b7cbb4ca5a67a658::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit154c2051dc6867c3b7cbb4ca5a67a658::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit154c2051dc6867c3b7cbb4ca5a67a658::$classMap;

        }, null, ClassLoader::class);
    }
}
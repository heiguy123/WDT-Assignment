<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf5f08d526999d0a9fd2567bbe3c800e8
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf5f08d526999d0a9fd2567bbe3c800e8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf5f08d526999d0a9fd2567bbe3c800e8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

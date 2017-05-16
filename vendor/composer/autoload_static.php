<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit344e82d8c2bfce44cf961e58b48d128c
{
    public static $files = array (
        '2c102faa651ef8ea5874edb585946bce' => __DIR__ . '/..' . '/swiftmailer/swiftmailer/lib/swift_required.php',
    );

    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'minicore\\' => 9,
        ),
        'a' => 
        array (
            'app\\' => 4,
            'admin\\' => 6,
        ),
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
            'Symfony\\Component\\Filesystem\\' => 29,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'D' => 
        array (
            'Doctrine\\Common\\Cache\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'minicore\\' => 
        array (
            0 => __DIR__ . '/..' . '/minicore',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/admin',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Symfony\\Component\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/filesystem',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Doctrine\\Common\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/cache/lib/Doctrine/Common/Cache',
        ),
    );

    public static $prefixesPsr0 = array (
        'N' => 
        array (
            'Neutron' => 
            array (
                0 => __DIR__ . '/..' . '/neutron/temporary-filesystem/src',
            ),
        ),
        'F' => 
        array (
            'FFMpeg' => 
            array (
                0 => __DIR__ . '/..' . '/php-ffmpeg/php-ffmpeg/src',
            ),
        ),
        'E' => 
        array (
            'Evenement' => 
            array (
                0 => __DIR__ . '/..' . '/evenement/evenement/src',
            ),
        ),
        'A' => 
        array (
            'Alchemy' => 
            array (
                0 => __DIR__ . '/..' . '/alchemy/binary-driver/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit344e82d8c2bfce44cf961e58b48d128c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit344e82d8c2bfce44cf961e58b48d128c::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit344e82d8c2bfce44cf961e58b48d128c::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}

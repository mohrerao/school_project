<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit80549ecf449b5bf50f1c463f567cb6b4
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '8592c7b0947d8a0965a9e8c3d16f9c24' => __DIR__ . '/..' . '/elasticsearch/elasticsearch/src/autoload.php',
    );

    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'User\\' => 5,
        ),
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'School\\' => 7,
        ),
        'R' => 
        array (
            'React\\Promise\\' => 14,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Predis\\' => 7,
        ),
        'O' => 
        array (
            'Order\\' => 6,
        ),
        'M' => 
        array (
            'Message\\' => 8,
        ),
        'L' => 
        array (
            'Laptop\\' => 7,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Stream\\' => 18,
            'GuzzleHttp\\Ring\\' => 16,
        ),
        'E' => 
        array (
            'Elasticsearch\\' => 14,
        ),
        'D' => 
        array (
            'DB\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'User\\' => 
        array (
            0 => '/app/app/src',
        ),
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'School\\' => 
        array (
            0 => '/app/app/src',
        ),
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
        'Order\\' => 
        array (
            0 => '/app/app/src',
        ),
        'Message\\' => 
        array (
            0 => '/app/app/src',
        ),
        'Laptop\\' => 
        array (
            0 => '/app/app/src',
        ),
        'GuzzleHttp\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/ezimuel/guzzlestreams/src',
        ),
        'GuzzleHttp\\Ring\\' => 
        array (
            0 => __DIR__ . '/..' . '/ezimuel/ringphp/src',
        ),
        'Elasticsearch\\' => 
        array (
            0 => __DIR__ . '/..' . '/elasticsearch/elasticsearch/src/Elasticsearch',
        ),
        'DB\\' => 
        array (
            0 => '/app/app/Database',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit80549ecf449b5bf50f1c463f567cb6b4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit80549ecf449b5bf50f1c463f567cb6b4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

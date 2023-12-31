<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit938272f9f3b66eac4d2f3b0ff800baa3
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit938272f9f3b66eac4d2f3b0ff800baa3', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit938272f9f3b66eac4d2f3b0ff800baa3', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit938272f9f3b66eac4d2f3b0ff800baa3::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}

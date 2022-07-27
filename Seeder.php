<?php

namespace Elegant\Database;

class Seeder
{
    public function __construct()
    {
        log_message('info', 'Elegant Seeder Class Initialized');
    }

    /**
     * Run another seeder
     *
     * @param string $class Seeder class name
     */
    public static function call($class)
    {
        $file = database_path('seeders/' . $class . '.php');

        if(file_exists($file)) {
            require_once $file;

            $seeder = new $class;

            if (! method_exists($seeder, 'run')) {
                show_error("Method [run] missing from " . get_class($seeder));
            }

            $seeder->run();

            echo $class . " seeding successfully! \n";
        } else {
            echo "Seeding file does not exist! \n";
        }

    }

    /**
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return get_instance()->$key;
    }
}

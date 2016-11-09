<?php

namespace threemuskateers\hw3\controllers;
use threemuskateers\hw3 as B;

abstract class Controller {
    public abstract function processRequest();

    /**
     * Used to get a singleton instance of the given view.
     * @param string $name name of view class desired. foo
     *  would return an instance of FooView.
     * @return object instance of desired view.
     */
    public function view($name) {
        static $loaded_views = [];
        if (!empty($loaded_views[$name])) {
            return $loaded_views[$name];
        }
        $class_name = ucfirst($name) . "View";
        $full_name = B\NS_VIEWS . $class_name;
        $view_folder = __DIR__ . "/../views/";
        $path_name = $view_folder . $class_name . ".php";
        if (file_exists($path_name)) {
            require_once $path_name;
            $loaded_views[$name] = new $full_name();
            return $loaded_views[$name];
        }
        return false;
    }
}

?>



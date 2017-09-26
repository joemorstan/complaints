<?php

class App {

    protected $controller = 'PropositionsController';
    protected $action = 'index';
    protected $params = array();

    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $routes = require_once ROOT. '/app/routes/routes.php';

        if (!empty($url)) {

            foreach ($routes as $route => $controller) {
                //converting route to regex pattern for matching
                $route = $this->routeToPattern($route);

                if (preg_match($route, $url, $matches)) {
                    list($this->controller, $this->action) = explode('@', $controller);

                    array_shift($matches);
                    $this->params = !count($matches) > 1 ?: $matches;
                }
            }
        }

        $this->controller = new $this->controller;

        call_user_func_array(array($this->controller, $this->action), $this->params);
    }

    public function routeToPattern($route) {
        $pattern = preg_replace('/{[0-9a-zA-Z_-]+}/', '([0-9a-zA-Z_-]+)', $route);
        $pattern = preg_replace('/\//', '\/', $pattern);
        $pattern = '/'. $pattern. '/';

        return $pattern;
    }
}
<?php
namespace core;

/**
 * sMVC router class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */
class Router
{
    /**
     * @var array<mixed> $routes
     */
    public static array $routes = [];

    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param array<mixed> $params
     */
    public static function get(string $path, mixed $callback, array $params = []) : void
    {
        self::$routes['get'][$path]['callback'] = $callback;
        self::$routes['get'][$path]['params'] = $params;
    }

    /**
     * @param array<mixed> $params
     */
    public static function post(string $path, mixed $callback, array $params = []) : void
    {
        self::$routes['post'][$path]['callback'] = $callback;
        self::$routes['post'][$path]['params'] = $params;
    }

    public function resolve() : mixed
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = self::$routes[$method][$path]['callback'] ?? false;
        $params = self::$routes[$method][$path]['params'] ?? false;

        if ($callback === false) {
            $this->response->statusCode(404);
            return $this->showView('error/404');
        }
        if (is_string($callback)) {
            $view = $callback;
            if ($params) {
                return $this->showView($view, $params);
            }
            return $this->showView($view);
        }
        if (is_array($callback)) {
            //make instance of the controller before execute
            //$callback[0] holds the controller class name
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback);
    }

    /**
     * @param array<mixed> $params
     */
    public function showView(string $view, array $params = []) : NULL
    {
        Application::$app->view->display($view, $params);
        return null;
    }
}

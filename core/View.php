<?php

/**
 * sMVC view class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */

namespace core;

use Exception;

class View
{
    /**
     * @var array<mixed> $viewVars
     */
    public array $viewVars = array();

    /**
     * @param array<mixed> $viewVars
     */
    protected function renderView(string $view, array $viewVars = null): null
    {
        extract($this->viewVars);
        if (isset($viewVars)) {
            extract($viewVars);
        }
        try {
            $file = Application::$APP_DIR . "/views/$view.php";
            if (file_exists($file) && is_readable($file)) {
                include_once $file;
            } else {
                throw new Exception("$file view does not exists or is not readable.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return null;
    }

    public function assign(mixed $viewVar, mixed $value = null): void
    {
        if (isset($value)) {
            $this->viewVars[$viewVar] = $value;
        } else {
            foreach ($viewVar as $key => $value) {
                if (is_int($key)) {
                    $this->viewVars[] = $value;
                } else {
                    $this->viewVars[$key] = $value;
                }
            }
        }
    }

    /**
     * @param array<mixed> $viewVars
     */
    public function fetch(string $view, array $viewVars = null): mixed
    {
        ob_start();
        $this->renderView($view, $viewVars);
        return ob_get_clean();
    }

    /**
     * @param array<mixed> $params
     */
    public function display(string $view, array $params = null): mixed
    {
        return $this->renderView($view, $params);
    }
}

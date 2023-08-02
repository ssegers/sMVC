<?php
namespace core;

/**
 * sMVC request class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */
class Request
{
    public function getPath() : string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        } else {
            return substr($path, 0, $position);
        }
    }
    
    public function getMethod() : string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}

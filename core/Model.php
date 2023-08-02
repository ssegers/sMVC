<?php
namespace core;

/**
 * sMVC model class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */
class Model
{
    public Database $db;

    public function __construct()
    {
        if (isset(Application::$app->db)) {
            $this->db = Application::$app->db;
        }
    }

    /**
     * @param array<mixed> $data
     */
    public function loadData(array $data) :void
    {
    }

    public function validate() :void
    {
    }
}

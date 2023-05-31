<?php
namespace App\Models;
use App\Models\Medoo;
use App\Base\Base;
use PDOStatement;
use Service\Utils\Common;

class Model extends Medoo
{
    protected string $database_type = 'mysql';

    function __construct()
    {
        $db_config = $this->getConnectOptions();
        $options = [
            'database_type' => $this->database_type,
            'database_name' => $db_config['database_name'],
            'server' => $db_config['server'],
            'username' => $db_config['username'],
            'password' => $db_config['password'],
            'port' => $db_config['port'],
            'charset' => $db_config['charset']
        ];
        parent::__construct($options);
    }
}

<?php
namespace App\Models;
use App\Models\Medoo;
use App\Base\Base;
use PDOStatement;
use Service\Utils\Common;

class Model extends Medoo
{
    protected $prefix = '';
    protected string $table ='';
    protected string $dbname = 'default';
    protected string $database_type = 'mysql';
    protected string $pk = 'id';


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

    protected function getConnectOptions()
    {
        $settings = Base::$container->get('settings')['database'];
        return $settings[$this->dbname];
	}


    public function getData($map, $join = null, $fields = '*')
    {
        if (empty($map)) {
            return [];
        }
        if (!empty($join)) {
            $result =  $this->get($this->table, $join, $fields, $map);
        } else {
            $result = $this->get($this->table, $fields, $map);
        }

        if ($result === false) {
            $this->debugError();
        }
        return $result;
	}

	/**
     * @param $map
     * @param null $join
     * @param string $field
     * @return array|null
     */
    public function all($map, $join = null, $field = '*') : ?array
    {
        if (empty($map)) {
            return [];
        }
        if (!empty($join)) {
            $result = $this->select($this->table, $join, $field, $map);
        } else {
            $result = $this->select($this->table, $field, $map);
        }

        if ($result === false) {
            $this->debugError();
        }
        return $result;
	}


    public function getTable() : string
    {
        return $this->table;
    }

    public function getRealTable() : string
    {
        return $this->tableQuote($this->table);
    }

    public function debugError()
    {
        if (Base::$container->get('settings')['MEDOO_DEBUG']) {
            if (!empty($this->errorInfo)) {
                $message = json_encode($this->errorInfo);
            } else {
                $message = json_encode($this->log());
            }
            throw new \Exception($message);
        }
    }

    public function save(array $values, array $where = []) : int
    {
        if (isset($values[$this->pk]) && !empty($values[$this->pk])) {
            $where = [$this->pk => $values[$this->pk]];
            unset($values[$this->pk]);
        }
        if (!empty($where)) {
            $res =  $this->update($this->table, $values, $where);
            if (!empty($res)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            $this->insert($this->table, $values);
            return $this->id();
        }
    }

}

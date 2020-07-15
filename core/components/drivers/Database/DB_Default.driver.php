<?php

/* 
    Anza - 1
    Version: 1.0.0
    Author: XL Scripts Core Team
    url: https://xlscripts.com

    XL Scripts - 2020
    This software is licensed under the MIT License.

    __   __ _       _____  _____ ______  _____ ______  _____  _____ 
    \ \ / /| |     /  ___|/  __ \| ___ \|_   _|| ___ \|_   _|/  ___|
    \ V / | |     \ `--. | /  \/| |_/ /  | |  | |_/ /  | |  \ `--. 
    /   \ | |      `--. \| |    |    /   | |  |  __/   | |   `--. \
    / /^\ \| |____ /\__/ /| \__/\| |\ \  _| |_ | |      | |  /\__/ /
    \/   \/\_____/ \____/  \____/\_| \_| \___/ \_|      \_/  \____/ 
                                                                        
*/

namespace Anza\Drivers\Database;

use \Anza\Load;

class DB_Default {
    private $host;
    private $username;
    private $password;
    private $database;
    
    public $builder;

    public function __construct($credentials) {
        Load::File(CORE_PATH . 'third_party/clancats-hydrahon/autoload.php');

        $this->host     = $credentials['host'];
        $this->username = $credentials['username'];
        $this->password = $credentials['password'];
        $this->database = $credentials['database'];
        $this->charset  = isset($credentials['charset']) ? $credentials['charset'] : 'utf8';

        $this->init_driver();
    }

    public function init_driver() {
        $connection = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=" . $this->charset, $this->username, $this->password);;

        $this->builder = new \ClanCats\Hydrahon\Builder('mysql', function($query, $queryString, $queryParameters) use($connection) {
            $statement = $connection->prepare($queryString);
            $statement->execute($queryParameters);
            if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface) {
                $error  = array(
                    'code'  => $connection->errorCode(),
                    'info'  => $connection->errorInfo()
                );

                $id     = $connection->lastInsertId();
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
                return new \Anza\Components\DatabaseResult($statement->rowCount(), $result, $id, $error);
            }
        });
    }
}
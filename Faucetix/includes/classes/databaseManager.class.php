<?php

/*  _____                    _   _      
 * |  ___|_ _ _   _  ___ ___| |_(_)_  __
 * | |_ / _` | | | |/ __/ _ \ __| \ \/ /
 * |  _| (_| | |_| | (_|  __/ |_| |>  < 
 * |_|  \__,_|\__,_|\___\___|\__|_/_/\_\                                     
 *
 * @name: Faucetix Faucet Script
 * @author: Wallace Calvet
 * @author: Neto Melo (neto737) <contact@neto737.net>
 * @license: GNU General Public License v3
 * @copyright: Copyright (c) 2016 Faucetix
 */

class databaseManager {

    private static $init = false;
    private $_Engine = null;

    public static function Initialize() {
        return self::$init == false ? self::$init = new databaseManager : self::$init;
    }

    public function __construct($dbtype, $dbhost, $dbport, $dbuser, $dbpass, $dbname, $dbchar) {
        try {
            $this->DatabaseType = $dbtype;
            $this->DatabaseHost = $dbhost;
            $this->DatabasePort = $dbport;
            $this->DatabaseUser = $dbuser;
            $this->DatabasePass = $dbpass;
            $this->DatabaseName = $dbname;
            $this->DatabaseChar = $dbchar;
            $this->Process = null;

            self::Connect();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    private function Connect() {
        $this->_Engine = new PDO($this->DatabaseType . ':host=' . $this->DatabaseHost . ';port=' . $this->DatabasePort . ';dbname=' . $this->DatabaseName . '', $this->DatabaseUser, $this->DatabasePass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $this->DatabaseChar));
        $this->_Engine->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function Query($query) {
        try {
            $this->Process = $this->_Engine->prepare($query);
            return $this;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function Bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->Process->bindValue($param, $value, $type);
    }

    public function Execute() {
        try {
            $this->Process->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function Single($type = false) { // PDO::FETCH_ASSOC
        self::Execute();
        return $this->Process->fetch($type);
    }

    public function resultSet($type = false) {
        self::Execute();
        return $this->Process->fetchAll($type);
    }

    public function rowCount() {
        self::Execute();
        return $this->Process->rowCount();
    }

    public function Evaluate($default_value = 'undefined') {
        self::Execute();
        return (self::rowCount() < 1) ? $default_value : $this->Process->fetchColumn();
    }

    public function lastInsertId($param = false) {
        return $this->_Engine->lastInsertId($param);
    }

    private function Disconnect() {
        $this->_Engine = null;
    }

    public function __destruct() {
        self::Disconnect();
    }

}

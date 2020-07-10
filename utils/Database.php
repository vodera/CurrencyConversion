<?php

require_once __DIR__ . "/../conf/Config.php";

/**
 * Class Database
 * This class houses all the DB functions
 */
class Database
{

    private $dbh;

    /**
     * Database constructor.
     * initilises and opens the database connection
     */
    function __construct()
    {
        try {

            $dbtns = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = " . Config::DB_HOST . ")(PORT = " . Config::DB_PORT .
                ")) (CONNECT_DATA = (SERVICE_NAME = " . Config::DB_SERVICE_NAME . ") (SID = " . Config::DB_SID . ")))";

            //$this->dbh = new PDO("mysql:host=".$server.";dbname=".dbname, $db_username, $db_password);

            $this->dbh = new PDO("oci:dbname=" . $dbtns . ";charset=utf8", Config::DB_USERNAME, Config::DB_PASSWORD, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * select function to execute all select statements
     * @param $sql
     * @return array of records
     */
    public function select($sql)
    {
        $sql_stmt = $this->dbh->prepare($sql);
        $sql_stmt->execute();
        $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

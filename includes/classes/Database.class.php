<?php

/**
 * Database short summary.
 *
 * Database description.
 *
 * @version 1.0
 * @author xSamagon
 */
class Database
{
    /*
     * Def of vars
     */
    public $db;
    private $dbname;
    private $dbhost;
    private $dbuser;
    private $dbport;
    private $dbpass;
    /*
     * End of Def of vars
     */

    /*
     * Function construct
     * Example call: new Database(host, port, user, pass, name);
     * Usage: Init of Database -> Connect to Database
     */
    public function __construct($host, $port, $user, $pass, $name)
    {
        $this->dbhost = $host;
        $this->dbport = $port;
        $this->dbuser = $user;
        $this->dbpass = $pass;
        $this->dbname = $name;
        try {
            $this->db = new PDO("mysql:host={$this->dbhost};port={$this->dbport};dbname={$this->dbname}", "{$this->dbuser}", "{$this->dbpass}");
        }
        catch (PDOException $ex)
        {
            die($ex);
        }
    }

    public function userLogin($email, $password)
    {
        if ($this->db == NULL)
            die("No Database Connection!");

        $qry = $this->db->prepare("SELECT apikey FROM accounts WHERE email = ? AND password = ?;");
        $qry->bindParam(1, $email);
        $qry->bindParam(2, $password);
        $qry->execute();
        $fetched = $qry->fetchAll(PDO::FETCH_ASSOC);
        if ($qry->rowCount() > 0)
            return sprintf("1,%s,LIFETIME,0", $fetched[0]["apikey"]);
        else
            return "-1";
    }

    public function userLoginByKey($email, $key)
    {
        if ($this->db == NULL)
            die("No Database Connection!");

        $qry = $this->db->prepare("SELECT apikey FROM accounts WHERE email = ? AND apikey = ?;");
        $qry->bindParam(1, $email);
        $qry->bindParam(2, $key);
        $qry->execute();
        $fetched = $qry->fetchAll(PDO::FETCH_ASSOC);
        if ($qry->rowCount() > 0)
            return sprintf("1,%s,LIFETIME,0", $fetched[0]["apikey"]);
        else
            return "-1";
    }

    public function checkKey($key)
    {
        if ($this->db == NULL)
            die("No Database Connection!");

        $qry = $this->db->prepare("SELECT count(email) as tt FROM accounts WHERE apikey = ?;");
        $qry->bindParam(1, $key);
        $qry->execute();
        $fetched = $qry->fetchAll(PDO::FETCH_ASSOC);
        if ($fetched[0]["tt"] > 0)
            return true;
        return false;
    }

    public function getDomainByKey($key)
    {
        if ($this->db == NULL)
            die("No Database Connection!");

        $qry = $this->db->prepare("SELECT domain FROM accounts WHERE apikey = ?;");
        $qry->bindParam(1, $key);
        $qry->execute();
        $fetched = $qry->fetchAll(PDO::FETCH_ASSOC);
        return $fetched[0]["domain"];
    }

    public function insertFile($apikey, $name, $orginalname, $thumbenabled)
    {
        if ($this->db == NULL)
            die("No Database Connection!");

        $qry = $this->db->prepare("INSERT INTO files(apikey, name, orginalname, thumbenabled, date) VALUES(?, ?, ?, ?, NOW());");
        $qry->bindParam(1, $apikey);
        $qry->bindParam(2, $name);
        $qry->bindParam(3, $orginalname);
        $qry->bindParam(4, $thumbenabled);
        $qry->execute();
    }

    public function updateViewCount($name)
    {
        if ($this->db == NULL)
            die("No Database Connection!");

        $qry = $this->db->prepare("UPDATE files SET viewcount=viewcount+1 WHERE name = ?;");
        $qry->bindParam(1, $name);
        $qry->execute();
    }

    public function getLastFilesByKey($apikey)
    {
        if ($this->db == NULL)
            die("No Database Connection!");

        $qry = $this->db->prepare("SELECT * FROM files WHERE apikey = ? ORDER BY date DESC LIMIT 5;");
        $qry->bindParam(1, $apikey);
        $qry->execute();
        return $qry->fetchAll();
    }
}
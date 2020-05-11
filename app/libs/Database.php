<?php
    // Class for connected Database with PDO
    class Database{
        private $driver = DB_DRIVER;
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASSWORD;
        private $dbnane = DB_NAME;


        private $dbh;
        private $stmt;
        private $error;



        public function __construct(){
            // config connection
            $dsn = DB_DSN[$this->driver];
            
            $options = array(
                PDO::ATTR_PERSISTENT=> ($this->driver == 'access'? FALSE :  TRUE),
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Create PDO instance

            try {
                $this->dbh = new PDO($dsn,$this->user,$this->password,$options);
                if($this->driver == 'mysql'){
                    $this->dbh->exec('set names utf8');
                }
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // prepare query
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        // link query with bind
        public function bind($parameter,$value,$type = null){
            if(is_null($type)){
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
                        break;
                }
            }
            $this->stmt->bindValue($parameter,$value,$type);
        }

        //Execute query
        public function execute(){
            return $this->stmt->execute();
        }

        //get records
        public function records(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // get a record
        public function record() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // get count rows
        public function rowCount() {
            return $this->stmt->rowCount();
        }



    }
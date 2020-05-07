<?php


    namespace keybmin_install;
    use Exception;
    use mysqli;
    use \SeinopSys\PostgresDb;


    class keybmin_install{

        public $host   = 'localhost';
        public $dbtype = 'mysqli';
        public $dbname = 'keybmin';
        public $port   = '3306';
        public $user   = 'root';
        public $pass   = '';
        public $sqlPath= '';

        public function __construct($host,$user,$pass,$dbname,$dbtype='mysqli',$port='3306'){

            $this->host     = $host;
            $this->user     = $user;
            $this->pass     = $pass;
            $this->dbname   = $dbname;
            $this->dbtype   = $dbtype;
            $this->port     = $port;

        }

        public function install($sqlPath=null){

            if($sqlPath != null){
                if(file_exists($sqlPath)){

                    $this->sqlPath = $sqlPath;
                    $sqlText = file_get_contents($sqlPath);

                    if($this->dbtype == 'mysqli'){

                        $db = $this->mysql_connect();
                        $install = $db->multi_query($sqlText);

                    }else if($this->dbtype == 'postgresql'){

                        $db = $this->postgresql_connect();
                        try {
                            $install = @$db->getConnection()->exec($sqlText);
                        }catch (Exception $err){
                            $this->returnMessage([$err->getMessage()]);
                        }
                    }

                    if($install){
                        return true;
                    }else{
                        return $this->lang(6);
                    }

                }else{
                    return $this->lang(3);
                }

            }else{
                return $this->lang(1);
            }

            return false;
        }

        public function mysql_connect(){

            $mysqli = @new mysqli($this->host,$this->user,$this->pass,$this->dbname,$this->port);
            if($mysqli->connect_error){
                return $this->returnMessage([$mysqli->connect_error]);
                return $this->lang(4);
            }else{
                return $mysqli;
            }
            return false;

        }

        public function postgresql_connect(){

            require (__DIR__).'/library/PostgresDb.php';
            $db = new PostgresDb($this->dbname, $this->host, $this->user, $this->pass);
            try {
                $db->getConnection();
                return $db;
            } catch (Exception $err) {
                return $this->lang(5);
            }

            return false;
        }

        private function lang($code=0){

            $lang = [
                '1' => 'Not found Sql Path Parameters',
                '2' => 'Mysql connect error',
                '3' => 'Not found sql path',
                '4' => 'Mysqli connect error',
                '5' => 'Postgresql connect error',
                '6' => 'Sql query error',
            ];

            $result = [
                'status' => 'danger',
                'message' => $lang[$code],
            ];

            return $this->returnMessage($result);

        }

        function returnMessage($msg = []){
            throw new Exception(json_encode($msg));
            exit;
        }
    }
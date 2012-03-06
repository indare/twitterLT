<?php

    class listUtil {
            private $dbUtil;
            function __construct () {
                $this->dbUtil = new dbUtil();
            }

            function getTweetList(){
                $listArray = $this->dbUtil->getTweetList();
                $output="";
                foreach($listArray as $list){
                    $output .= $this->makeRowHTML($list["no"],$list["trantime"],$list["tweet"]);
                }
                return $output;
            }

            private function makeRowHTML($no,$trantime,$tweet){
                return"<tr><td>$no</td><td>$trantime</td><td>$tweet</td></tr>\n";
            }

        }

    class dbUtil {
        private $pdoCon;

        function __construct () {

        }

        private function openConnect(){
            $this->pdoCon = new PDO("mysql:host=".dbHost.";dbname=".dbName,
                            dbUser, dbPass,
                            array(PDO::MYSQL_ATTR_INIT_COMMAND=> "set character set 'utf8'",
                                  ));
        }

        function saveTweet ($datetime, $message) {
            $this->openConnect();
            $stmt = $this->pdoCon->prepare("insert into tweet_log (trantime,tweet) values(?, ?)");
            $returnValue = $stmt->execute(array($datetime, $message));
            return $returnValue;
        }

        function getTweetList () {
            $this->openConnect();
            $stmt = $this->pdoCon->query("select no,trantime,tweet from tweet_log order by no");
            $returnArray = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($returnArray, array("no"=>$row["no"],"trantime"=>$row["trantime"],"tweet"=>$row["tweet"]));
            }
            return $returnArray;
        }
    }

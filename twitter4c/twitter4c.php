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
                $output .= $this->makeRowHTML($list["no"],$list["trantime"],$list["name"],$list["tweet"]);
            }
            return $output;
        }
        private function makeRowHTML($no,$trantime,$name,$tweet){
            return"<tr><td>$no</td><td>$trantime</td><td>$name</td><td>$tweet</td></tr>\n";
        }

    }

    class dbUtil {
        private $pdoCon;

        private function openConnect(){
            $this->pdoCon = new PDO("mysql:host=".dbHost.";dbname=".dbName,
                            dbUser, dbPass,
                            array(PDO::MYSQL_ATTR_INIT_COMMAND=> "set character set 'utf8'",
                                  ));
        }

        function saveTweet ($datetime, $name,$message) {
            $this->openConnect();
            $stmt = $this->pdoCon->prepare("insert into tweet_log (trantime,name,tweet) values(?, ?, ?)");
            $returnValue = $stmt->execute(array($datetime, $name, $message));
            return $returnValue;
        }

        function getTweetList () {
            $this->openConnect();
            $stmt = $this->pdoCon->query("select no,trantime,name,tweet from tweet_log order by no");
            $returnArray = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($returnArray, array("no"=>$row["no"],"trantime"=>$row["trantime"],"name"=>$row["name"],"tweet"=>$row["tweet"]));
            }
            return $returnArray;
        }
    }

    class twitter4c {
        private $account_length;

        function __construct () {
            require_once(dirname(__FILE__)."/setting.php");
            $this->account_length = strlen(account);
        }

        function tweet ($name,$message) {
            require_once(dirname(__FILE__)."/setting.php");
            //require_once(dirname(__FILE__)."/local_setting.php");
            $dbUtil = new dbUtil();
            $dbUtil->saveTweet(date("Y/m/d H:i:s"),$name,$message);

            //140文字制限
            $message = "問い合わせがありました。";

            //tmhOAuth初期化
            require_once(tmhOauth);
            require_once(tmhUtil);
            $twitter = new tmhOAuth(
                array(
                    "consumer_key"    => consumer_key,
                    "consumer_secret" => consumer_secret,
                    "user_token"      => access_token,
                    "user_secret"     => access_token_secret
                ));

            $code = $twitter->request('POST', $twitter->url('1/statuses/update'),
                array('status' => account." ".$message
                ));

            if ($code == 200) {
                tmhUtilities::pr(json_decode($twitter->response['response']));
            } else {
                tmhUtilities::pr($twitter->response['response']);
            }

            return true;

        }

    }

    ini_set("date.timezone", "Asia/Tokyo");

    $twitter4c = new twitter4c();

    switch($_POST["type"]){
        case "put":
            echo $twitter4c->tweet($_POST["name"],$_POST["message"]);
            break;
        case "get":
            $listUtil = new listUtil();
            return $listUtil->getTweetList();
            break;
    }


?>
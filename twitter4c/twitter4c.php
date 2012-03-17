<?php

    class twitter4c {
        private $account_length;

        function __construct () {
            require_once(dirname(__FILE__)."/setting.php");
            $this->account_length = strlen(account);
        }

        function tweet ($message) {
            require_once(dirname(__FILE__)."/setting.php");
            //require_once(dirname(__FILE__)."/local_setting.php");
            require_once(dirname(__FILE__)."/dbUtil.php");
            $dbUtil = new dbUtil();
            $dbUtil->saveTweet(date("Y/m/d H:i:s"),$message);

            //140文字制限
            if ((strlen($message) + $this->account_length +1) >= 140) {
                $message = "長すぎるので省略されました。";
            }

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

    //post時動作
    $twitter4c = new twitter4c();
    echo $twitter4c->tweet($_POST["message"]);

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m_arino
 * Date: 12/02/13
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */

class twitter4c{
    private $account_length;
    private $oauth_state;

    function __construct () {
        $account_length = strlen(account);
    }

    function tweet($message){
        //140文字制限
        if(strlen($message) + $this->account_length >140){return false;}

        /*
         * TwitterAPIポケットリファレンス(P.103)
         * 一部、tmhOAuthに変更があります。
         * tmhOAuthのコンストラクタで渡す際のArrayKey名変更
         */

        //tmhOAuth初期化
        require_once("setting.php");
        //require_once("local_setting.php");
        require_once(tmhOauth);
        require_once(tmhUtil);
        $twitter = new tmhOAuth(
                            array(
                            "consumer_key" => consumer_key,
                            "consumer_secret" => consumer_secret,
                            "user_token" => access_token,
                            "user_secret" => access_token_secret
                            ));

        $code = $twitter->request('POST', $twitter->url('1/statuses/update'), array(
          'status' => account . " " . $message
        ));

        if ($code == 200) {
          tmhUtilities::pr(json_decode($twitter->response['response']));
        } else {
          tmhUtilities::pr($twitter->response['response']);
        }

        return $code;

    }

}

$twitter4c = new twitter4c();
echo $twitter4c->tweet($_POST["message"]);

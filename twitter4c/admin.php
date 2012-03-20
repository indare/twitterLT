<?php

    require_once(dirname(__FILE__)."/setting.php");
    require_once(dirname(__FILE__) . "/twitter4c.php");

    $listUtil = new listUtil();

    return $listUtil->getTweetList();

?>
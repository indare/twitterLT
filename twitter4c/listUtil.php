<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: m_arino
     * Date: 12/02/14
     * Time: 19:39
     * To change this template use File | Settings | File Templates.
     */
    class listUtil {
        private $dbUtil;
        function __construct () {
            require_once(dirname(__FILE__). "/dbUtil.php");
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
            return "<tr><td>$no</td><td>$trantime</td><td>$tweet</td></tr>\n";
        }

    }

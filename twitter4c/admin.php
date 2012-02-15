<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m_arino
 * Date: 12/02/14
 * Time: 19:37
 * To change this template use File | Settings | File Templates.
 */
    //require_once(dirname(__FILE__)."/setting.php");
    require_once(dirname(__FILE__)."/local_setting.php");
    require_once(dirname(__FILE__) . "/dbUtil.php");

    $listUtil = new listUtil();

    $outputRow = $listUtil->getTweetList();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>twitter4c test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-style-type" content="text/css">
    <link rel="stylesheet" href="./twitter4c.css" type="text/css">
</head>
<body>
<form method="post" action="admin.php">
    <input type="submit" value="表示"/><br />
    <table width="100%" style="word-break:break-all;">
        <thead>
            <tr>
                <th width="10%">No</th><th width="30%">日時</th><th width="60%">tweet</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $outputRow; ?>
        </tbody>
    </table>
</form>
</body>
</html>


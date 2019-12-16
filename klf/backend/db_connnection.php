<?php
function OpenCon()
{
    // echo "starting OpenCon()<br>";
    //105.48.68.38
    $dbhost = "a2plcpnl0066.prod.iad2.secureserver.net";
    $dbuser = "klf3";
    $dbpass = "38sa0xe21d0j";
    $db = "klf3";
    //echo "01...<br>";
    $conn = new PDO("mysql:host=$dbhost;dbname=$db", "$dbuser", "$dbpass");
    // echo "1...<br>";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "2...<br>";

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}

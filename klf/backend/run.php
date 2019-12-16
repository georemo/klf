<?php
include "content.php";
$ret = '{"app_state":{"success":1,"info":{"messages":"","code":0,"app_msg":[]},"sess":{"cd_token":"","jwt":null,"p_sid":"","ttl":"120"},"cache":{"dat_scope":null}},"data":[]}';

function run(){
    if(isset($_REQUEST["m"])){
        $c = $_REQUEST["c"];
        $a = $_REQUEST["a"];
        $cont = new $c();
        $ret = $cont->$a();
        respond($ret);
    }
    else{
        respond(null);
    }
}

function respond($ret){
    echo '{"app_state":{"success":1,"info":{"messages":"","code":0,"app_msg":[]},"sess":{"cd_token":"","jwt":null,"p_sid":"","ttl":"120"},"cache":{"dat_scope":null}},"data":' . $ret . '}';
}
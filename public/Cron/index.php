<?php


$QUEUE = filter_input(INPUT_GET, "QUEUE");
$EXECUTE = filter_input(INPUT_GET, "EXECUTE");

if($QUEUE){
    header("Location: https://megadisparo.dg_tech.com.br/mount/queue/");
}

if($EXECUTE){
    header("Location: https://megadisparo.dg_tech.com.br/queue/execute/");
}

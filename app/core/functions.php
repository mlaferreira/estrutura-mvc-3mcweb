<?php
function dd(...$vars){
    echo '<pre style="background-color: #f5f5f5;
    color: #212529;
    padding: 10px;
    font-family: monospace;">';
    var_dump($vars);
    echo '</pre>';
    die();
}
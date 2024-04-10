<h1>This is custom About page</h1>

<?php

    $data = "Hello World";

    $a = &$data;
    $b = &$a;

    var_dump($a === $data);
    var_dump($b === $data);

    $arr = [];
    $arr2 = &$arr;

    $arr[] = 2;
    unset($arr);

    var_dump($arr2);
    

?>
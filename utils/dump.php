<?php

function dump(mixed $data, string $type = 'print', ): void
{

    if ($type === 'print') {
        echo "<pre>";


            print_r($data);




        echo "</pre>";
    }

    if ($type === 'dump') {
        echo "<pre>";


            var_dump($data);




        echo "</pre>";
    }

}
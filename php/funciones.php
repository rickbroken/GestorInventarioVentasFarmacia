<?php

function SecurityInputs($str1){
    $str1 = filter_var($str1, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $str1 = htmlspecialchars($str1);
    return $str1;
}



?>
<?php

include '../db/config.php';
$key = '';
$val1 = substr(md5(uniqid(rand(), true)), 1, 1);
$val2 = substr(md5(uniqid(rand(), true)), 1, 1);
$val3 = substr(md5(uniqid(rand(), true)), 1, 1);
$val4 = substr(md5(uniqid(rand(), true)), 1, 1);
$codeval = "{$val1}{$val2}{$val3}{$val4}"; 
$key .= "
<div class='key1'>{$val1}</div>
<div class='key1'>{$val2}</div>
<div class='key1'>{$val3}</div>
<div class='key1'>{$val4}</div>
<input type='hidden' name='codeval' value='{$codeval}' required>
";
echo $key;

?>
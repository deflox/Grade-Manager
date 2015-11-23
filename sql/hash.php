<?php

//echo password_hash(htmlspecialchars($_GET["pw"]), PASSWORD_DEFAULT);
echo mktime(0, 0, 0, 11, 22, 2015) . '<br>';
echo date('Y/m/d', mktime(0, 0, 0, 11, 22, 2015)) . '<br>';
echo strtotime('22/11/2015') . '<br>';
$timestamp =  DateTime::createFromFormat('Y/m/d', '2015/11/22')->getTimestamp();
echo $timestamp . '<br>';
echo date ( 'm/d/Y' , $timestamp );

/*
 * dd.mm.yyyy (works)
 * dd-mm-yyyy (works)
 * dd/mm/yyyy (works if you replace slashes with - )
 *
 */
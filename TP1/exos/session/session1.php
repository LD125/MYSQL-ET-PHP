<?php

session_start(); // premet de créer une session, ou d'en ouvrir une si elle existe

$_SESSION['login'] = 'Fred';

echo '<pre>';
var_dump( $_SESSION);
var_dump($_COOKIE);
echo '</pre>';

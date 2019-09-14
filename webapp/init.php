<?php

/* Start new session with "user_id" set to 1.*/

session_start();

$_SESSION['user_id'] = 1;

/* Create a new Php Data Object that consists of the contents of TTWTTD 
 * database */

$db = new PDO('mysql:dbname=TTWTTD;host=localhost', 'root', 'root');

/* Check for a connection error and, if so, return error information. Else,
return confirmation connection made successfully */

if (mysqli_connect_error()) {
  die('Connect Totes Error ('.mysqli_connect_errno().') '
          .mysqli_connect_error());
}


<?php

/* Initialize connection to TTWTTD database.*/

require_once 'webapp/init.php';

/* Check if user input has been entered in "ttw_name" input box and, if so, 
execute a prepared SQL statement to insert such input into "items_ttw" table. */

if(isset($_POST['ttw_name'])) {
    $name_ttw = trim($_POST['ttw_name']);
    
    if(!empty($name_ttw)) {
        $added_ttwQuery = $db->prepare("
                INSERT INTO items_ttw (name, user, remove, created)
                VALUES (:name, :user, 0, NOW())
        ");
        
        $added_ttwQuery->execute([
            'name' => $name_ttw,
            'user' => $_SESSION['user_id']
        ]);
    }
    
}

/* Check if user input has been entered in "ttd_name" input box and, if so, 
execute a prepared SQL statement to insert such input into "items_ttd" table. */

if(isset($_POST['ttd_name'])) {
    $name_ttd = trim($_POST['ttd_name']);
    if(!empty($name_ttd)) {
        $added_ttdQuery = $db->prepare("
                INSERT INTO items_ttd (name, user, remove, created)
                VALUES (:name, :user, 0, NOW())
        ");
        
        $added_ttdQuery->execute([
            'name' => $name_ttd,
            'user' => $_SESSION['user_id']
        ]);
    }
    
}

/* No matter what happens with code above, return to "index.php" page*/
header('Location: index.php');


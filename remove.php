<?php

/* Initialize connection to TTWTTD database.*/

require_once 'webapp/init.php';

/* If two variables sent via the Remove button link have values other than 
null, assign them to short local variable names and run those through a switch
statement executing a prepared SQL statement to DELETE the corresponding list 
item id from the "items_ttw" table. */

if(isset($_GET['as_ttw'], $_GET['item_ttw'])) {
    $as     = $_GET['as_ttw'];
    $item   = $_GET['item_ttw'];
    
    switch($as) {
        case 'remove_ttw':
            $remove_ttwQuery = $db->prepare("
                DELETE FROM items_ttw
                WHERE id = :item_ttw
                AND user = :user
            ");
            
            $remove_ttwQuery->execute([
                'item_ttw' => $item,
                'user' => $_SESSION['user_id']
            ]);
        break;
    }
}

/* Executes the same as above but for matching list item ids in the "items_ttd"
table. */

if(isset($_GET['as_ttd'], $_GET['item_ttd'])) {
    $as     = $_GET['as_ttd'];
    $item   = $_GET['item_ttd'];
    
    switch($as) {
        case 'remove_ttd':
            $remove_ttwQuery = $db->prepare("
                DELETE FROM items_ttd
                WHERE id = :item_ttd
                AND user = :user
            ");
            
            $remove_ttwQuery->execute([
                'item_ttd' => $item,
                'user' => $_SESSION['user_id']
            ]);
        break;
    }
}

/* No matter what happens with code above, return to "index.php" page*/

header('Location: index.php');

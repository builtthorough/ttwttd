<?php

/* Initialize connection to TTWTTD database*/

require_once 'webapp/init.php';

/* Create a prepared MySQL Query statement to select id and name items from 
 * items_ttw table and execute with user placeholder filled with current user */

$items_ttwQuery = $db->prepare("
            SELECT id, name
            FROM items_ttw
            WHERE user = :user
");
        
$items_ttwQuery->execute([
    'user' => $_SESSION['user_id']
]);

/* Using a ternary operator, set the "$items_ttw" variable to the array
 * resulting from the above prepared query if rowCount() > 0 else an
 * empty array if rowCount() returns 0 */

$items_ttw = $items_ttwQuery->rowCount() ? $items_ttwQuery : [];

/* Below does exactly the same as above but for the "items_ttd" table*/

$items_ttdQuery = $db->prepare("
            SELECT id, name
            FROM items_ttd
            WHERE user = :user
");
        
$items_ttdQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items_ttd = $items_ttdQuery->rowCount() ? $items_ttdQuery : [];

?>


<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>The Dull Pencil</title>
        <meta name="TTWTTD" content="A productivity tool to help you 
              develop skills by remembering the lessions learned on your 
              journey.">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <div id= "banner"><h1 id= "skillgoal">Pocket Billiards</h1></div>
        <div class= "row">
            <div class= "column" id= "column_1"> 
                <h3 id= "ttw"> Things That Work</h3>
                <div>
                    <form class= "item_add" id= "ttw_item_add" action= "add.php"
                          method= "post">
                        <input type= "text" name= "ttw_name" class= "input" 
                               autocomplete="off" onfocus= "this.value=''" 
                               value= "What Worked?"><br>
                        <input type= "submit" value= "Submit" class= "submit">
                    </form>
                    
                    <!--Check to see if there are items in the items_ttw list 
                    and, if so, cycle through them print them out as list items
                    in html. If no items added, print notifier of empty list.-->
                    
                    <?php if(!empty($items_ttw)): ?>
                    <ul class= "list">
                        <?php foreach($items_ttw as $item_ttw): ?>
                            <li><span><?php echo $item_ttw['name']; ?></span>
                                
                                <!-- Link Remove button to "remove.php" and send
                                variables-->
                                <a href= "remove.php?as_ttw=remove_ttw&item_ttw=
                                    <?php echo $item_ttw['id'];?>" 
                                    class= "remove_button">Remove</a></li>
                                    
                        <?php endforeach; ?>
                    </ul>
                    <?php else: ?> 
                    <p>You haven't added any things that worked yet!</p>
                    <?php endif; ?>
                </div>
            </div>
            <div id= "vertical_line">
            </div>

            <div class= "column" id= "column_2">
                <h3 id= "ttd"> Things That Don't</h3>
                <div>
                    <form class= "item_add" id= "ttd_item_add" action= "add.php"
                          method= "post">
                        <input type= "text" name= "ttd_name" class= "input" 
                               autocomplete="off" onfocus= "this.value=''" 
                               value= "What Worked?"><br>
                        <input type= "submit" value= "Submit" class= "submit">
                    </form>
                    
                    <!--Check to see if there are items in the items_ttw list 
                    and, if so, cycle through them print them out as list items
                    in html. If no items added, print notifier of empty list.-->
                    
                    <?php if(!empty($items_ttd)): ?>
                    <ul class= "list">
                        <?php foreach($items_ttd as $item_ttd): ?>
                            <li><span><?php echo $item_ttd['name']; ?></span>
                                
                                <!-- Link Remove button to "remove.php" and send
                                variables-->
                                
                                <a href= "remove.php?as_ttd=remove_ttd&item_ttd=
                                    <?php echo $item_ttd['id'];?>" 
                                    class= "remove_button">Remove</a></li>
                            <li><span></span></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else: ?> 
                    <p>You haven't added any things that worked yet!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>


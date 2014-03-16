<?php
/******************************************************************************
 * get_tree.php
 * 
 * Retrieves the whole dialog tree from the database and outputs it in
 * a file tree-style format. Yay recursion
 ******************************************************************************/

require('inc/database.php');

function getChildren($nodeID) {
   
    // Get current node
    $sql = "SELECT * FROM `nodes` WHERE `n_parent` = '".$nodeID."'";
    
    $result = mysql_query($sql);
    
    if(mysql_num_rows($result) != 0) {
        echo '<ul>'."\n";
        while( $result2 = mysql_fetch_array($result) ) {
            if($nodeID == '0') {
                echo '<li><a href="#" rel="' . $result2['n_id'] . '" class="dialogNode">' . $result2['n_name'] . '</a></li>'."\n";
            } else {
                echo '<li><a href="#" rel="' . $result2['n_id'] . '" class="dialogNode">' . $result2['n_action'] . '</a></li>'."\n";
            }
            getChildren($result2['n_id']);
        }
        
        echo '</ul>'."\n";
    }
}

getChildren('0');
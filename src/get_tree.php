<?php
/******************************************************************************
 * get_tree.php
 * 
 * Retrieves the whole dialog tree from the database and outputs it in
 * a file tree-style format.
 ******************************************************************************/

require('inc/database.php');

function getChildren($nodeID) {
   
    // Get current node
    $sql = "SELECT * FROM `nodes` WHERE `n_parent` = '".$nodeID."'";
    
    $result = mysql_query($sql);
    
    if(mysql_num_rows($result) != 0) {
        echo '<ul class="jqueryFileTree">'."\n";
        while( $result2 = mysql_fetch_array($result) ) {
            if($nodeID == '0') {
                echo '<li class="directory collapsed"><a href="#" rel="' . $result2['n_id'] . '" class="dialogNode">' . $result2['n_name'] . '</a></li>'."\n";
            } else {
                echo '<li class="directory collapsed"><a href="#" rel="' . $result2['n_id'] . '" class="dialogNode">' . $result2['n_action'] . '</a></li>'."\n";
            }
            getChildren($result2['n_id']);
        }
        
        echo '</ul>'."\n";
    }
}

getChildren('0');

/* // Old tree view
$nodeID = urldecode($_POST['dir']);
$nodeID = str_replace("/", "", $nodeID);

if ( is_numeric($nodeID) ) {
    echo '<ul class="jqueryFileTree" style="display: none;">';
    
    // Get current node
    $sql = "SELECT * FROM `nodes` WHERE `n_parent` = '".$nodeID."'";
    
    $results = mysql_query($sql);
    
    while( $result = mysql_fetch_array($results) ) {
        if($nodeID == '0') {
            echo '<li class="directory collapsed"><a href="#" rel="' . $result['n_id'] . '" class="dialogNode">' . $result['n_name'] . '</a></li>';
        } else {
            echo '<li class="directory collapsed"><a href="#" rel="' . $result['n_id'] . '" class="dialogNode">' . $result['n_action'] . '</a></li>';
        }
        
    }

    //  getChildNodes($id)
    echo '</ul>';
}
*/

/* End of file get_tree.php */
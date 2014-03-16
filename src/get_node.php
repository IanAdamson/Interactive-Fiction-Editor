<?php
/******************************************************************************
 * get_node.php
 * 
 * Retrieves a single dialog node from the database and outputs it as a JSON
 * object.
 ******************************************************************************/

require('inc/database.php');

$nodeID = urldecode($_POST['id']);

if ( is_numeric($nodeID) ) {
    $sql = "SELECT * FROM `nodes` WHERE `n_id` = '".$nodeID."'";
    
    $results = mysql_fetch_array(mysql_query($sql));
    
    $resultCount = count($results);
    for($i = 0; $i < $resultCount/2; $i++) {
        unset($results[$i]);
    }
    
    echo json_encode($results);
    //echo print_r($results);
}

/* End of file get_tree.php */
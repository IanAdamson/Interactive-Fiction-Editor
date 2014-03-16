<?php
/******************************************************************************
 * delete_node.php
 * 
 * Delete's a node.
 ******************************************************************************/

require('inc/database.php');

$nodeID = urldecode($_POST['id']);

// Check if node is leaf node
$stmt = $mysqli->prepare("SELECT * FROM `feldarkrealmscyo`.`nodes` WHERE `n_parent` = ?");
$stmt->bind_param('i', $nodeID);
$stmt->execute();


if($stmt->num_rows()) {
    $stmt->close();
    echo 'not_leaf';
} else {
    $stmt->close();
    
    // Get and output parent node's ID.
    $stmt = $mysqli->prepare("SELECT `n_parent` FROM `feldarkrealmscyo`.`nodes` WHERE `n_id` = ? LIMIT 1");
    $stmt->bind_param('i', $nodeID);
    $stmt->execute();
    $stmt->bind_result($parent);
    $stmt->fetch();
    $stmt->close();
    
    echo $parent;
    
    // Delete the node.
    $stmt = $mysqli->prepare("DELETE FROM `feldarkrealmscyo`.`nodes` WHERE `n_id` = ?");
    $stmt->bind_param('i', $nodeID);
    $stmt->execute();
    $stmt->close();
}


/* End of file delete_node.php */
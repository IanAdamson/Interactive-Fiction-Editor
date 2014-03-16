<?php
/******************************************************************************
 * make_node.php
 * 
 * Create a new node.
 ******************************************************************************/

require('inc/database.php');

$nodeID = urldecode($_POST['id']);

echo $nodeID."\n";

$stmt = $mysqli->prepare("INSERT INTO `feldarkrealmscyo`.`nodes` (`n_name` ,`n_dialog` ,`n_action` ,`n_parent` ,`n_id`) VALUES ('New Node', '', 'New Node', ?, NULL)");

$stmt->bind_param('i', $nodeID);

$stmt->execute();

echo $mysqli->insert_id;

/* End of file make_node.php */
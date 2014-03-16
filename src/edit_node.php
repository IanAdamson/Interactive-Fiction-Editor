<?php
/******************************************************************************
 * edit_node.php
 * 
 * Builds the editor interface for one dialog node.
 ******************************************************************************/
require('inc/database.php');

$stmt = $mysqli->prepare("UPDATE `nodes` SET `n_name` = ?, `n_dialog` = ?, `n_action` = ? WHERE `n_id` = ?");

$stmt->bind_param('ssss', $_POST['title'], $_POST['dialog'], $_POST['action'], $_POST['id']);

$stmt->execute();

/* End of file edit_node.php */
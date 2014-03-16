<?php
/******************************************************************************
 * get_editor.php
 * 
 * Builds the editor interface for one dialog node.
 ******************************************************************************/

// CODE HERE

?>

<div id="editor">
    <h1><?php echo $node['name'] ?></h1>
    <textarea id="nodeDialog"><?php echo $node['dialog'] ?></textarea>
</div>
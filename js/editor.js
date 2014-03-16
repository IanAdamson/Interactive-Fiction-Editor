$(document).ready( function() {
    // Init variables
    var currentNode = 1;
    var dialogValue;

    /**************************************************************************
     * Functions
     **************************************************************************/
    
    function initTree(){
        var saveData = $.ajax({
            type: 'POST',
            url: "src/get_tree.php",
            data: {},
            dataType: "text",
            success: function(resultData) {
                $('#treeview').html(resultData);
            }
        });

        saveData.error(function() { alert("Something went wrong"); });
    }
    
    function getNode(nodeID){
        var saveData = $.ajax({
            type: 'POST',
            url: "src/get_node.php",
            data: { id: nodeID },
            dataType: "text",
            success: function(resultData) {
                // Populate editor panels
                var nodeData = jQuery.parseJSON(resultData);
                  
                currentNode = nodeData.n_id;
                  
                $('#nodeTitle').val(nodeData.n_name);
                $('#nodeAction').val(nodeData.n_action);
                $('#nodeDialog').empty().val(nodeData.n_dialog); //val(nodeData.n_dialog);
                $('#status').html("Editing node " + currentNode);
            }
        });

        // Grey out the new node button if

        // Make node's tree leaf highlighted?

        saveData.error(function() { alert("Something went wrong"); });
        return false;
    }
    
    /**************************************************************************
     * Initialize the dialog tree.
     **************************************************************************/
    
    initTree();

    /**************************************************************************
     * Initialize editor panel and handle node requests.
     **************************************************************************
    $( "#editor" ).draggable();
    */
    $(document.body).on('click', '.dialogNode', function(e){
        var target = $(e.target);
        if (target.is(".dialogNode")) {
            getNode($(this).attr('rel'));
        }
    });

    /**************************************************************************
     * Handle node update requests.
     **************************************************************************/
    $("#updateNode").click(function(){
        $('#status').html("Updating node " + currentNode + "...");
        var saveData = $.ajax({
            type: 'POST',
            url: "src/edit_node.php",
            data: { id: currentNode,
                    title: $('#nodeTitle').val(),
                    action: $('#nodeAction').val(),
                    dialog: $('#nodeDialog').val()},
            dataType: "text",
            success: function(resultData) {
                //alert($('#nodeDialog').val());
                // Reinitialize tree and navigate back to node.
                initTree();
                // FIGURE OUT HOW TO NAVIGATE BACK TO NODE. 
                
                $('#status').html("Successfully updated " + currentNode + "...");
                document.form.reset();
            }
        });

        saveData.error(function() { alert("Something went wrong"); });
            
        return false;
    });
    
    /**************************************************************************
     * Handle new node requests.
     **************************************************************************/
    
    $("#createNode").click(function(){
        $('#status').html("Creating child node for " + currentNode + "...");
        var saveData = $.ajax({
            type: 'POST',
            url: "src/make_node.php",
            data: { id: currentNode },
            dataType: "text",
            success: function(resultData) {
                // Reinitialize tree and navigate back to node.
                initTree();
                getNode(resultData);
                
                $('#status').html("Successfully created node " + resultData + "...");
                document.form.reset();
            }
        });

        saveData.error(function() { alert("Something went wrong"); });
            
        return false;
    });
    
    /**************************************************************************
     * Handle delete node requests.
     **************************************************************************/
    
    //deleteConfirm
    
    $("#deleteConfirm").click(function(){
        $('#status').html("Creating child node for " + currentNode + "...");
        var saveData = $.ajax({
            type: 'POST',
            url: "src/delete_node.php",
            data: { id: currentNode },
            dataType: "text",
            success: function(resultData) {
                // Reinitialize tree and navigate back to node.
                if(resultData == "leaf_node") {
                    $('#status').html("ERROR: Cannot delete internal nodes.");
                } else {
                    //alert(resultData);
                    initTree();
                    $('#status').html("Successfully deleted node " + currentNode + "...");
                    getNode(resultData);
                    document.form.reset();
                }
            }
        });

        saveData.error(function() { alert("Something went wrong"); });
            
        return false;
    });
    
    // Note - only allow node deletion for leaf nodes?

});
<?php
include('database_connection.php');

// Check if MaterialID is set
if(isset($_REQUEST['MaterialID'])) {
    $mid = $_REQUEST['MaterialID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM workshop_material WHERE MaterialID=?");
    $stmt->bind_param("i", $mid);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="mid" value="<?php echo $mid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "MaterialID is not set.";
}

$connection->close();
?>

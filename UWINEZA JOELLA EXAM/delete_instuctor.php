<?php
include('database_connection.php');

// Check if InstructorID is set
if(isset($_REQUEST['InstructorID'])) {
    $iid = $_REQUEST['InstructorID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM instuctor WHERE InstructorID=?");
    $stmt->bind_param("i", $iid);
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
        <form method="post" on submit="return confirmDelete();">
            <input type="hidden" name="iid" value="<?php echo $iid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($stmt->execute()) {
        echo "Record deleted successfully.
        <a href='instructor.php'>Yes</a>";
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
    echo "InstructorID is not set.";
}

$connection->close();
?>

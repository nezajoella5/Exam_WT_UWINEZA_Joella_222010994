<?php
include('database_connection.php');

// Check if CertificateID is set
if(isset($_REQUEST['CertificateID'])) {
    $cid = $_REQUEST['CertificateID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM certificates WHERE CertificateID=?");
    $stmt->bind_param("i", $cid);
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
            <input type="hidden" name="cid" value="<?php echo $cid; ?>">
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
    echo "CertificateID is not set.";
}

$connection->close();
?>

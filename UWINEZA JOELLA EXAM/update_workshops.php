<?php
include('database_connection.php');

// Check if WorkshopID is set
if(isset($_REQUEST['WorkshopID'])) {
    $wid = $_REQUEST['WorkshopID'];
    
    $stmt = $connection->prepare("SELECT * FROM workshops WHERE WorkshopID=?");
    if ($stmt === false) {
        die('Prepare error: ' . htmlspecialchars($connection->error));
    }
    $stmt->bind_param("i", $wid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['WorkshopID'];
        $u = $row['InstructorID'];
        $y = $row['Title'];
        $z = $row['TransactionDate'];
    } else {
        echo "Workshop not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record in Workshops</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update workshops form -->
    <h2><u>Update Form of Workshops</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="iid">InstructorID:</label>
        <input type="number" name="iid" value="<?php echo isset($u) ? $u : ''; ?>" required>
        <br><br>

        <label for="ttl">Title:</label>
        <input type="text" name="ttl" value="<?php echo isset($y) ? $y : ''; ?>" required>
        <br><br>

        <label for="dt">Date:</label>
        <input type="date" name="dt" value="<?php echo isset($z) ? $z : ''; ?>" required>
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $InstructorID = $_POST['iid'];
    $Title = $_POST['ttl'];
    $Date = $_POST['dt'];

    // Update the workshops in the database
    $stmt = $connection->prepare("UPDATE workshops SET InstructorID=?, Title=?, TransactionDate=? WHERE WorkshopID=?");
    if ($stmt === false) {
        die('Prepare error: ' . htmlspecialchars($connection->error));
    }
    $stmt->bind_param("issi",$InstructorID,$Title,$Date,$wid);
    if ($stmt->execute() === false) {
        die('Execute error: ' . htmlspecialchars($stmt->error));
    }
    
    // Redirect to workshops.php
    header('Location: workshops.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

<?php
include('database_connection.php');

// Check if InstructorID is set
if(isset($_REQUEST['InstructorID'])) {
    $iid = $_REQUEST['InstructorID'];
    
    $stmt = $connection->prepare("SELECT * FROM instuctor WHERE InstructorID=?");
    $stmt->bind_param("i", $iid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['InstructorID'];
        $u = $row['id'];
        $y = $row['Bio'];
    } else {
        echo "instuctor not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in instuctor</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update instuctor form -->
    <h2><u>Update Form of instuctor</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="id">id:</label>
        <input type="text" name="id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Bio">Bio:</label>
        <input type="number" name="Bio" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $Bio = $_POST['Bio'];
    
    // Update the instuctor in the database
    $stmt = $connection->prepare("UPDATE instuctor SET id=?, Bio=? WHERE InstructorID=?");
    $stmt->bind_param("isi" $id, $Bio $iid);
    $stmt->execute();
    
    // Redirect to instuctor.php
    header('Location: instuctor.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

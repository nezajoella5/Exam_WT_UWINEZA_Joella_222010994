<?php
include('database_connection.php');

// Check if CertificateID is set
if(isset($_REQUEST['CertificateID'])) {
    $cid = $_REQUEST['CertificateID'];
    
    $stmt = $connection->prepare("SELECT * FROM certificates WHERE CertificateID=?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['CertificateID'];
        $u = $row['WorkshopID'];
        $y = $row['AttendeeID'];
        $z = $row['DateOfCompletion'];
        
    } else {
        echo "Certificates not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Certificates</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update certificates form -->
    <h2><u>Update Form of Certificates</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="wid">WorkshopID:</label>
        <input type="number" name="wid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="atid">AttendeeID:</label>
        <input type="number" name="atid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="dt">DateOfCompletion:</label>
        <input type="date" name="dt" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

    
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $WorkshopID = $_POST['wid'];
    $AttendeeID = $_POST['adr'];
    $DateOfCompletion = $_POST['dt'];
    
    
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customer SET WorkshopID=?, AttendeeID=?, DateOfCompletion=?, WHERE CertificateID=?");
    $stmt->bind_param("sssi" $WorkshopID, $AttendeeID, $DateOfCompletion, $cid);
    $stmt->execute();
    
    // Redirect to certificates.php
    header('Location: certificates.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

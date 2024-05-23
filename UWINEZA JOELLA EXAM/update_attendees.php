<?php
include('database_connection.php');

// Check if AttendeesID is set
if(isset($_REQUEST['AttendeesID'])) {
    $atid = $_REQUEST['AttendeesID'];
    
    $stmt = $connection->prepare("SELECT * FROM attendees WHERE AttendeesID=?");
    $stmt->bind_param("i", $atid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $u = $row['AttendeesID'];
        $y = $row['id'];
        $z = $row['Occupation'];
        $w = $row['RegistrationDate'];
    } else {
        echo "attendees not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in attendees</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update attendees form -->
    <h2><u>Update Form of attendees</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="id">id:</label>
        <input type="text" name="id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=occ>Occupation:</label>
        <input type="text" name="occ" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="rdt">RegistrationDate:</label>
        <input type="number" name="rdt" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id= $_POST['id'];
    $Occupation= $_POST['occ'];
    $RegistrationDate = $_POST['rdt'];
    
    // Update the attendees in the database
    $stmt = $connection->prepare("UPDATE attendees SET  id=?, Occupation=?, RegistrationDate=?, WHERE AttendeesID=?");
    $stmt->bind_param("ssdissi"$, $id, $Occupation,$RegistrationDate  $atid);
    $stmt->execute();
    
    // Redirect to attendees.php
    header('Location: attendees.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

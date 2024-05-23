<?php
include('database_connection.php');

// Check if PaymentID is set
if(isset($_REQUEST['PaymentID'])) {
    $pid = $_REQUEST['PaymentID'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE PaymentID=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['PaymentID'];
        $u = $row['id'];
        $u = $row['WorkshopID'];
        $y = $row['Amount'];
      
    } else {
        echo "Payments not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in payments</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update payments form -->
    <h2><u>Update Form of payments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="wid">WorkshopID:</label>
        <input type="number" name="wid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="amnt">Amount:</label>
        <input type="number" name="amnt" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id= $_POST['id'];
     $WorkshopID = $_POST['WorkshopID'];
    $Amount = $_POST['amnt'];
    
    
    // Update the payments in the database
    $stmt = $connection->prepare("UPDATE payments SET id=?, WorkshopID=? ,Amount=? WHERE PaymentID=?");
    $stmt->bind_param("iisi",$id,$WorkshopID ,$Amount, $pid);
    $stmt->execute();
    
    // Redirect to payments.php
    header('Location: payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

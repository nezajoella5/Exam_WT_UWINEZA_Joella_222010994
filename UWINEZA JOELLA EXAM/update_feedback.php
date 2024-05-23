<?php
include('database_connection.php');

// Check if FeedbackID is set
if(isset($_REQUEST['FeedbackID'])) {
    $fid = $_REQUEST['FeedbackID'];
    
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE FeedbackID=?");
    $stmt->bind_param("i", $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $u = $row['FeedbackID'];
        $y = $row['WorkshopID'];
        $z = $row['AttendeesID'];
        $w = $row['Comments'];
    } else {
        echo "Feedback not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in feedback</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update feedback form -->
    <h2><u>Update Form of feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="wid">WorkshopID:</label>
        <input type="text" name="wid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=aid>AttendeeID:</label>
        <input type="text" name="aid" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="com">Comments:</label>
        <input type="number" name="com" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $WorkshopID= $_POST['wid'];
    $AttendeeID= $_POST['aid'];
    $Comments = $_POST['com'];
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET  WorkshopID=?, AttendeeID=?, Comments=?, WHERE FeedbackID=?");
    $stmt->bind_param("ssdi" $, $WorkshoID, $AttendeeID,$Comments  $fid);
    $stmt->execute();
    
    // Redirect to feedback.php
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

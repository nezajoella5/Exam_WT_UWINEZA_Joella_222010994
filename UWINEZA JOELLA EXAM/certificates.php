<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our certificates</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
      
    }
    header{
    background-color:skyblue;
}
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:skyblue;
    }

  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="pink">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./images/Logo.png" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payments.php">PAYMENTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./instuctor.php">INSTUCTOR</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FFEDBACK</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./certificates.php">CERTIFICATES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">ATTENDEES</a>
  </li>
     <li style="display: inline; margin-right: 10px;"><a href="./attendance_tracking.php">ATTENDANCE_TRACKING</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">WORKSHOPS</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./workshop_material.php">WORKSHOP_MATERIAL</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./wealth_building_resources.php">WEALTH_BUILDING_RESOURCES</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

    <h1><u> CERTIFICATES Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
            
        <label for="cid">CertificateID:</label>
        <input type="number" id="cid" name="cid"><br><br>

        <label for="wid">WorkshopID:</label>
        <input type="number" id="wid" name="wid"><br><br>

        <label for="atid">AttendeeID:</label>
        <input type="number" id="atid" name="atid" required><br><br>

        <label for="dt">DateOfCompletion:</label>
        <input type="date" id="dt" name="dt" required><br><br>

        
            </select><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>


<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO certificates(CertificateID, WorkshopID, AttendeeID, DateOfCompletion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $cid, $wid, $atid, $dt );
    // Set parameters and execute
    $cid = $_POST['cid'];
    $wid = $_POST['wid'];
    $atid = $_POST['atid'];
    $dt = $_POST['dt'];
    
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
include('database_connection.php');

// SQL query to fetch data from the Certificates table
$sql = "SELECT * FROM certificates";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Certificates</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of Certificates</h2></center>
    <table border="5">
        <tr>
            <th>CertificateID</th>
            <th>WorkshopID</th>
            <th>AttendeeID</th>
            <th>DateOfCompletion</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
     include('database_connection.php');

        // Prepare SQL query to retrieve all Certificates
        $sql = "SELECT * FROM certificates";
        $result = $connection->query($sql);

        // Check if there are any certificates
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cid = $row['CertificateID']; // Fetch the CertificateID
                echo "<tr>
                    <td>" . $row['CertificateID'] . "</td>
                    <td>" . $row['WorkshopID'] . "</td>
                    <td>" . $row['AttendeeID'] . "</td>
                    <td>" . $row['DateOfCompletion'] . "</td>
                    <td><a style='padding:4px' href='delete_certificates.php?CertificateID=$cid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_certificates.php?CertificateID=$cid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <marquee behavior='alternate'>
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Joella Uwineza</h2></b>
  </marquee>
  </center>
</footer>
</body>
</html>
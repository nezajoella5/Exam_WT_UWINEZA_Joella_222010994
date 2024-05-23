<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Our payments</title>
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
    header {
      background-color: skyblue;
    }
    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }
    footer {
      text-align: center;
      padding: 15px;
      background-color: skyblue;
    }
  </style>

  <!-- JavaScript validation and content load for insert data-->
  <script>
    function confirmInsert() {
      return confirm('Are you sure you want to insert this record?');
    }
  </script>
</head>
<body bgcolor="chocolate">
  <header>
    <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul style="list-style-type: none; padding: 0;">
      <li style="display: inline; margin-right: 10px;">
        <img src="./images/Logo.png" width="90" height="60" alt="Logo">
      </li>
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./payments.php">PAYMENTS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./instuctor.php">INSTUCTOR</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./certificates.php">CERTIFICATES</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">ATTENDEES</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./attendance_tracking.php">ATTENDANCE-TRACKING</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">WORKSHOPS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./workshop_material.php">WORKSHOP_MATERIAL</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./wealth_building_resources.php">WEALTH_BUILDING_RESOURCES</a></li>
      <li class="dropdown" style="display: inline; margin-right: 10px;">
        <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
        <div class="dropdown-contents">
          <!-- Links inside the dropdown menu -->
          <a href="login.html">Login</a>
          <a href="register.html">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>
  <section>
    <h1><u> Payments Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="pid">PaymentID:</label>
      <input type="number" id="pid" name="pid"><br><br>

      <label for="id">id:</label>
      <input type="number" id="id" name="id"><br><br>

      <label for="wid">WorkshopID:</label>
      <input type="number" id="wid" name="wid" required><br><br>

      <label for="amnt">Amount:</label>
      <input type="number" id="amnt" name="amnt" required><br><br>

      <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('database_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind the parameters
        $stmt = $connection->prepare("INSERT INTO payments (PaymentID, id, WorkshopID, Amount) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $pid, $id, $wid, $amnt);

        // Set parameters and execute
        $pid = $_POST['pid'];
        $id = $_POST['id'];
        $wid = $_POST['wid'];
        $amnt = $_POST['amnt'];

        if ($stmt->execute()) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $connection->close();
    ?>

    <h2>Table of payments</h2>
    <table border="5">
      <tr>
        <th>PaymentID</th>
        <th>id</th>
        <th>WorkshopID</th>
        <th>Amount</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      include('database_connection.php');

      // Prepare SQL query to retrieve all payments
      $sql = "SELECT * FROM payments";
      $result = $connection->query($sql);

      // Check if there are any payments
      if ($result->num_rows > 0) {
          // Output data for each row
          while ($row = $result->fetch_assoc()) {
              $pid = $row['PaymentID']; // Fetch the PaymentID
              echo "<tr>
                  <td>" . $row['PaymentID'] . "</td>
                  <td>" . $row['id'] . "</td>
                  <td>" . $row['WorkshopID'] . "</td>
                  <td>" . $row['Amount'] . "</td>
                  <td><a style='padding:4px' href='delete_payments.php?PaymentID=$pid'>Delete</a></td>
                  <td><a style='padding:4px' href='update_payments.php?PaymentID=$pid'>Update</a></td>
              </tr>";
          }
      } else {
          echo "<tr><td colspan='6'>No data found</td></tr>";
      }
      $connection->close();
      ?>
    </table>
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

<!DOCTYPE html>
<html>
  <head>
    <title> Transaksi </title>
    <link rel="stylesheet" href="tambah_coklat.css">
  </head>

  <body>
    <div class="tes-1">
      <table>
        <tr>
          <th>Content</th>
        </tr>

        <?php

          require_once('connectDB.php');

          // $conn = mysqli_connect("localhost", "root", "aaaaaaab", "willy_wangky");
          // if ($conn->connect_error) {
          //   die("Connection failed: " . $conn->connect_error);
          // }
          $username = $_GET["username"];
          $sql = "SELECT * FROM transaksi WHERE username='$username';";
          try {
            $result = $conn->query($sql);
          } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), '\n';
          }

          if ($result->num_rows > 0) {
            echo "<table>";
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>".$row["choco_name"]."</td>";
              echo "<td>".$row["amount"]."</td>";
              echo "<td>".$row["totalprice"]."</td>";
              echo "<td>".$row["date"]."</td>";
              echo "<td>".$row["time"]."</td>";
              echo "<td>".$row["address"]."</td>";
              echo "</tr>";
            }
            echo "</table>";
          } else {
            echo "table is empty";
          }
          $conn->close();
        ?>
      </table>

    </div>
  </body>

</html>
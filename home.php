<?php
  $servername = "tutorial-db-instance.c6az2x9eftwh.us-east-1.rds.amazonaws.com";
  $username = "marifkind";
  $password = "pass_123";
  $database = "students";

  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

  function check_id($ID) {
    if (strlen((string)$ID) != 4) {
      echo "The ID needs to be four digits";
      return FALSE;
    }
    return TRUE;
  }

 ?>

<html>
  <head>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <h1>Student Information Lookup</h1>
    <form action="home.php" method="post">
      ID Number:
      <input type="text" name="ID" placeholder="Student ID">
      <input type="submit" value="Submit">
    </form>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
      <tr>
        <?php
        if (isset($_POST['ID'])) {
          $ID = $_POST['ID'];
          if (check_id($ID)) {
            $sql = "SELECT name, email FROM student_info WHERE id = '". $ID ."'";

            $result = $conn->query($sql);
            foreach ($result as $row) { ?>
              <td> <?php echo $ID ?> </td>
              <td> <?php echo $row['name']; ?> </td>
              <td> <?php echo $row['email']; ?> </td> <?php
            }
          } else {
            ?>
            <td></td>
            <td></td>
            <td></td>
            <?php
          }
        } else {
          ?>
          <td></td>
          <td></td>
          <td></td>
          <?php
        }
         ?>
      </tr>
    </table>
</body>
</html>

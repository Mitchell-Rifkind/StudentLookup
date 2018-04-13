<?php
  $servername = "tutorial-db-instance.c6az2x9eftwh.us-east-1.rds.amazonaws.com";
  $username = "marifkind";
  $password = "pass_123";
  $database = "students";

  $conn = mysql_connect($servername, $username, $password);
  if (!$conn) {
    die('Could not connect: ' . mysql_error());
  }

  $sql = 'CREATE DATABASE students';

  if (mysql_query($sql, $conn)) {
    echo "Database students created successfully\n";
  } else {
    echo 'Error creating database: ' . mysql_error() . "\n";
  }

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    $create_table = "CREATE TABLE student_info (id INT(4) PRIMARY KEY, name VARCHAR(30) NOT NULL, email VARCHAR(30) NOT NULL)";
    $conn->exec($create_table);

    $new_students = "INSERT INTO student_info (id, name, email) VALUES (1000, 'Mitchell Rifkind', 'mrifkind01@manhattan.edu'), (1001, 'Bill Gates', 'bgates01@manhattan.edu'), (1002, 'Bill Joy', 'bjoy01@manhattan.edu'), (1003, 'Steve Jobs', 'sjobs01@manhattan.edu'), (1004, 'Steve Wozniak', 'swozniak01@manhattan.edu'), (1005, 'Linus Torvald', 'ltorvald01@manhattan.edu')";
    $conn->exec($new_students);

    $sql = "SELECT name, email FROM student_info WHERE id = 1001";
    $result = $conn->query($sql);

    foreach ($result as $row) {
      echo $row['name'] . "\n";
      echo $row['email'] . "\n";
    }
  } catch(PDOException $e) {
    echo "Error message: " . $e->getMessage();
  }

  $conn = null;
?>

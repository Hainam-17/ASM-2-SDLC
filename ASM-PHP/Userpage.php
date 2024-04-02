<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Student Management</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e5e7eb; 
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100vw; 
            height: 100vh; 
            padding: 20px;
            box-sizing: border-box; 
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            background-color: #10b981; 
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #047857; 
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            background-color: wheat;
        }

        table {
            width: 100%; 
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
        }

        .delete-btn {
            background-color: #ef4444;
        }

        .edit-btn {
            background-color: #3b82f6;
        }

        .btn span {
            margin-left: 5px;
        }
    </style>
<body class="bg-gray-300">
  <div class="container mx-auto p-8 ">
    
    <h2 class="text-2xl font-bold mb-4">Student Management</h2>
    <div class="">
      <table class="table bg-white border border-gray-300">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b text-left">Student Name</th>
            <th class="py-2 px-4 border-b text-left">Student ID</th>
            <th class="py-2 px-4 border-b text-left">Class</th>
            <th class="py-2 px-4 border-b text-left">Email</th>
          </tr>
        </thead>
        <tbody>
        <?php

        $_servername = "localhost";
        $_username = "root";
        $_password = "";
        $_dbname = "fpt-students";
        $conn = new mysqli($_servername, $_username, $_password, $_dbname);

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM student ";
          $result = $conn->query($sql);

          if ($result) {
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["fullname"]. "</td>
                    <td>" . $row["email"]. "</td>
                    <td>" . $row["id"]."</td>
                    <td>" . $row["class"]."</td>
                    </tr>";
                }
            } else {
                echo "No data.";
            }
        } else {
            echo "Query error: " . $conn->error;
        }
          $conn->close();
        ?>
      </tbody>

  
</body>
</html>
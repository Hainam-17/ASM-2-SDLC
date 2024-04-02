<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Add</title>
</head>

<body>  
  <div class="flex items-center justify-center min-h-screen bg-gray-300">
  <div class="p-8 max-w-md w-full bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Add Information</h2>
    <form action="Addpage.php" method="POST">
      <div class="mb-4">
        <label for="fullname" class="block text-gray-700 text-sm font-bold mb-2">Full name</label>
        <input  name = "fullname" type="text" placeholder="Enter your full name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
      </div>
      <div class="mb-6">
        <label for="id" class="block text-gray-700 text-sm font-bold mb-2">ID</label>
        <input name="id" type="text" placeholder="Enter your ID" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
      </div>
      <div class="mb-6">
        <label for="class" class="block text-gray-700 text-sm font-bold mb-2">Class</label>
        <input name="class" type="text" placeholder="Enter your Class" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
      </div>
      <div class="mb-6">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
        <input name="email" type="text" placeholder="Enter your Email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
      </div>
      
      <button type="submit" name = "Add" class="w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-indigo-600">Add</button>
    </form>
  </div>
  </div>
  <?php
  
  $_servername = "localhost";
  $_username = "root";
  $_password = "";
  $_dbname = "fpt-students";
  $conn = new mysqli($_servername, $_username, $_password, $_dbname);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    if (isset($_POST['Add'])) {
      $email = $_POST['email'];
      $fullname = $_POST['fullname'];
      $id = $_POST['id'];
      $class = $_POST['class'];
           
      $query = "SELECT * FROM student WHERE email = '$email'";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {      
        echo '<script>alert("Email already exists!");</script>';
      } else {      
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        $stmt = $conn->prepare("INSERT INTO student (fullname, id, class, email) VALUES (?, ?, ?, ?)");       
        $stmt->bind_param("ssss", $fullname, $id, $class, $email);

        if ($stmt->execute()) {
          echo '<script>alert("Email already exists!");</script>';
          header("Location: homepage.php");
        } else {
          echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
      }
    
      exit(); 
    }


    exit();
  }
  ?>
</body>
</html>
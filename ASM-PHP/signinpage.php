<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Login Form</title>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-300">
  <div class="p-8 max-w-md w-full bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Login</h2>
    <form action="signinpage.php" method="POST">
      <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
        <input id="email" name = "email" type="email" placeholder="Enter your email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
        <input name="password" id="password" type="password" placeholder="Enter your password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
      </div>
      
      <button type="submit" name = "login" class="w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-indigo-600">Sign In</button>
    </form>
  </div>

  <?php
  
  $_servername = "localhost";
  $_username = "root";
  $_password = "";
  $_dbname = "fpt-students";
  $conn = new mysqli($_servername, $_username, $_password, $_dbname);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    if (isset($_POST['login'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];
       
      $query1 = "SELECT * FROM regis WHERE email = '$email'";
      $result = $conn->query($query1);

      $query2 = 'SELECT * FROM admins';
      $result2 = $conn->prepare($query2);
      if ($email === 'admin@admin.com') {
        $result2->execute();
            $result2->store_result();
            if ($result2->num_rows == 1) {
                header("Location: homepage.php");
                exit();
            } else {
                echo "error";
            }
      }
      else { 
            
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $stmt = $conn->prepare("SELECT * FROM regis WHERE email=?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $hashed_password = $row['password'];

          if (password_verify($password, $hashed_password)) {
              echo "Login successfully!";
              header("Location: Userpage.php");
              exit();
          } else {
              echo "Incorrect password!";
          }
      } else {
          echo "Email not found!";
      }


        $stmt->close();
        $conn->close();
      }
    }  
    


    exit();
  }
  ?>
</body>

</html>
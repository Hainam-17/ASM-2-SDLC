<?php
$_servername = "localhost";
$_username = "root";
$_password = "";
$_dbname = "fpt-students";
$conn = new mysqli($_servername, $_username, $_password, $_dbname);

$id_to_edit = $_GET['id'];
$sql = "SELECT * FROM student WHERE id = '$id_to_edit'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fullname = $row['fullname'];
        $id = $row['id'];
        $class = $row['class'];
        $email = $row['email'];
    }
} else {
    echo "No data found";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Edit'])) {
        $new_email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $id = $_POST['id'];
        $class = $_POST['class'];
        if ($new_email != $email) {
            $stmt = "UPDATE student SET fullname='$fullname', id='$id', class='$class', email='$new_email' WHERE id = '$id_to_edit'";
            $request = mysqli_query($conn, $stmt);
            if ($request) {
                echo '<script>alert("Edit succesfully!");</script>';
                header("Location: homepage.php");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_close($conn);
        } else {
            echo "Email remains the same.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Edit</title>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-300">
        <div class="p-8 max-w-md w-full bg-white rounded shadow">
            <h2 class="text-2xl font-bold mb-6">Edit Infromation</h2>
            <form action="Editpage.php?id=<?php echo $id_to_edit; ?>" method="POST">
                <div class="mb-4">
                    <label for="fullname" class="block text-gray-700 text-sm font-bold mb-2">Full name</label>
                    <input name="fullname" type="text" value="<?php echo ($fullname); ?>" placeholder="Enter your full name"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
                </div>
                <div class="mb-6">
                    <label for="id" class="block text-gray-700 text-sm font-bold mb-2">ID</label>
                    <input name="id" type="text" value="<?php echo ($id); ?>" placeholder="Enter your ID"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
                </div>
                <div class="mb-6">
                    <label for="class" class="block text-gray-700 text-sm font-bold mb-2">Class</label>
                    <input name="class" type="text" value="<?php echo ($class); ?>" placeholder="Enter your Class"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input name="email" type="text" value="<?php echo ($email); ?>" placeholder="Enter your Email"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
                </div>

                <button type="submit" name="Edit"
                    class="w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-indigo-600">Update</button>
            </form>

        </div>
    </div>

</body>

</html>
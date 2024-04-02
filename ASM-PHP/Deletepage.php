<?php
$_servername = "localhost";
$_username = "root";
$_password = "";
$_dbname = "fpt-students";
$conn = new mysqli($_servername, $_username, $_password, $_dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $item_id_to_delete = $_GET['id'];
        $sql = "DELETE FROM student WHERE id = '$item_id_to_delete'";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Delete succesfully!");</script>';
            header("Location: homepage.php");
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

$conn->close();
?>
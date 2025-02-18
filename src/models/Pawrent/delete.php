<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "CALL delete_pawrent('$id')";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: index.php");
exit();

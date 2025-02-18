<?php
include '../../connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$tgl = isset($_GET['tgl']) ? $_GET['tgl'] : '';

$sql = "CALL delete_kunjungan_lanjutan('$id', '$tgl')";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: index.php");
exit();

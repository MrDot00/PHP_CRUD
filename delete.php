<?php
include('includes/db.php');

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

$book_id = intval($_GET['id']);

$sql = "DELETE FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "❌ Error deleting book: " . $stmt->error;
}
?>

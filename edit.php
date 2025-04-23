<?php
include('includes/db.php');
include('includes/header.php');

// Get book ID from URL
if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

$book_id = intval($_GET['id']);

// Fetch current book info
$sql = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Book not found!";
    exit();
}

$book = $result->fetch_assoc();

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $genre = trim($_POST['genre']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    $update_sql = "UPDATE books SET title=?, author=?, genre=?, price=?, stock=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssdii", $title, $author, $genre, $price, $stock, $book_id);

    if ($update_stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "❌ Error: " . $update_stmt->error;
    }
}
?>

<h2>✏️ Edit Book</h2>
<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required><br><br>

    <label>Author:</label><br>
    <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required><br><br>

    <label>Genre:</label><br>
    <input type="text" name="genre" value="<?= htmlspecialchars($book['genre']) ?>" required><br><br>

    <label>Price (৳):</label><br>
    <input type="number" step="0.01" name="price" value="<?= $book['price'] ?>" required><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" value="<?= $book['stock'] ?>" required><br><br>

    <button type="submit">Update Book</button>
</form>

<?php include('includes/footer.php'); ?>

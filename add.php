<?php
include('includes/db.php');
include('includes/header.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $genre = trim($_POST['genre']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    $sql = "INSERT INTO books (title, author, genre, price, stock)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $title, $author, $genre, $price, $stock);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>

<h2>➕ Add New Book</h2>
<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Author:</label><br>
    <input type="text" name="author" required><br><br>

    <label>Genre:</label><br>
    <input type="text" name="genre" required><br><br>

    <label>Price (৳):</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" required><br><br>

    <button type="submit">Add Book</button>
</form>

<?php include('includes/footer.php'); ?>

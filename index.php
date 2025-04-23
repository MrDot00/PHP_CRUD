<?php
include('includes/db.php');
include('includes/header.php');

// Fetch all books
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<h2>📖 Book List</h2>
<a href="add.php" class="btn">➕ Add New Book</a>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['author']) ?></td>
            <td><?= htmlspecialchars($row['genre']) ?></td>
            <td><?= number_format($row['price'], 2) ?> ৳</td>
            <td><?= $row['stock'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this book?');">🗑 Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include('includes/footer.php'); ?>

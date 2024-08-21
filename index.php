<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "nike_date");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Handle search query
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM nike WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
} else {
    $query = "SELECT * FROM nike";
}

// Ambil data dari tabel nike
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Data Nike</h1>
    <form method="POST">
        <input type="text" name="search" value="<?= htmlspecialchars($search); ?>" placeholder="Cari...">
        <button type="submit">Cari</button>
    </form>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>URL</th>
            <th>Title</th>
            <th>Description</th>
        </tr>

        <?php 
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) :
        ?>
        <tr>
            <td><?= $row["id"]; ?></td>
            <td><?= htmlspecialchars($row["url"]); ?></td>
            <td><?= htmlspecialchars($row["title"]); ?></td>
            <td><?= htmlspecialchars($row["description"]); ?></td>
        </tr>
        <?php 
            endwhile;
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Tutup koneksi
mysqli_close($conn);
?>

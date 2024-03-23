<?php
require ('dbcon.php');
$id_mahasiswa = $_GET["id_mahasiswa"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];

    $sql = "UPDATE t_mahasiswa SET nama = :nama, nim = :nim WHERE id_mahasiswa = :id_mahasiswa";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':nim', $nim);
    $stmt->bindParam(':id_mahasiswa', $id_mahasiswa);
    $stmt->execute();

    // Process data (e.g., validation, database insertion)

    // Display confirmation or error message
    echo "Hello, $nama! update succes. <a href='listMahasiswa.php'>back</a>";
}
$sql = "SELECT * FROM t_mahasiswa WHERE id_mahasiswa = (:id_mahasiswa) ";
try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_mahasiswa', $id_mahasiswa);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error preparing/executing query: " . $e->getMessage();
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);


?>


<form action="edit.php?id_mahasiswa=<?php echo $id_mahasiswa ?>" method="post">

    <label for="nama">
        Nama:
    </label>
    <input type="text" id="nama" name="nama" value="<?php echo $row['nama'] ?>">

    <br></br>

    <label for="nim">
        NIM:
    </label>
    <input type="text" id="nim" name="nim" value="<?php echo $row['nim'] ?>">

    <br></br>
    <input type="submit" value="Submit">

</form>
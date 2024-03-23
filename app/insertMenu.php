<?php
?>

<form action="insertMenu.php" method="post">

    <label for="nama">
        Nama:
    </label>
    <input type="text" id="nama" name="nama">

    <br></br>

    <label for="nim">
        NIM:
    </label>
    <input type="text" id="nim" name="nim">

    <br></br>
    <input type="submit" value="Submit">

</form>

<?php
require ('dbcon.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];

    $sql = "INSERT INTO t_mahasiswa(nama,nim) VALUES (:nama, :nim)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':nim', $nim);
    $stmt->execute();

    // Process data (e.g., validation, database insertion)

    // Display confirmation or error message
    echo "Hello, $nama! Thanks for contacting us.";
}
?>
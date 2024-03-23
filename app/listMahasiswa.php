<?php

require ('dbcon.php');
$sql = "SELECT * FROM t_mahasiswa";
try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error preparing/executing query: " . $e->getMessage();
}

$str = "<table border = " . "1" . "><tr>
            <th> nama </th>
            <th> nim </h>
            <th> action </h>
        </tr>";


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $str .= "<tr>
    <td>" . $row["nama"] . "</td>
    <td>" . $row["nim"] . "</td>
    <td> <a href='edit.php?id_mahasiswa=" . $row["id_mahasiswa"] . "'>edit</a></td>
</tr>";
}

echo $str;
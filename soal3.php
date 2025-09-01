<?php
include "koneksi.php";

$search_nama   = $_GET['nama']   ?? '';
$search_alamat = $_GET['alamat'] ?? '';
$search_hobi   = $_GET['hobi']   ?? '';


$search_nama   = $koneksi->real_escape_string($search_nama);
$search_alamat = $koneksi->real_escape_string($search_alamat);
$search_hobi   = $koneksi->real_escape_string($search_hobi);

$sql = "SELECT person.nama, person.alamat, 
               GROUP_CONCAT(hobi.hobi SEPARATOR ', ') AS hobi
        FROM person 
        LEFT JOIN hobi ON person.id = hobi.person_id
        WHERE 1=1";

if (!empty($search_nama)) {
    $sql .= " AND person.nama LIKE '%$search_nama%'";
}
if (!empty($search_alamat)) {
    $sql .= " AND person.alamat LIKE '%$search_alamat%'";
}
if (!empty($search_hobi)) {
    $sql .= " AND hobi.hobi LIKE '%$search_hobi%'";
}

$sql .= " GROUP BY person.id ORDER BY person.nama ASC";
$result = $koneksi->query($sql);


echo "<style>
    body { font-family: Arial, sans-serif; }
    table { border-collapse: collapse; margin: 20px 0; width: 600px; }
    th, td { border: 1px solid black; padding: 8px 12px; text-align: left; }
    th { background: #f2f2f2; }
    .form-box { border: 1px solid black; width: 300px; padding: 15px; margin-top: 20px; }
    .form-box label { display: block; margin: 5px 0; font-weight: bold; }
    .form-box input[type=text] { width: 90%; padding: 5px; margin-bottom: 10px; }
    .form-box input[type=submit] { padding: 6px 20px; font-weight: bold; }
</style>";

echo "<table>
        <tr><th>Nama</th><th>Alamat</th><th>Hobi</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".htmlspecialchars($row['nama'])."</td>
                <td>".htmlspecialchars($row['alamat'])."</td>
                <td>".htmlspecialchars($row['hobi'])."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";
}

echo "</table>";


echo "<div class='form-box'>
        <form method='GET'>
            <label>Nama :</label>
            <input type='text' name='nama' value='".htmlspecialchars($search_nama, ENT_QUOTES)."'>
            
            <label>Alamat :</label>
            <input type='text' name='alamat' value='".htmlspecialchars($search_alamat, ENT_QUOTES)."'>
            
            <label>Hobi :</label>
            <input type='text' name='hobi' value='".htmlspecialchars($search_hobi, ENT_QUOTES)."'>
            
            <input type='submit' value='SEARCH'>
        </form>
      </div>";

$koneksi->close();
?>

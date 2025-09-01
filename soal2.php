<?php
include "koneksi.php";
session_start();

$step = $_POST['step'] ?? 1;

echo "<style>
    .box {
        border: 1px solid black;
        width: 300px;
        padding: 20px;
        margin: 20px auto;
        text-align: center;
        font-family: Arial, sans-serif;
    }
    .box input[type=text],
    .box input[type=number] {
        padding: 5px;
        margin-left: 10px;
    }
    .box input[type=submit] {
        display: block;
        margin: 20px auto 0 auto;
        padding: 8px 20px;
        font-weight: bold;
    }
</style>";

if ($step == 1) {
    echo '<div class="box">
            <form method="POST">
                <label><b>Nama Anda :</b></label>
                <input type="text" name="nama" required>
                <br><br>
                <input type="hidden" name="step" value="2">
                <input type="submit" value="SUBMIT">
            </form>
          </div>';
} elseif ($step == 2) {
    $_SESSION['nama'] = $_POST['nama'];
    echo '<div class="box">
            <form method="POST">
                <label><b>Umur Anda :</b></label>
                <input type="number" name="umur" required>
                <br><br>
                <input type="hidden" name="step" value="3">
                <input type="submit" value="SUBMIT">
            </form>
          </div>';
} elseif ($step == 3) {
    $_SESSION['umur'] = $_POST['umur'];
    echo '<div class="box">
            <form method="POST">
                <label><b>Hobi Anda :</b></label>
                <input type="text" name="hobi" required>
                <br><br>
                <input type="hidden" name="step" value="4">
                <input type="submit" value="SUBMIT">
            </form>
          </div>';
} elseif ($step == 4) {
    $_SESSION['hobi'] = $_POST['hobi'];
    echo '<div class="box" style="text-align:left;">
            Nama: <b>' . $_SESSION['nama'] . '</b><br>
            Umur: <b>' . $_SESSION['umur'] . '</b><br>
            Hobi: <b>' . $_SESSION['hobi'] . '</b>
          </div>';
}
?>

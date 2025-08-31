<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Kesehatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #a8edea, #fed6e3);
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #ffffff; /* warna form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: inline-block;
            text-align: left;
            margin: 20px auto;
            width: 300px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 8px;
            display: inline-block;
        }
    </style>
</head>
<body>

<h2>APLIKASI KESEHATAN</h2>

<?php
if (!isset($_POST['menu']) && !isset($_POST['hitungBMI']) && !isset($_POST['cekDonor'])) {
?>
    <form method="post">
        <label>Pilih Menu:</label>
        <select name="menu" required>
            <option value="">-- Pilih --</option>
            <option value="1">Hitung BMI</option>
            <option value="2">Cek Donor Darah</option>
        </select>
        <input type="submit" value="Lanjut">
    </form>
<?php
} elseif (isset($_POST['menu'])) {
    $menu = $_POST['menu'];

    switch ($menu) {
        case 1:
?>
            <form method="post">
                <h3>Hitung BMI</h3>
                <label>Berat Badan (kg):</label>
                <input type="number" name="berat" required>
                <label>Tinggi Badan (cm):</label>
                <input type="number" name="tinggi" required>
                <input type="submit" name="hitungBMI" value="Hitung">
            </form>
<?php
            break;
        case 2:
?>
            <form method="post">
                <h3>Cek Donor Darah</h3>
                <label>Umur:</label>
                <input type="number" name="umur" required>
                <label>Berat Badan (kg):</label>
                <input type="number" name="bb" required>
                <label>Sehat? (Ya/Tidak):</label>
                <select name="sehat" required>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
                <input type="submit" name="cekDonor" value="Cek">
            </form>
<?php
            break;
        default:
            echo "<div class='result'>Menu tidak valid.</div>";
            break;
    }
}

if (isset($_POST['hitungBMI'])) {
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'] / 100; // cm ke meter
    $bmi = $berat / ($tinggi * $tinggi);

    if ($bmi < 18.5) {
        $kategori = "Kurus";
    } elseif ($bmi < 25) {
        $kategori = "Normal";
    } elseif ($bmi < 30) {
        $kategori = "Kelebihan Berat Badan";
    } else {
        $kategori = "Obesitas";
    }

    echo "<div class='result'><b>Hasil BMI:</b> " . round($bmi,2) . " ($kategori)</div>";
}

if (isset($_POST['cekDonor'])) {
    $umur = $_POST['umur'];
    $bb = $_POST['bb'];
    $sehat = ($_POST['sehat'] == "ya");

    if ($umur >= 17 && $umur <= 60 && $bb >= 45 && $sehat) {
        echo "<div class='result'><b>Hasil:</b> Anda LAYAK donor darah.</div>";
    } else {
        echo "<div class='result'><b>Hasil:</b> Anda TIDAK LAYAK donor darah.</div>";
    }
}
?>

</body>
</html>

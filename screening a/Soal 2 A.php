<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "screening a";    //Mohon perhatikan nama database ketika import sql

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Soal 2 A</title>
</head>
<body>
    <div class="container p-5 mt-5">
        <div class="row">
            <div class="col">
                <h2>Muhammad Jundi Hakim</h2>
                <h3>Soal 2</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <tr>
                        <th class="text-center" colspan="3">Person</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                    
                    <?php
                    $sql = "SELECT id, nama, alamat FROM person";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["nama"] . "</td>";
                            echo "<td>" . $row["alamat"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="col">
            <table class="table">
                    <tr>
                        <th class="text-center" colspan="3">Hobi</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Person ID</th>
                        <th>Hobi</th>
                    </tr>
                    
                    <?php
                    $sql = "SELECT id, person_id, hobi FROM hobi";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["person_id"] . "</td>";
                            echo "<td>" . $row["hobi"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="col">
                <form method="GET" action="">
                    <label for="search">Cari Hobi:</label>
                    <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <input type="submit" value="Cari">
                </form>
                    <?php
                        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                        $sql = "SELECT hobi.hobi, COUNT(hobi.person_id) AS jumlah_person
                                FROM hobi
                                JOIN person ON hobi.person_id = person.id
                                WHERE hobi.hobi LIKE '%$search%'
                                GROUP BY hobi.hobi
                                ORDER BY jumlah_person DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table class='table'>
                                    <tr>
                                        <th class='text-center' colspan='2'>Hobi</th>
                                    </tr>
                                    <tr>
                                        <th>Hobi</th>
                                        <th>Jumlah Person</th>
                                    </tr>";
                
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["hobi"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["jumlah_person"]) . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p>Data tidak ditemukan untuk pencarian: " . htmlspecialchars($search) . "</p>";
                        }
                    ?>
            </div>
        </div>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
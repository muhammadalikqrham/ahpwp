<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = mysqli_connect('localhost', 'root', '', 'db_ahpwp') or die("koneksi ke database gagal");
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function tambahKriteria($data)
{
    global $conn;
    // var_dump($data);
    // exit;
    $nama = htmlspecialchars($data['nama_bibit']);
    $ph_tanah = htmlspecialchars($data['ph_tanah']);
    $usia = htmlspecialchars($data['usia']);
    $batang = htmlspecialchars($data['batang']);
    $tekstur_tanah = htmlspecialchars($data['tekstur_tanah']);
    $daun = htmlspecialchars($data['daun']);

    $query = "INSERT INTO tb_alternatif VALUES('','$nama',$ph_tanah,'$tekstur_tanah',$usia,'$batang','$daun')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapusAlternatif($id)
{
    global $conn;
    $query = 'DELETE FROM tb_alternatif WHERE id_alternatif = ' . $id;

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function ubahAlternatif($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama_bibit']);
    $ph_tanah = htmlspecialchars($data['ph_tanah']);
    $usia = htmlspecialchars($data['usia']);
    $batang = htmlspecialchars($data['batang']);
    $tekstur_tanah = htmlspecialchars($data['tekstur_tanah']);
    $daun = htmlspecialchars($data['daun']);

    $query = 'UPDATE tb_alternatif SET nama_alternatif = "' . $nama . '", ph_tanah = "' . $ph_tanah . '", Tekstur_tanah = "' . $tekstur_tanah . '", usia = "' . $usia . '",batang = "' . $batang . '", daun = "' . $daun . '" WHERE id_alternatif = ' . $id;

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function tambahUser($data)
{
    global $conn;
    $email = htmlspecialchars($data['email']);
    $nama = htmlspecialchars($data['nama']);
    $password = htmlspecialchars($data['password']);
    $password = md5($password);
    $query = "INSERT INTO tb_user VALUES('','$email','$nama','$password')";
    // var_dump($query);
    // exit;

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function cekLogin($data)
{
    global $conn;
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $password = md5($password);

    $query = "SELECT * FROM tb_user WHERE email = '$email' AND password ='$password'";

    $row = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($row);
    if (!empty($result)) {

        $_SESSION["name"] = $result['nama'];
        // var_dump($_SESSION['name']);
        // exit;
        return count($result);
    } else {
        return 0;
    }
}
function tambahPerbandingan($data)
{
    global $conn;
    $x = 0;
    for ($i = 1; $i <= 5; $i++) {
        for ($j = 1; $j <= 5; $j++) {
            $query = "INSERT INTO tb_perbandingan VALUES('','$i','$j','" . $data['score'][$x] . "')";
            $x++;
            mysqli_query($conn, $query);
        }
    }
    return mysqli_affected_rows($conn);
}
function ubahBobot($data)
{
    global $conn;
    $affectRows = 0;
    for ($i = 1; $i <= count($data); $i++) {
        $query = "UPDATE tb_bobotkriteria SET nilai_bobot = '" . $data[$i - 1] . "' WHERE id_bobot = '$i'";
        mysqli_query($conn, $query);

        $affectRows = $affectRows + mysqli_affected_rows($conn);
    }

    return $affectRows;
}
function ulang()
{
    global $conn;
    $query = "DELETE FROM tb_perbandingan";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

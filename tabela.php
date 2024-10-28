<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<form method="POST">
<table>
  <tr>
    <td>Imie:</td>
    <td><input type="text" name="imie"></td>
  </tr>
  <tr>
    <td>Nazwisko:</td>
    <td><input type="text" name="nazwisko"></td>
  </tr>
  <tr>
    <td>Wiek:</td>
    <td><input type="text" name="wiek"></td>
  </tr>
  <tr>
    <td>ID:</td>
    <td><input type="text" name="id"></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="add" value="Dodaj"></td>
  </tr>
</table>
</form>

<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';

$con = mysqli_connect("localhost", "root", "", "moja_baza");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} else {
    echo "Connection ok";
}

// Add data
if (isset($_POST['add'])) {
    if (!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['wiek'])) {
        $addsql = "INSERT INTO users (id, imie, nazwisko, wiek) VALUES (NULL, '" . $_POST['imie'] . "', '" . $_POST['nazwisko'] . "', " . $_POST['wiek'] . ")";

        if (mysqli_query($con, $addsql)) {
            echo "RECORD ADDED";
        } else {
            echo "ADD ERROR: " . mysqli_error($con);
        }
    }
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $wiek = $_POST['wiek'];

    $updsql = "UPDATE users SET imie = '$imie', nazwisko = '$nazwisko', wiek = '$wiek' WHERE id = $id";

    if (mysqli_query($con, $updsql)) {
        echo "RECORD UPDATED";
    } else {
        echo "UPDATE ERROR: " . mysqli_error($con);
    }
}

// Delete data
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $delsql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($con, $delsql)) {
        echo "RECORD DELETED";
    } else {
        echo "DELETE ERROR: " . mysqli_error($con);
    }
}

$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);

echo '<table border="1">';
while ($row = mysqli_fetch_assoc($result)) {
    //mysqli_fetch_row
    //mysqli_fetch_array
    //mysqli_fetch_assoc
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['imie'] . "</td>";
    echo "<td>" . $row['nazwisko'] . "</td>";
    echo "<td>" . $row['wiek'] . "</td>";
    echo "<td>";
    // Update form
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="text" name="imie" value="' . $row['imie'] . '">';
    echo '<input type="text" name="nazwisko" value="' . $row['nazwisko'] . '">';
    echo '<input type="number" name="wiek" value="' . $row['wiek'] . '">';
    echo '<input type="submit" name="update" value="Zaktualizuj">';
    echo '</form>';
    echo "</td>";
    echo "<td>";
    // Delete form
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="submit" name="delete" value="Usuń">';
    echo '</form>';
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>

</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../../../include/koneksi/koneksi.php';

function esc($val)
{
    return mysql_real_escape_string($val);
}

$table = $_REQUEST['table'];
$action = $_REQUEST['action'];

if ($action == "read") {
    $cols = [];
    $res = mysql_query("SHOW COLUMNS FROM `$table`");
    while ($row = mysql_fetch_assoc($res)) {
        $cols[] = $row['Field'];
    }

    echo "
    <link rel='stylesheet' href='all.min.css'>
    <style>
        * { font-family: 'Segoe UI', sans-serif; box-sizing: border-box; }
        body { background-color: #f8f9fa; margin: 0; padding: 20px; }
        table { border-collapse: collapse; width: 100%; background: white; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 14px; }
        th { background-color: #f1f1f1; text-transform: capitalize; }
        input[type='text'], input[type='number'] {
            width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 4px;
        }
        input:focus { outline: none; border-color: #DBDFE9; }
        button {
            border: none; padding: 6px 10px; margin: 2px;
            border-radius: 4px; font-size: 14px; cursor: pointer;
        }
        .btn-save { background: #DBDFE9; color: #3c3c3c; }
        .btn-delete { background: #DBDFE9; color: #3c3c3c; }
        .btn-add { background: #DBDFE9; color: #3c3c3c; }
        .btn-save i, .btn-delete i, .btn-add i { margin-right: 4px; }
        .table-container { overflow-x: auto; }
    </style>
    ";

    echo "<div class='table-container'><table>";
    echo "<thead><tr>";
    foreach ($cols as $i => $col) {
        if ($i === 0) continue;
        echo "<th>$col</th>";
    }
    echo "<th>Aksi</th></tr></thead><tbody>";

    $data = mysql_query("SELECT * FROM `$table`");
    while ($row = mysql_fetch_assoc($data)) {
        echo "<tr data-id='{$row[$cols[0]]}'>";
        foreach ($cols as $i => $col) {
            if ($i === 0) {
                echo "<input type='hidden' name='$col' value='" . htmlspecialchars($row[$col]) . "'>";
                continue;
            }
            echo "<td><input class='form-control form-control-solid form-control-xs' style='height: 30px;border-radius: 5px;' name='$col' value='" . htmlspecialchars($row[$col]) . "'></td>";
        }
        echo "<td>
            <button class='btn-save saveRow'><i class='fas fa-save'></i></button>
            <button class='btn-delete deleteRow' data-id='{$row[$cols[0]]}'><i class='fas fa-trash'></i></button>
        </td></tr>";
    }

    $autoID = date('YmdHis');
    echo "<tr>";
    foreach ($cols as $i => $col) {
        if ($i === 0) {
            echo "<input type='hidden' class='input-new' name='$col' value='$autoID'>";
            continue;
        }
        echo "<td><input class='input-new form-control form-control-solid form-control-xs' style='height: 30px;border-radius: 5px;' class='input-new' name='$col'></td>";
    }
    echo "<td><button class='btn-add' id='addRow'><i class='fas fa-plus'></i>Tambah</button></td>";
    echo "</tr>";

    echo "</tbody></table></div>";
} elseif ($action == "create") {
    $res = mysql_query("SHOW COLUMNS FROM `$table`");
    $fields = [];
    $values = [];
    $i = 0;
    while ($row = mysql_fetch_assoc($res)) {
        $f = $row['Field'];
        $fields[] = "`$f`";
        $values[] = ($i === 0)
            ? "'" . date('YmdHis') . "'"
            : "'" . esc($_POST[$f]) . "'";
        $i++;
    }
    $sql = "INSERT INTO `$table` (" . implode(",", $fields) . ") VALUES (" . implode(",", $values) . ")";
    mysql_query($sql);
} elseif ($action == "update") {
    $res = mysql_query("SHOW COLUMNS FROM `$table`");
    $cols = [];
    while ($row = mysql_fetch_assoc($res)) {
        $cols[] = $row['Field'];
    }
    $primaryKey = $cols[0];
    $sets = [];
    foreach ($cols as $col) {
        if ($col == $primaryKey) continue;
        $sets[] = "`$col`='" . esc($_POST[$col]) . "'";
    }
    $sql = "UPDATE `$table` SET " . implode(",", $sets) . " WHERE `$primaryKey`='" . esc($_POST[$primaryKey]) . "'";
    mysql_query($sql);
} elseif ($action == "delete") {
    $res = mysql_query("SHOW COLUMNS FROM `$table`");
    $pk = mysql_fetch_array($res)['Field'];
    $id = esc($_POST['id']);
    $sql = "DELETE FROM `$table` WHERE `$pk`='$id'";
    mysql_query($sql);
}

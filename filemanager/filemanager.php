<?php
$folder = "uploads/";
function uploadFile($folder) {
    if (isset($_POST['upload'])) {
        $fileName = $_FILES['myfile']['name'];
        $tempPath = $_FILES['myfile']['tmp_name'];

        move_uploaded_file($tempPath, $folder . $fileName);
        echo "<p style='color:green'>File uploaded successfully!</p>";
    }
}
function deleteFile($folder) {
    if (isset($_GET['delete'])) {
        $fileName = $_GET['delete'];
        unlink($folder . $fileName);
        echo "<p style='color:red'>File deleted successfully!</p>";
    }
}

function listFiles($folder) {
    $files = scandir($folder);

    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>File Name</th>
            <th>Size (KB)</th>
            <th>Last Modified</th>
            <th>Download</th>
            <th>Delete</th>
          </tr>";

    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $size = round(filesize($folder . $file) / 1024, 2);
            $time = date("d-m-Y H:i", filemtime($folder . $file));

            echo "<tr>
                    <td>$file</td>
                    <td>$size KB</td>
                    <td>$time</td>
                    <td><a href='$folder$file' download>Download</a></td>
                    <td><a href='filemanager.php?delete=$file'>Delete</a></td>
                  </tr>";
        }
    }
    echo "</table>";
}
uploadFile($folder);
deleteFile($folder);
listFiles($folder);
?>

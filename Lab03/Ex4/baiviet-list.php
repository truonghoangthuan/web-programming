<?php
//make connection and select DB
require_once("db-connector.php");
?>

<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="music-style.css" />
</head>

<body>
    <h1>Danh sách các bài viết</h1>
    <hr>
    <table>
        <?php
        //query data
        $query = "SELECT * FROM baiviet as bv, theloai as tl, tacgia as tg " .
            "WHERE bv.ma_tloai=tl.ma_tloai AND bv.ma_tgia=tg.ma_tgia";
        $q_result = mysqli_query($conn, $query)
            or die("Query failed: " . mysqli_error($conn));

        while ($row = mysqli_fetch_array($q_result)) {
            echo "<pre class='baiviet'>\n";
            echo "Mã bài viết  " . $row['ma_bviet'] . "<br>";
            echo "    Tiêu đề  " . $row['tieude'] . "<br>";
            echo "    Tác giả  " . $row['ten_tgia'] . "<br>";
            echo "  Ngày viết  " . $row['ngayviet'] . "<br>";
            echo "    Bài hát  " . $row['ten_bhat'] . "<br>";
            echo "   Thể loại  " . $row['ten_tloai'] . "<br>";
            echo "    Tóm tắt  " . mb_substr($row['tomtat'], 0, 50, "UTF8") . "...<br>";
            echo "<hr>";
            echo "</pre>\n\n";
        }
        ?>
    </table>
</body>

</html>
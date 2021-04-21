<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="music-style.css" />
</head>

<body>
    <h1>Tìm kiếm bài viết</h1>
    <hr>
    <form name="s_form" action="" method="get">
        <input type="text" name="search_kw" id="search_kw" size="40" value='<?php empty($_GET['search_kw']) || print $_GET['search_kw'];?>'>
        <input type="submit" name="Tìm kiếm" value="Tìm kiếm">
    </form>
    <br>
    <?php   //search
    if (isset($_GET['search_kw'])) {    //if search keywords are submitted
        require_once("/web-programming/Lab03/Ex04/db-connector.php");   //connected to DB after this step
        //process the search ketwords 
        $keyword = trim($_GET['search_kw']);
        $new_kw = str_replace(" ", "%' OR lower(tieude) LIKE '%", $keyword);
        $query = "SELECT * FROM baiviet as bv, theloai as tl, tacgia as tg" .
            " WHERE bv.ma_tloai=tl.ma_tloai AND bv.ma_tgia=tg.ma_tgia AND" .
            " (tieude LIKE '%$new_kw%')";

        //query
        $q_result = mysqli_query($conn ,$query)
            or die("Query failed: " . mysqli_error($conn));

        $row_count = mysqli_num_rows($q_result);
        echo "<h2>Kết quả tìm kiếm: " . $row_count . " bài viết</h2>";

        //display the search result
        while ($row = mysqli_fetch_array($q_result)) {
            echo "<pre class='baiviet'>\n";
            echo "Mã bài viết  " . $row['ma_bviet'] . "<br>";
            echo "    Tiêu đề  " . $row['tieude'] . "<br>";
            echo "    Tác giả  " . $row['ten_tgia'] . "<br>";
            echo "  Ngày viết  " . $row['ngayviet'] . "<br>";
            echo "    Bài hát  " . $row['ten_bhat'] . "<br>";
            echo "   Thể loại  " . $row['ten_tloai'] . "<br>";
            echo "    Tóm tắt  " . mb_substr($row['tomtat'], 0, 50, "UTF-8") . "...<br>";
            echo "<hr>";
            echo "</pre>\n\n";
        }
    }
    ?>
</body>

</html>
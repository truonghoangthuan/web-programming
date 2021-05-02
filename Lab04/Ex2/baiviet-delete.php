<html>

<head>
    <meta charset="utf-8" />

    <script type="text/javascript">
        function ask_confirm() {
            var ans = confirm("Bạn chắc chắn muốn xóa bài viết?");
            return ans;
        }
    </script>
</head>

<body>

    <?php       /* xoa bai viet */
    $msg = "";
    if (isset($_POST['ma_bviet_del'])) {
        //make connection and select DB
        include("/php/web-programming/Lab03/Ex4/db-connector.php");

        $ma_bviet = $_POST['ma_bviet_del'];
        $d_query = "DELETE FROM baiviet WHERE ma_bviet=" . $ma_bviet;
        $s_query = "SELECT tieude FROM baiviet WHERE ma_bviet=" . $ma_bviet;
        $sq_result = mysqli_query($conn, $s_query)
            or die("Retrieving data failed: " . mysqli_error($conn));

        //hien thi thong bao da them bai viet moi
        $msg = "Đã xóa bài viết '" . mysqli_fetch_array($sq_result)["tieude"] . "'";

        mysqli_query($conn, $d_query)
            or die("Không thể xóa bài viết: " . mysqli_error($conn));
    }
    ?>

    <h1>Xóa bài viết</h1>
    <hr>
    <form name="s_form" action="" method="post">
        <input type="text" name="search_kw" id="search_kw" size="40" value='<?php empty($_POST['search_kw']) || print $_POST['search_kw']; ?>'>

        <input type="submit" name="locbaiviet" value="Lọc bài viết">
    </form>

    <div class="message" id="del_msg"></div>
    <br>
    <?php   //search


    if (isset($_POST['search_kw']))
        $keyword = trim($_POST['search_kw']);
    else
        $keyword = '';



    include("/php/web-programming/Lab03/Ex4/db-connector.php");   //connected to DB after this step


    //process the search ketwords 

    $new_kw = str_replace(" ", "%' OR lower(tieude) LIKE '%", $keyword);
    $query = "SELECT * FROM baiviet as bv, theloai as tl, tacgia as tg" .
        " WHERE bv.ma_tloai=tl.ma_tloai AND bv.ma_tgia=tg.ma_tgia AND" .
        " (tieude LIKE '%$new_kw%')";

    //query
    $q_result = mysqli_query($conn, $query)
        or die("Query failed: " . mysqli_error($conn));

    $row_count = mysqli_num_rows($q_result);
    echo "<h2>Số bài viết: " . $row_count . "</h2>";

    //display the search result
    while ($row = mysqli_fetch_array($q_result)) {
        $tomtat = mb_substr($row['tomtat'], 0, 50, "UTF-8");

        echo <<<_DELETE_FORM
<form action='baiviet-delete.php' method='post'>
<pre>
Mã bài viết  $row[ma_bviet]
    Tiêu đề  $row[tieude]
    Tác giả  $row[ten_tgia]
  Ngày viết  $row[ngayviet]
    Bài hát  $row[ten_bhat]
   Thể loại  $row[ten_tloai]
    Tóm tắt  $tomtat...;
             <input type='submit' value='Xóa bài viết' onclick="return ask_confirm();">
             <input type='hidden' name='ma_bviet_del' value='$row[ma_bviet]'>
</pre>            
</form>
<hr>
_DELETE_FORM;
    }  //while

    echo <<<_MESSAGE
                <script type="text/javascript">
                    document.getElementById("del_msg").innerHTML = "$msg";
                </script>
_MESSAGE;

    ?>
</body>

</html>
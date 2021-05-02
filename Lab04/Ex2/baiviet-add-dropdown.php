<html>

<head>
    <meta charset="utf-8" />

    <!-- for data picker -->
    <link rel="stylesheet" href="resources/jquery.datepick/smoothness.datepick.css">
    <script src="resources/jquery.datepick/jquery-1.10.2.js"></script>
    <script src="resources/jquery.datepick/jquery.plugin.js"></script>
    <script src="resources/jquery.datepick/jquery.datepick.js"></script>

    <script>
        $(function() {
            $("#ngayviet").datepick({
                dateFormat: 'yyyy/mm/dd'
            });
        });
    </script>

    <!-- END for date packer -->

</head>

<body>
    <?php
    /* process add entry if any */
    if (isset($_POST['add_bviet'])) {
        //make connection and select DB
        require_once("/php/web-programming/Lab03/Ex4/db-connector.php");


        $ma_bviet = $_POST['ma_bviet'];
        $tieude = $_POST['tieude'];
        $ten_bhat = $_POST['ten_bhat'];
        $ma_tloai = $_POST['ma_tloai'];
        $tomtat = $_POST['tomtat'];
        $ma_tgia = $_POST['ma_tgia'];
        $ngayviet = $_POST['ngayviet'];

        $query = "INSERT INTO baiviet (ma_bviet, tieude, ten_bhat," .
            " ma_tloai, tomtat, ma_tgia, ngayviet)" .
            " VALUES ($ma_bviet, '$tieude', '$ten_bhat'," .
            " $ma_tloai, '$tomtat', $ma_tgia, '$ngayviet')";

        $q_result = mysqli_query($conn, $query)
            or die("Couldn't add new entry: " . mysqli_error($conn));


        //hien thi thong bao da them bai viet moi
        $msg = "Bài viết '" . $_POST['tieude'] . "' đã được thêm vào CSDL";
        echo <<<_MESSAGE
                <script type="text/javascript">
                    document.getElementById("add_msg").innerHTML = "$msg";
                </script>
_MESSAGE;
    }   //them bai viet

    ?>

    <h1>Thêm bài viết</h1>
    <hr>

    <!-- form nhập thông tin bài viết -->
    <?php
    include_once "baiviet-add-func.php";
    ?>

    <form name="f_add" action="baiviet-add-dropdown.php" method="post">
        <pre>
Mã bài viết <input type="text" size="5" name="ma_bviet" value="<? echo get_ma_bviet(); ?>">
    Tiêu đề <input type="text" size="70" name="tieude">
    Tác giả <select name="ma_tgia"><? dropdown_options('tacgia', 'ma_tgia', 'ten_tgia'); ?></select>
  Ngày viết <input type="text" size="11" name="ngayviet" id="ngayviet">
    Bài hát <input type="text" size="40" name="ten_bhat">
   Thể loại <select name="ma_tloai"><? dropdown_options('theloai', 'ma_tloai', 'ten_tloai'); ?>
</select>   
    Tóm tắt <textarea rows="4"  cols="50" name="tomtat"></textarea>
            <input type="submit" name="add_bviet" value="Thêm bài viết" onclick="return val();">
        </pre>
    </form>

    <div class="message" id="add_msg"></div>
    <hr>

    <!-- liet ke bai viet -->
    <?php

    //make connection and select DB
    require_once("/php/web-programming/Lab03/Ex4/db-connector.php");


    //show all entries
    $query = "SELECT * FROM baiviet as bv, theloai as tl, tacgia as tg " .
        "WHERE bv.ma_tloai=tl.ma_tloai AND bv.ma_tgia=tg.ma_tgia";

    $q_result = mysqli_query($conn, $query)
        or die("Query failed: " . mysqli_error($conn));

    echo "<h3>Tổng số bài viết: " . mysqli_fetch_array($q_result) . "</h3>";

    //generate list of entries
    $count = 1;
    while ($row = mysqli_fetch_array($q_result)) {
        echo "<p>", $count++, ". <b>";
        echo $row['tieude'], " (";

        if ($row['ten_bhat'] != $row['tieude'])
            echo $row['ten_bhat'], " -- ";

        echo $row['ten_tloai'], ")</b>. ";
        echo $row['ten_tgia'], ", ";
        echo $row['ngayviet'];
        echo "</p>";
    }
    ?>

    <!-- set default value for some controls -->
    <script type="text/javascript">
        var d = new Date();
        f_add.ngayviet.value = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
    </script>

    <script type="text/javascript">
        function val() {
            //validation code: haven't finished yet
            return true;
        }
    </script>
</body>

</html>
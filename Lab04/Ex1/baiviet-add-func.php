<?php
    function get_ma_bviet() {
        require_once "/php/web-programming/Lab03/Ex4/db-connector.php";

        $sql = "SELECT MAX(ma_bviet) FROM baiviet";
        $q_result = mysqli_query($conn, $sql)
            or die("Query failed: " . mysqli_error($conn));
        
        echo "maxm: " . mysqli_fetch_array($q_result);

        return mysqli_fetch_array($q_result);
    }

    function dropdown_options($tb_name, $value_col, $text_col, $none=false, $default='') {        
        require_once "/php/web-programming/Lab03/Ex4/db-connector.php";
        
        if ($none)
            echo "<option value=''></option>\n";
        
        $query = "SELECT " . $value_col . ", " . $text_col .
            " FROM " .  $tb_name;
        
        $q_result = mysqli_query($conn, $query) 
            or die("Query failed: " . mysqli_error($conn));
        
        //generate list of options
        while ($row = mysqli_fetch_array($q_result)) {
            echo "<option value='", $row[0], "' ";
            
            if ($row[0] == $default)
                echo "selected";
            
            echo ">", $row[1], "</option>\n";
        }      
    }

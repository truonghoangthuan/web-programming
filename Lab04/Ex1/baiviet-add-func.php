<?php

    function get_ma_bviet() {
        require_once "/php/web-programming/Lab03/Ex4/db-connector.php";

        $q_result = mysqli_query($conn, "SELECT MAX(ma_bviet) as maxm FROM baiviet")
            or die("Query failed: " . mysqli_error($conn));
        
        //echo "maxm: " . mysql_result($q_result, 0, "maxm") . "; ";

        return mysqli_fetch_array($q_result, 0, "maxm") + 1;
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
        while ($row = mysqli_fetch_array($GLOBALS["conn"], $q_result)) {
            echo "<option value='", $row[0], "' ";
            
            if ($row[0] == $default)
                echo "selected";
            
            echo ">", $row[1], "</option>\n";
        }      
    }

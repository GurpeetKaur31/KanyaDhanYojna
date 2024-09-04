<?php

    $con= mysqli_connect("localhost","root","","kanyadhan");

    if($_POST['type'] == ""){
        $sql = "SELECT * FROM districts ";
        $result = mysqli_query($con, $sql) or die("Query unsuccessful.");

        $str="";
        while ($row = mysqli_fetch_assoc($result)) {
            $str .= "<option value='{$row['dist_id']}'>{$row['dist_name']}</option>";
        }
    }else if($_POST['type'] == "blockData"){
        $sql = "SELECT * FROM blocks WHERE dist_id = {$_POST['id']}";
        $result = mysqli_query($con, $sql) or die("Query unsuccessful.");

        $str="";
        while ($row = mysqli_fetch_assoc($result)) {
            $str .= "<option value='{$row['block_id']}'>{$row['block_name']}</option>";
    }
    }else if($_POST['type'] == "gramData"){
        $sql = "SELECT * FROM grams WHERE block_id = {$_POST['id']}";
        $result = mysqli_query($con, $sql) or die("Query unsuccessful.");

        $str="";
        while ($row = mysqli_fetch_assoc($result)) {
            $str .= "<option value='{$row['gram_id']}'>{$row['gram_name']}</option>";
    }
    }else if($_POST['type'] == "villageData"){
        $sql = "SELECT * FROM villages WHERE gram_id = {$_POST['id']}";
        $result = mysqli_query($con, $sql) or die("Query unsuccessful.");

        $str="";
        while ($row = mysqli_fetch_assoc($result)) {
            $str .= "<option value='{$row['village_id']}'>{$row['village_name']}</option>";
    }
    }
    echo $str;
?>
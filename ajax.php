<?php
session_start(); // ten plik nie może resetować captchy, bo co request wypadnie nowa

include("tajne.php");  //require
$dbh = new PDO($host, $user, $passwd);
 
if(isset($_POST['acc']) && $_POST['acc']=='add' && isset($_POST['captcha']) && $_POST['captcha']==$_SESSION['captcha']){
        $sth = $dbh -> prepare("INSERT INTO `ajax-coins` VALUES('',:c,:d,:cn,:a,:da)");
        $sth -> bindParam(':c', $_POST['country'], PDO::PARAM_STR);
        $sth -> bindParam(':d', $_POST['denom'], PDO::PARAM_STR);
        $sth -> bindParam(':cn', $_POST['cat_number'], PDO::PARAM_STR);
        $sth -> bindParam(':a', $_POST['alloy'], PDO::PARAM_STR);
        $sth -> bindParam(':da', $_POST['date'], PDO::PARAM_STR);
        $sth -> execute();
}elseif(isset($_POST['acc']) && $_POST['acc']=='get'){
        $sth = $dbh -> prepare("SELECT * FROM `ajax-coins`");
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
}elseif(isset($_POST['acc']) && $_POST['acc']=='del' && isset($_POST['captcha']) && $_POST['captcha']==$_SESSION['captcha']) {
        $sth = $dbh -> prepare("DELETE FROM `ajax-coins` WHERE id = :id");
        $sth -> bindParam(':id', $_POST['id'], PDO::PARAM_STR);
        $sth -> execute();
}elseif(isset($_POST['acc']) && $_POST['acc']=='mod' && isset($_POST['captcha']) && $_POST['captcha']==$_SESSION['captcha']) {
        $sth = $dbh -> prepare("UPDATE `ajax-coins` SET country = :c, denom = :d, cat_number = :cn, alloy = :a, `date` = :da  WHERE id = :id");
        $sth -> bindParam(':id', $_POST['id'], PDO::PARAM_STR);
        $sth -> bindParam(':c', $_POST['country'], PDO::PARAM_STR);
        $sth -> bindParam(':d', $_POST['denom'], PDO::PARAM_STR);
        $sth -> bindParam(':cn', $_POST['cat_number'], PDO::PARAM_STR);
        $sth -> bindParam(':a', $_POST['alloy'], PDO::PARAM_STR);
        $sth -> bindParam(':da', $_POST['date'], PDO::PARAM_STR);
        $sth -> execute();
}
?>
<?php
include 'config.php';
session_start ();
$st=$_SESSION["id_student"];
$exam=$_SESSION["id_exam"];

$h = $_COOKIE["hours"];
$m = $_COOKIE["minutes"];
$s = $_COOKIE["seconds"];

$seconds=($h*3600)+($m*60)+$s;

$time=$h.":".$m.":".$s;



$_SESSION["end_exam"]=date("Y-m-d H:i:s", (strtotime(date($_SESSION["end_exam"])) - $seconds));

if (isset($_POST['ek'])){

    $textarea=htmlspecialchars($_POST['text']);
    $sql = "INSERT INTO answer (id_exam,id_student,id_question,student_answer,time_answer)
			VALUES ('$exam','$st', ".$_POST["ek"].",'$textarea','$time')";

    mysqli_query($conn,$sql);


    header("Location:examination2.php");

}



if (isset($_POST['tf'])){
    $answer=$_POST['answer'];
    if($answer=='F'){
        $sql = "INSERT INTO answer (id_exam,id_student,id_question,student_answer,time_answer)
			VALUES ('$exam','$st', ".$_POST["tf"].",'False','$time')";
    }
    if($answer=='T'){
        $sql = "INSERT INTO answer (id_exam,id_student,id_question,student_answer,time_answer)
			VALUES ('$exam','$st', ".$_POST["tf"].",'True','$time')";
    }

    mysqli_query($conn,$sql);

    header("Location: examination2.php");

}

if (isset($_POST['mc'])){
    if (isset($_POST['paf'])) {
        $paf = $_POST['paf'];

        $sql = "INSERT INTO answer (id_exam,id_student,id_question,student_answer,time_answer)
			VALUES ('$exam','$st', " . $_POST["mc"] . "," . $_POST['paf'] . ",'$time')";


        mysqli_query($conn, $sql);
    }

    header("Location: examination2.php");
}



if (isset($_POST['mcm'])){
    if (isset($_POST['pa'])) {
        $pa = $_POST['pa'];

        if (!empty($_POST['pa'])) {

            foreach ($_POST['pa'] as $value) {
                // echo "$value";
                mysqli_query($conn, "INSERT INTO answer (id_exam,id_student,id_question,student_answer,time_answer)
			VALUES ('$exam','$st', " . $_POST["mcm"] . ",'" . $value . "','$time')");
            }
        }
    }

    header("Location: examination2.php");

}



?>
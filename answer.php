<?php
include 'config.php';
session_start ();
$st=$_SESSION["id_student"];
		$h = $_COOKIE["hours"];
		$m = $_COOKIE["minutes"];
		$s = $_COOKIE["seconds"];
		
		if($h<10){
			$h="0".$h;
		}
		if($m<10){
			$m="0".$m;
		}
		if($s<10){
			$s="0".$s;
		}
		$time=$h.":".$m.":".$s;
	

       
//mysqli_close($conn);
	if (isset($_POST['ek'])){

			$textarea=htmlspecialchars($_POST['text']);
			$sql = "INSERT INTO answer (id_student,id_question,student_answer,time_answer)
			VALUES ('$st', ".$_POST["ek"].",'$textarea','$time')";

		mysqli_query($conn,$sql);

		
		$location="/Ptuxiaki/examination2.php";
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);	

	}
	
	 
	
	if (isset($_POST['tf'])){
		$answer=$_POST['answer'];
		if($answer=='F'){
			$sql = "INSERT INTO answer (id_student,id_question,student_answer,time_answer)
			VALUES ('$st', ".$_POST["tf"].",'False','$time')";
		}
		if($answer=='T'){
			$sql = "INSERT INTO answer (id_student,id_question,student_answer,time_answer)
			VALUES ('$st', ".$_POST["tf"].",'True','$time')";
		}
		
		mysqli_query($conn,$sql);
		$location="/Ptuxiaki/examination2.php";
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);	
	
	}

	if (isset($_POST['mc'])){
		$paf=$_POST['paf'];
		$sql = "INSERT INTO answer (id_student,id_question,student_answer,time_answer)
			VALUES ('$st', ".$_POST["mc"].",'$paf','$time')";


		mysqli_query($conn,$sql);
		$location="/Ptuxiaki/examination2.php";
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);	
	}

 

	if (isset($_POST['mcm'])){
		$pa=$_POST['pa'];

		if(!empty($_POST['pa'])) {

			foreach($_POST['pa'] as $value){
					mysqli_query($conn, "INSERT INTO answer (id_student,id_question,student_answer,time_answer)
			VALUES ('$st', ".$_POST["mcm"].",'".$value. "','$time')");
			}
		}
		

			
			$location="/Ptuxiaki/examination2.php";
			header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);	

	}
	
	 
	
?>
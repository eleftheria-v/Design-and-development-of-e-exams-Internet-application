
<?php
session_start();	
include 'config.php';
?>
	


<!DOCTYPE HTML>

<html>
	<head>
        <?php
        if (isset($_SESSION["id_professor"])==NULL) {

            header("Location:index.php");

        }else if(isset($_SESSION["id_student"])!=NULL){

            header("Location: profilef.php");
        }
        else{
            $username=$_SESSION["username"];
            echo "<title>$username</title>";
        }
        ?>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/responsiveness.css">
		<link rel="stylesheet" href="assets/css/nav.css">
		<link rel="stylesheet" href="assets/css/asidenav.css">
		<link rel="stylesheet" href="assets/css/lf.css">
		<link rel="stylesheet" href="assets/css/button.css">
        <link rel="stylesheet" href="assets/css/footer.css">
        <link rel='shortcut icon' type='image/x-icon' href="photos/uop_logo4_navigation.gif"/><meta name="description" content="UOP Logo"/>
	
	
	</head>
	
	
	<body>
		<header>
			<div class="nav">
				  <input type="checkbox" id="nav-check">
				  <div class="nav-header">
					<div class="nav-title">
					 <img src="photos/uop_logo4_navigation.gif" width="60" height="40"/> 
					</div>
	
				  </div>
				  <div class="nav-btn">
					<label for="nav-check">
					  <span></span>
					  <span></span>
					  <span></span>
					</label>
				  </div>
				  
				  <div class="nav-links">
					<a  href="profilek.php"> <?php  if (isset($_SESSION["id_professor"])){
                            echo "$username";
                        }?></a>
					<a href="logout.php">Αποσύνδεση</a>
				  </div>
			</div>
		
		</header>
		<aside>
			
		<!-- Sidebar -->
		<div id="mySidebar" class="sidebar">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
			<a href="edit_prof.php">Επεξεργασία προφίλ</a>
			<a href="change_password.php">Αλλαγή κωδικού</a>
			<a href="create_lesson.php">Δημιουργία μαθήματος</a>
			<a href="create_question.php">Εισαγωγή ερώτησης</a>>
			<a href="select_lesson.php">Επεξεργασία ερωτήσεων</a>
			<a href="create_exam.php">Δημιουργία εξέτασης</a>
			<a href="edit_exam.php">Επεξεργασία διαγωνίσματος</a>
		</div>

	</aside>
	<main>  
		<button class="openbtn" onclick="openNav()">☰ Βασικές επιλογές</button>     
        <div id="myform" style="margin-left:25%;padding:10px 50px;">
			<h3>Εκχώρηση αριθμόυ ερωτήσεων που θέλετε στο διαγώνισμα</h3>
			<form action="random_test2.php" method="post">
			<?php 
			$max=0;
			$id_lesson=$_SESSION["id_lesson"];
			$query=mysqli_query($conn,"SELECT * FROM includes WHERE id_lesson='$id_lesson'");
			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				$id_question=$row["id_question"];	
				$querye=mysqli_query($conn,"SELECT * FROM question WHERE difficulty_level='easy' AND id_question='$id_question'");
           		 while ($rowe = mysqli_fetch_array($querye, MYSQLI_ASSOC)) {
				$max=$max+1;
				}
			}
           	echo "<label for='number_questionse'>Αριθμός ερωτήσεων εύκολης δυσκολίας </label>
            		<input type='number' id='number_questionse' name='number_questionse' min='0' max='$max'  required>"; ?>
            <br> <br> <br>
			<?php 
			$max=0;
			$id_lesson=$_SESSION["id_lesson"];
			$query=mysqli_query($conn,"SELECT * FROM includes WHERE id_lesson='$id_lesson'");
			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				$id_question=$row["id_question"];	
				$querye=mysqli_query($conn,"SELECT * FROM question WHERE difficulty_level='medium' AND id_question='$id_question'");
           		 while ($rowe = mysqli_fetch_array($querye, MYSQLI_ASSOC)) {
				$max=$max+1;
				}
			}
			echo "<label for='number_questionsm'>Αριθμός ερωτήσεων μέτριας δυσκολίας  </label>
           		 <input type='number' id='number_questionsm' name='number_questionsm' min='0' max='$max'  required>"; ?>
			<br> <br> <br>
			<?php 
			$max=0;
			$id_lesson=$_SESSION["id_lesson"];
			$query=mysqli_query($conn,"SELECT * FROM includes WHERE id_lesson='$id_lesson'");
			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				$id_question=$row["id_question"];	
				$querye=mysqli_query($conn,"SELECT * FROM question WHERE difficulty_level='difficult' AND id_question='$id_question'");
           		 while ($rowe = mysqli_fetch_array($querye, MYSQLI_ASSOC)) {
				$max=$max+1;
				}
			}
			echo "<label for='number_questionse'>Αριθμός ερωτήσεων δύσκολης δυσκολίας  </label>
            <input type='number' id='number_questionsd' name='number_questionsd' min='0' max='$max'  required>"; ?>
			<br> <br> <br>
            <input type="submit" value="Τυχαία επιλογή ερωτήσεων">
            </form>
			</div>
                     
		</main>
        <footer>Copyright Gerakianaki Vlachou © 2021</footer>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js" ></script>
        <script src="assets\js\bootstrap-number-input.js" ></script>
        <script src="assets\js\bootstrapSwitch.js" ></script>
		<script src="assets/js/aside.js"></script>
		<script src="assets/js/addmore.js"></script>
		<script src="assets/js/grade.js"></script>
		<script src="assets/js/ngrade.js"></script>
		<script src="assets/js/inserttime.js"></script>
	</body>
</html>
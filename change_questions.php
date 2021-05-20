<?php
session_start();	
include 'config.php';
$username=$_SESSION["username"];
$id_question=$_POST['id_question'];
?>
<!DOCTYPE HTML>

<html>
	<head>
	
		<?php 
        if (isset($_SESSION["id_professor"])==NULL) {
            header("location: index.php");
        }
        else{
		  echo "<title>$username</title>";
        }
		?>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/responsiveness.css">
		<link rel="stylesheet" href="assets/css/nav.css">
		<link rel="stylesheet" href="assets/css/st.css">
		<link rel="stylesheet" href="assets/css/asidenav.css">
		<link rel="stylesheet" href="assets/css/lf.css">
		<link rel='shortcut icon' type='image/x-icon' href="photos/uop_logo4_navigation.gif"/><meta name="description" content="UOP Logo"/>		
	
	</head>
	
	
	<body>
		<header>
			<div class="nav">
				  <input type="checkbox" id="nav-check">
				  <div class="nav-header">
					<div class="nav-title">
					 <a href="index.php"> <img src="photos/uop_logo4_navigation.gif" width="60" height="40"/> </a>
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
					<a  href="profilef.php"> <?php echo "$username"; ?></a>
					<a href="logout.php">Αποσύνδεση</a>
				  </div>
			</div>
		
		</header>
		<aside>
		
		<!-- Sidebar -->
		<div id="mySidebar" class="sidebar">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
		<a href="edit_prof.php">Επεξεργασία προφίλ</a>
		<a href="create_lesson.php">Δημιουργία μαθήματος</a>
		<a href="create_question.php">Εισαγωγή ερώτησης</a>
		<a href="select_lesson.php">Επεξεργασία ερωτήσεων</a>
		<a href="create_exam.php">Δημιουργία εξέτασης</a>
		<a href="edit_exam.php">Επεξεργασία διαγωνίσματος</a>
		</div>
	
		</aside>
		<main>  
			<button class="openbtn" onclick="openNav()">☰ Βασικές επιλογές</button>   
                       
		<div id="myform" style="margin-left:25%;padding:10px 50px;height:1000px;">
			<h3>Επεξεργασία ερωτήσεων</h3>
			<?php
				if (isset($_SESSION["id_professor"])!=NULL){
					$s = mysqli_query($conn,"select * from question");
					while ($row = mysqli_fetch_array($s, MYSQLI_ASSOC)) {
						$txt=$row["text"];
						$type=$row["type"];
						$find=mysqli_query($conn,"select * from question where id_question='$id_question'");
						while ($row = mysqli_fetch_array($find, MYSQLI_ASSOC)) {
							$text=$row["text"];
							$qtype=$row["type"];
						}
					}
				}
			?>
			<form action="save_edited_quest.php" method="post">
				<label for="text"><b>Κείμενο Ερώτησης <?php echo "$qtype"; ?></b></label> 
				<input  type="text" value="<?php echo "$text"; ?>" id="txt" name="txt" required >
				<br> <hr>
				<?php
					if($qtype=="Multiple Choice"){
						echo '<label for="text"><b>Πιθανές απαντήσεις</b></label>'; 
						$findidpa=mysqli_query($conn,"select * from has where  id_question='$id_question'");
						while ($row = mysqli_fetch_array($findidpa, MYSQLI_ASSOC)) {
							$id_pa=$row["id_possibleAnswer"];
							$findpa=mysqli_query($conn,"select * from possible_answer where id_possibleAnswer='$id_pa'");
							while ($row = mysqli_fetch_array($findpa, MYSQLI_ASSOC)) {
								$pa=$row["text"];
								$iscorrect=$row["is_correct"];
								if($iscorrect=="0"){
									echo "<p><input type='radio' id='$pa' name='pa[]' value='$pa'>
								<label for='$pa'>$pa</label><p>";
								}
								else{
									echo "<p><input type='radio' id='$pa' name='pa[]' value='$pa' checked>
								<label for='$pa'>$pa</label><p>";
								}	
							}
						}
					}
					else if($qtype=="Multiple Choice More"){
						echo '<label for="text"><b>Πιθανές απαντήσεις</b></label>'; 
						$findidpa=mysqli_query($conn,"select * from has where  id_question='$id_question'");
						while ($row = mysqli_fetch_array($findidpa, MYSQLI_ASSOC)) {
							$id_pa=$row["id_possibleAnswer"];
							$findpa=mysqli_query($conn,"select * from possible_answer where id_possibleAnswer='$id_pa'");
							while ($row = mysqli_fetch_array($findpa, MYSQLI_ASSOC)) {
								$pa=$row["text"];
								$iscorrect=$row["is_correct"];
								if($iscorrect=="0"){
									echo "<p><input type='checkbox' id='$pa' name='pa[]' value='$pa'>
								<label for='$pa'>$pa</label><p>";
								}
								else{
									echo "<p><input type='checkbox' id='$pa' name='pa[]' value='$pa' checked>
								<label for='$pa'>$pa</label><p>";
								}	
							}
						}
					}
					else if($qtype=="True-False"){
						echo '<label for="text"><b>Πιθανές απαντήσεις</b></label>'; 
						$findidpa=mysqli_query($conn,"select * from has where  id_question='$id_question'");
						while ($row = mysqli_fetch_array($findidpa, MYSQLI_ASSOC)) {
							$id_pa=$row["id_possibleAnswer"];
							$findpa=mysqli_query($conn,"select * from possible_answer where id_possibleAnswer='$id_pa'");
							while ($row = mysqli_fetch_array($findpa, MYSQLI_ASSOC)) {
								$iscorrect=$row["is_correct"];
							}
						}
						if($iscorrect=="0"){
							echo "<p><input type='radio' id='true' name='true' value='true'>
								<label for='true'>True</label><p>";
							echo "<p><input type='radio' id='false' name='false' value='false' checked>
								<label for='false'>False</label><p>";
						}
						else{
							echo "<p><input type='radio' id='true' name='true' value='true' checked>
								<label for='true'>True</label><p>";
							echo "<p><input type='radio' id='false' name='false' value='false'>
								<label for='false'>False</label><p>";
						}
					}
				
				?>	
				<button type="button" class="cancelbtn"><a href="select_lesson.php">Έξοδος</a></button>
				<button type="submit" class="cleanbtn" style="color:white">Αλλαγή</button>
				<br>
			</form>
		</div>
		</main>
                     
		</main>
		<footer>
		</footer>
		<script ></script>
		<script src="assets/js/aside.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
		<script src="assets/js/PcheckLength.js"></script>
		<script src="assets/js/emailcheck.js"></script>
		<script src="assets/js/passwordcheck.js"></script>
		<script src="assets/js/index.js"></script>
	</body>
</html>
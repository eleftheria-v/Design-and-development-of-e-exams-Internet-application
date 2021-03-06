
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
		<link rel="stylesheet" href="assets/css/checkbox.css">
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
			<a href="create_question.php">Εισαγωγή ερώτησης</a>
			<a href="select_lesson.php">Επεξεργασία ερωτήσεων</a>
			<a href="create_exam.php">Δημιουργία εξέτασης</a>
			<a href="edit_exam.php">Επεξεργασία διαγωνίσματος</a>
            <a href='correction.php'>Διόρθωση διαγωνισμάτων</a>
		</div>
	
		</aside>
		<main>  
			<button class="openbtn" onclick="openNav()">☰ Βασικές επιλογές</button>     
        <div id="myform" style="margin-left:25%;padding:10px 50px;">
			<h3>Εκχώρηση True-False ερώτησης</h3>
			
	
			  <form action="question_tf.php" method="post">
			  <label for="course">Παρακαλώ επιλέξτε μάθημα</label> <br>
			  <?php
			   	$idp=$_SESSION["id_professor"];
				   echo "<select id='course' name='course'>";
				   
				   $s = mysqli_query($conn,"select * from create_lesson where id_professor='$idp'");
				   while ($row = mysqli_fetch_array($s, MYSQLI_ASSOC)) {
					   $my_lesson=$row["id_lesson"];
					   $findlesson=mysqli_query($conn,"select * from lesson where id_lesson='$my_lesson'");
					   while ($row = mysqli_fetch_array($findlesson, MYSQLI_ASSOC)) {
						$my_l=$row["name"];
						echo "<option value='$my_lesson'>$my_l</option>";  
					   }
				  }
				  echo "</select>";	 
			 	   
	
				
				?>
			
                <br> 
			    <label for="qtext">Κείμενο True-False ερώτησης</label> <br>
			    <input type="text" id="qtext" name="qtext" placeholder="Κείμενο True-False ερώτησης" required>
				<br> 
				<label for="difficulty_level">Κατηγορία Μαθήματος</label> <br>
			    <select id="difficulty_level" name="difficulty_level">
			      <option value="easy">Εύκολη</option>
			      <option value="medium">Μέτρια</option>
			      <option value="difficult">Δύσκολη</option>
				</select>
                <br> 
				<label for="chapter">Κεφάλαιο</label>
				<input type="number" id="chapter" name="chapter" min="1"  required>
				<br> 
				<label for="grade">Bαθμόλογηση</label> <br>
			    <input type="text" id="grade" name="grade" placeholder="Bαθμόλογηση" onblur="validateGrade(this);"  pattern="[0-9]{1}.[0-9]{2}"required>
				<br> <span id='messageGrade'></span>
				<br> 
				<label class="container">Αρνητική βαθμόλογηση
				<input type="checkbox" id="myCheck" onclick="negGrade()">
				<span class="checkmark"></span>
				</label>
				<br>
				<p id="text" style="display:none">Παρακαλώ ορίστε αρνητική βαθμολόγηση
			    <input type="text" id="ngrade" name="ngrade" placeholder="Αρνητική βαθμολόγηση" onblur="validateNGrade(this);" pattern="[0-9]{1}.[0-9]{2}">
				<br> <span id='messageNGrade'></span></p>
				
                <label for="time">Παρακαλώ εισάγετε τον χρόνο απάντησης</label> <br>
			    <input type="text" id="time" name="time" placeholder="Χρόνος Απάντησης" onblur="validateTime(this);" pattern="[0]{2}:[0-6]{1}[0-9]{1}:[0-5]{1}[0-9]{1}" required>
				<br> <span id='messageTime'></span>
				<br> 
				<label for="answer">Σωστή Απάντηση</label> 
                <br>  
			    <select id="answer" name="answer">
			      <option value="T">True</option>
			      <option value="F">False</option>
				</select>
				<input type="submit" value="Εισαγωγή True-False ερώτησης">
				<br> <br>
    	        <button type="reset" class="cleanbtn">Καθαρισμός</button>

				<button class="cancelbtn" type="reset"><a href="create_question.php">Έξοδος</a></button>
                <br> <br>


			  </form>
			</div>
                     
		</main>
        <footer>Copyright Gerakianaki Vlachou © 2021</footer>
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js" ></script>
        <script src="assets\js\bootstrap-number-input.js" ></script>
        <script src="assets\js\bootstrapSwitch.js" ></script>
		<script src="assets/js/aside.js"></script>
		<script src="assets/js/grade.js"></script>
		<script src="assets/js/ngrade.js"></script>
		<script src="assets/js/inserttime.js"></script>
		<script src="assets/js/negGrade.js"></script>
	</body>
</html>
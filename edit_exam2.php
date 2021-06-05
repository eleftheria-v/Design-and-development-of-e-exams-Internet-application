
<?php
session_start();	
include 'config.php';
?>
	


<!DOCTYPE HTML>

<html>
	<head>
		<?php 
        if (isset($_SESSION["id_professor"])==NULL) {
						
            header("location: index.php");
						
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
		<link rel="stylesheet" href="assets/css/checkbox.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

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
					<a  href="profilek.php"> <?php echo "$username"; ?></a>
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
		</div>

	</aside>
	<main>  
		<button class="openbtn" onclick="openNav()">☰ Βασικές επιλογές</button> 
			
        <div id="myform" style="margin-left:25%;padding:10px 50px;height:1000px;">
			<h3>Επεξεργασία Εξέτασης</h3>
			
	
			  <form name="RegForm" action="exam_edit.php"  onsubmit="return time()" method="post">
			  <?php
			  	if (isset($_GET["msg"]) && $_GET["msg"] == 'past') {
						print "<p style='color:red'>Το διαγώνισμα σας δεν μπορεί να προγραμματιστεί στο παρελθόν.</p>";
					}
			 ?>
			  <label for="course">Μάθημα εξέτασης</label> <br>
			  <?php
			   	   $idp=$_SESSION["id_professor"];
				   echo "<select id='course' name='course' disabled>";
				   $my_exam=$_POST["exam"];
				   $_SESSION["id_exam"]=$my_exam;
                   $sa = mysqli_query($conn,"select * from belongs_to where id_exam='$my_exam'");
                   while ($row = mysqli_fetch_array($sa, MYSQLI_ASSOC)) {
                    $id_lesson=$row["id_lesson"];
                    $s = mysqli_query($conn,"select * from lesson where id_lesson='$id_lesson'");
                    while ($row = mysqli_fetch_array($s, MYSQLI_ASSOC)) {
                            $my_l=$row["name"];
							$_SESSION["lesson"]=$my_l;
                            echo "<option value='$my_l'>$my_l</option>";  
                        }
                    }
				  echo "</select>";	 
		
	
				
				?>
                <br> 
                <?php 
				
				   $s = mysqli_query($conn,"select * from exam where id_exam=' $my_exam'");
				   while ($row = mysqli_fetch_array($s, MYSQLI_ASSOC)) {
					   $date_time=$row["date_time"];
                       $arr=explode(" ", $date_time);
                       $arrdate=explode("-",$arr[0]);
                       $arrtime=explode(":",$arr[1]);
                    
				  }
			    ?>
				
				Ημερομηνία εξέτασης <br>
				<table border="0" cellspacing="0" >

				<tr><td  align=left  >   
				Μήνας
				<select name=month value=''>Select Month</option>
                <option <?php echo "value='$arrdate[1]'";?>>
                <?php 
                switch ($arrdate[1]) {
                case "01":
                    echo "Ιανουάριος";
                    break;
                case "02":
                    echo "Φεβρουάριος";
                    break;
                case "03":
                    echo "Μάρτιος";
                    break;
                case "04":
                    echo "Απρίλιος";
                    break;
                case "05":
                    echo "Μάιος";
                    break;
                case "06":
                    echo "Ιούνιος";
                    break;
                case "07":
                    echo "Ιούλιος";
                    break;
                case "08":
                    echo "Αύγουστος";
                    break;
                case "09":
                    echo "Σεπτέμβριος";
                    break;
                case "10":
                    echo "Οκτώβριος";
                    break;
                case "11":
                    echo "Νοέμβριος";
                    break;
                case "12":
                    echo "Δεκέμβριος";
                    break;
                default:
                    echo "   ";
                }?>
                </option>
				<option value='01'>Ιανουάριος</option>
				<option value='02'>Φεβρουάριος</option>
				<option value='03'>Μάρτιος</option>
				<option value='04'>Απρίλιος</option>
				<option value='05'>Μάιος</option>
				<option value='06'>Ιούνιος</option>
				<option value='07'>Ιούλιος</option>
				<option value='08'>Αύγουστος</option>
				<option value='09'>Σεπτέμβριος</option>
				<option value='10'>Οκτώβριος</option>
				<option value='11'>Νοέμβριος</option>
				<option value='12'>Δεκέμβριος</option>
				</select>



				</td><td  align=left  >   

				Ημερομηνία<select name=dt  >
                <option <?php echo "value='$arrdate[2]'";?>><?php echo $arrdate[2]; ?></option>
				<option value='01'>01</option>
				<option value='02'>02</option>
				<option value='03'>03</option>
				<option value='04'>04</option>
				<option value='05'>05</option>
				<option value='06'>06</option>
				<option value='07'>07</option>
				<option value='08'>08</option>
				<option value='09'>09</option>
				<option value='10'>10</option>
				<option value='11'>11</option>
				<option value='12'>12</option>
				<option value='13'>13</option>
				<option value='14'>14</option>
				<option value='15'>15</option>
				<option value='16'>16</option>
				<option value='17'>17</option>
				<option value='18'>18</option>
				<option value='19'>19</option>
				<option value='20'>20</option>
				<option value='21'>21</option>
				<option value='22'>22</option>
				<option value='23'>23</option>
				<option value='24'>24</option>
				<option value='25'>25</option>
				<option value='26'>26</option>
				<option value='27'>27</option>
				<option value='28'>28</option>
				<option value='29'>29</option>
				<option value='30'>30</option>
				<option value='31'>31</option>
				</select>


				</td><td  align=left  >   
				Χρονιά<input type=text  name=year size=4 value="<?php echo "$arrdate[0]"; ?>">
				</table>

				<br>
				Ώρα Εξέτασης &nbsp;&nbsp;&nbsp;&nbsp;
				<input type=text id="small" name=hours size=2 value="<?php echo "$arrtime[0]"; ?>"  >
				:
				<input type=text id="small" name=minutes size=2 value="<?php echo "$arrtime[1]"; ?>" >
				:
				<input type=text id="small" name=seconds size=2 value="<?php echo "$arrtime[2]"; ?>" >
				<br><?php
					if (isset($_GET["msg"]) && $_GET["msg"] == 'done') {
						print "<p style='color:red'>O χρόνος δεν έχει σωστή μορφή, παρακαλώ εισάγεται μορφή χρονου 24-ώρου.</p>";
					}
				?>
				<br> 
				
				
			    <input type="submit" value="Επεξεργασία των Ερωτήσεων">
				<button class="cancelbtn" type="reset"><a href="create_question.php">Έξοδος</a></button>
            
    	        <button type="reset" class="cleanbtn">Καθαρισμός</button>
                <br>


			  </form>
			</div>
                     
		</main>
		<footer>
		</footer>
		
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js" ></script>
        <script src="assets\js\bootstrap-number-input.js" ></script>
        <script src="assets\js\bootstrapSwitch.js" ></script>
		<script src="assets/js/aside.js"></script>
		<script src="assets/js/timeexam.js"></script>
		<script src="assets/js/ngrade.js"></script>
		<script src="assets/js/negGrade.js"></script>

	</body>
</html>
<?php
session_start();


session_destroy();
?>
<!DOCTYPE html>
<html>
<head>

    
    <title>Σύστημα Εξέτασης</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/style.css">
     <link rel="stylesheet" href="assets/css/pass.css">
    <link rel="stylesheet" href="assets/css/responsiveness.css">
    <link rel="stylesheet" href="assets/css/footer.css">
     <link rel='shortcut icon' type='image/x-icon' href="photos/uop_logo4_navigation.gif"/><meta name="description" content="UOP Logo"/>

</head>
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
            <a  href="index.php">Αρχική Σελίδα</a>
            <a  href="sign_in.php">Εισαγωγή</a>
            <a href="sign_upf.php">Εγγραφή Φοιτητή</a>
            <a href="sign_upk.php">Εγγραφή Καθηγητή</a>
        </div>
    </div>

</header>
<body>
<main></main>
<footer>Copyright Gerakianaki Vlachou © 2021</footer>
<script src="assets/js/emailcheck.js"></script>
<script src="assets/js/index.js"></script>



</body>
</html>

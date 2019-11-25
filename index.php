<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="pageStyle.css">

<script type="text/javascript" src="script.js"></script>
</head> 
<body>
<div class="container">

	<div class="logo"><img src="https://dewey.tailorbrands.com/production/brand_version_mockup_image/17/1787055017_49da261b-2cc0-46bf-9ee4-08a07b96c4f7.png?cb=1552554710"></div>

	<div class="bara">
		<ul>
		<li><button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button></li>
		<li style="float:right"><a class="active" href="">Contact</a></li>
		</ul>
	</div>
</div>

<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
  
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


<br><br><br><br><br><br>

<?php  
include dirname(__FILE__) .'/functions.php';
include dirname(__FILE__) .'/./medicament/Medicament.php';

			 \Medicament\printMedFullList();
			 \Medicament\getMedDen(1);
			 
			if($_SERVER['REQUEST_METHOD']=='POST')
           {
             
			$id=$_POST['uname'];

			$pass=$_POST['psw'];
			
			if(\functions\checkLogin($id,$pass)==1){
				?>
<script type="text/javascript">
window.location.href = 'afterLogin.php';
</script>
<?php
			}
			else{
			
			}
		   }
			
?>


</body>
</html>

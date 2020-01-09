<!DOCTYPE html>
<html>
<head>
<?php 
$path = '/farmacie/public/'  ;
$appPath = '/farmacie/public/index.php/';
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo $path;?>css/style.css">
<link rel="stylesheet" href="<?php echo $path;?>css/pageStyle.css">

<script type="text/javascript" src="<?php echo $path;?>js/script.js"></script>
</head> 
<body>
<?php 
//https://codeigniter4.github.io/CodeIgniter4/database/index.html
$db = \Config\Database::connect();
$query = $db->query("SELECT * FROM bon");

foreach ($query->getResult() as $row)
{
    //echo $row->codb . " " . $row->total_plata . "<br>";
}
?>

<div class="container">

	<div class="bara">
		<ul>
		<li><button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button></li>
		</ul>
	</div>
</div>

<div id="id01" class="modal">
  
  <form method="post" action="<?php echo $appPath;?>login/login_validation" class="modal-content animate" >
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
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



</body>
</html>

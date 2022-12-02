
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="lib/fontawesome-free-6.2.1-web/css/fontawesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      body {
        font-family: 'Lato', sans-serif;
      }
.flex-parent {
      display: flex;
      }
      
.jc-center {
      justify-content: center;
      }

.button {
  width: 200px;
  color: white;
  padding: 16px 32px 16px;
  text-align: center; 
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  background-color: white; 
  color: black; 
  border: 3px solid #0a0f11;
  margin: 4px;
  
 }
.search-contai{
    float: none;
    display: block;
    text-align: right;
    position: absolute;
    width: 100%;
    /* margin-right: 20px; */
    /* border: 1px solid #0a0f11; */
    /* margin: 5px; */
    margin-top: 11px;
    /* margin-right: 11px; */
    margin-left: -10px;
  
   }  


.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: rgb(4, 2, 2);
   color: white;
   text-align: center;
}


#wlc_header{
    text-align: center;
}

.overlay {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
  overflow-x: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 5%;
  /* width: 30%; */
  text-align: left;
  margin-top: 30px;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  top: 0px;
  right: 0px;
  font-size: 30px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
}

* {box-sizing: border-box;}


.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}


.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 20px;
  font-size: 13px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 20px;
  margin-right: 0px;
  background: #ddd;
  font-size: 13px;
  border: none;
  cursor: pointer;
}
@media screen and (max-width: 350px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 0px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>
<script src=block.js></script><script src=subject.js></script><script src=lecturename.js></script><script src=colleges.js></script><script src=stages.js></script>

</head>
<body>

<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#9776;</a>
  <div class="overlay-content">
    <?php
  $role_to=$_SESSION['role'];
    echo "<a href='index.php'>Home</a>";
    echo "<a href='#'>About</a>";
    if(isset($_SESSION['email'])){ echo "<a href='logout.php'>Logout</a>";}
    else{echo "<a href='login.php'>login</a>";};
    if($role_to == 1 OR $role_to == 2){
      echo "<a href=upload_data_interface.php>Upload&nbsp;Data</a>";
    }
    if($role_to == 2){
  echo "<a href='index.php?update_all_js=true'>Update&nbsp;All</a>";
    }
    ?>
    <!-- <a href="addservice_input_form.php">Add&nbsp;Service</a> --> 
  </div>
</div>

<div class="topnav">
  <a style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; SBA</a>
  <div class="search-container">
    <!-- if user logged in show search bar -->
    <?php 
    if(isset($_SESSION['email'])){ 
echo "<form action='' method='GET'>";
echo "<input type='text' name='search' required value='".(isset($_GET['search'])?$_GET['search']:"")."' placeholder=Search '>";
// echo "<button type='submit'><i class='fa fa-search'></i></button>";
echo "<button type='submit' style='height: 15px;'><svg viewBox='0 0 512 512' style='width: 20px;height: 20px;'><path d='M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z'/></svg></button>";
  echo "</form>";
  }?>
</button>

  </div>
  </div>
  <!-- <form action="" method="GET">
<input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>"  placeholder="Search ">
<button type="submit"><i class="fa fa-search"></i></button>
    </form> -->
<div class="footer">
  <p>Copyright to SBA</p>
</div>
<script>
function openNav(){
  document.getElementById("myNav").style.width = "215px";
}

function closeNav(){
  document.getElementById("myNav").style.width = "0%";
}
</script>
 

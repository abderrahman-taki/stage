<?php

include('partials/header.php')

?>
<?php
if(isset($_SESSION['accountCreated'])){
    echo $_SESSION['accountCreated'];
    unset ($_SESSION['accountCreated']);

}

?>
<div class="form_container">
        <div class="overlay">

        </div>
        <div class="titleDiv">
            <h1 class="title">Login</h1> 
            <span class="subTitle">welcome back</span>

        </div>
        <?php
        if(isset($_SESSION['noAdmin'])){

            echo $_SESSION['noAdmin'];
            unset($_SESSION['noAdmin']);
        }

        ?>


        <form action="" method="POST">
            <div class="rows grid">
                <div class="row">
                    <label for="username">user name</label>
                    <input type="text" id="username" name="username" placeholder="entrer username" required>
                </div>
                <div class="row">
                    <label for="password">user password</label>
                    <input type="text" id="password" name="password" placeholder="entrer password" required>
                </div>
                <div class="row">
                    <input type="submit" id="submitBtn" name="submit" value="Login" required>
                    <span class="registerLink">don't have an account <a href="register.php">register</a></span>
                </div>
            </div>
        </form> 

</div>
<?php
include('partials/footer.php')

?>


<?php
if(isset($_POST['submit'])){
//    echo 'yes data submited';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE usernames = '$username' AND password = '$password' ";

$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result);

if($count ==1){

    $_SESSION['loginMessage'] = '<span class="success">Welcome '.$username.' </span>';
    header('location:'  .SITEURL.'dashboard.php');
    exit();
}
else{
    $_SESSION['noAdmin'] = '<span class="fail"> '.$username.' is not registred! </span>';
    header('location:'  .SITEURL.'index.php');
    exit();


}



}

?>
    

<?php

include('partials/header.php')

?>
<div class="form_container">
        <div class="overlay">

        </div>
        <div class="titleDiv">
            <h1 class="title">register</h1> 
            <span class="subTitle">thanks for chossing us!</span>

        </div>
        


        <form action="" method="POST">
            <div class="rows grid">
                <div class="row">
                    <label for="username">user name</label>
                    <input type="text" id="username" name="username" placeholder="entrer username" required>
                </div>
                <div class="row">
                    <label for="email">email</label>
                    <input type="text" id="email" name="email" placeholder="entrer email" required>
                </div>
                <div class="row">
                    <label for="phone">phone number</label>
                    <input type="text" id="phone" name="phone" placeholder="entrer phone" required>
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
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];


$sql = "INSERT INTO admin SET
        usernames = '$username',
        email = '$email',
        password = '$password',
        phone = '$phone'
";

$res = mysqli_query($conn, $sql);



if($res == true){

    $_SESSION['accountCreated'] = '<span class="addAccount">Account '.$username.' Created! </span>';
    header('location:'  .SITEURL.'index.php');
    exit();
}
else{
    $_SESSION['unSuccessful'] = '<span class="fail">Account '.$username.' failed! </span>';
    header('location:'  .SITEURL.'register.php');
    exit();


}



}


?>
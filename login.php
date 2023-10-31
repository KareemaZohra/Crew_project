<?php
session_start();
if(isset($_SESSION['user'])){
    header("Location: index.php");
}

$usermail = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$roles= [];
$usernames = [];
$emails = [];
$passwords = [];
$errorMsg = "";

$fp = fopen("./data/user.txt","r");
while ($line=fgets($fp)){
    $values = explode(",",$line);
    array_push($roles, trim($values[0]));
    array_push($usernames, trim($values[1]));
    array_push($emails, trim($values[2]));
    array_push($passwords, trim($values[3]));
}
fclose($fp);

for($i=0; $i<count($roles); $i++){
    if($usermail==$emails[$i] && $password==$passwords[$i]){
        $_SESSION['user'] = $usernames[$i];
        $_SESSION['role'] = $roles[$i];
        header("Location: index.php");
    }
    else{
        $errorMsg = "Username or password does not match";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crew</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <form action="login.php" method="POST" style="margin-top: 50px">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="staticEmail">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="inputPassword">
                    </div>
                </div>
                <p class="text-danger">
                    <?php
                        echo $errorMsg;
                    ?>
                </p>
                <button type="submit" class="btn btn-primary mb-3">Login</button>
            </form>

        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
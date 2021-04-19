<?php

    if(isset($_COOKIE['user'])){
        session_id($_COOKIE['user']) ;
        session_start();
        $visit = $_COOKIE['visit_count']+ 1;
        setcookie("visit_count",  $visit , time() + (86400 * 365), "/");
        $visitor_ip = $_SERVER['REMOTE_ADDR'];
    }
    else {
        session_start();
        setcookie("user", session_id(), time() + (86400 * 365), "/");
        setcookie("visit_count", 1 , time() + (86400 * 365), "/");
        setcookie("old_count", 1 , time() + (86400 * 365), "/");
        $visit = 1;
        $visitor_ip = $_SERVER['REMOTE_ADDR'];
    }

    // setcookie("user", "gmu2templgtolmv2tdukgfvglq", time() + (86400 * 30), "/");
    // session_id("gmu2templgtolmv2tdukgfvglq");
    // session_start();
    $_SESSION['visit_count'] = $visit;
    $_SESSION['ip_address'] = $visitor_ip;

    require_once 'pdo.php';
    

    if(isset($_POST['type']) && isset($_POST['info']) ){
        if(strlen($_POST['info'])>0 && strlen($_POST['type'])>0 ){

            if($_POST['type']=="phone"){
                $type = "phone_no";
                $value = "88".$_POST['info'];
            }
            else if ($_POST['type']=="email"){
                $type = "email";
                $value = $_POST['info'];
            }
            $_SESSION['search'] = $value;

            $sql = "SELECT * from users where ".$type." = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':id'=> $value
            ));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row == false){
                $_SESSION['error']='<b>Congrats!! You are safe</b><br/>'.$_POST['info'].' is not found in the record';
                header("Location: index.php");
                return;
            }
            else{
                $_SESSION['success']='Oopss!!!<br/>'. $_POST['info'].' is found in the record.<br>Your Facebook name is</br> <b class="text-dark bg-success p-1">'.$row['name'].'</b>
                <br/><a href="view.php" class="btn btn-dark mt-2">View Details</a>';
                $_SESSION['row'] = $row;
                header("Location: index.php");
                return;
            }
        }
    


    }
    require 'count.php';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>khOOj</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <div class="container-fluid">
        <?php
            if(isset($_COOKIE['limit'])){
                die('<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Your maximum daily limit exceeded!!</h4>
                        <p>Max  <strong>100 </strong>visits per day</p> <hr>
                        <p class="mb-0">Try again after 1 day!</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            }
        ?>
        <nav class="navbar navbar-expand navbar-dark bg-primary ">
            
            <a class="navbar-brand" href="index.php"><img src="assets/img/khoj.png" alt="logo" srcset="">
                <h2 class="text-dark d-inline font-weight-bold">Kh<img src="assets/img/khojS.png" alt="logo" srcset="">j</h2>
            </a>
        
            <div class="collapse navbar-collapse justify-content-end" id="">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" href="index.php">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sign_in.php">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hiw.php">How it works</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:md.danialislam@gmail.com"><img class="logo" src="assets/img/gmail.png" alt="github_logo"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/danialcodes"><img class="logo" src="assets/img/github.png" alt="github_logo"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.facebook.com/danialcodes"><img class="logo"src="assets/img/facebook.png" alt="facebook_logo"></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.youtube.com/channel/UC6rwQMjzyTJ2cIIKfMpzqtQ"><img class="logo" src="assets/img/youtube.png" alt="youtube_logo"></a>
                    </li>
                </ul>
            </div>
            
        </nav>

        <div class="bg-warning m-5 ">
            <div class="d-flex justify-content-center p-4 ">
                <b class="text-justify">Check if your data is compromised in the recent facebook data breach or not</b> 
            </div>
            <form action="" class="mx-5 mt-5 bg-info" method="post">
                <div class="form-group row d-flex justify-content-center p-3">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="phone" value="phone">
                        <label class="form-check-label" for="phone">Phone</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="email" value="email">
                        <label class="form-check-label" for="email">Email</label>
                    </div>
                    
                    <div class="col-sm-4">
                        <input name="info" type="text" class="form-control" id="info" placeholder="Phone or email">
                    </div>
                    <button type="submit" class="btn btn-danger">Search!</button>
                </div>
            </form>
            <div class="d-flex justify-content-center ">
            <?php
                if(isset($_SESSION['error'])){
                    echo'<div class="bg-success text-white mx-5 h-50 p-2 text-center" >'.$_SESSION['error'].'</div>';
                    unset($_SESSION['error']);
                }
                if(isset($_SESSION['success'])){
                    echo'<div class="bg-danger text-white mx-5   h-50 p-2 text-center text-justify " >'.$_SESSION['success'].'</div>';
                    unset($_SESSION['success']);
                }
            ?>
            </div>
            
        </div>
        <nav class="navbar navbar-expand navbar-dark bg-primary fixed-bottom text-light justify-content-end ">
               <div ><img class="cr"src="assets/img/copyright.png" alt="" srcset=""> Danialcodes</div>
            </nav>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="script/script.js"></script>
</body>
</html>
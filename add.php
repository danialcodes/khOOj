<?php
header('Location: index.php');
return;
    require_once "pdo.php";

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone_no']) && isset($_POST['fb_id'])
        && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['r_status'])
        && isset($_POST['dob']) && isset($_POST['work_at']) && isset($_POST['work_start']) ){

            $sql = "INSERT INTO users
                    (name, phone_no, email, fb_id, gender, address,r_status,work_at,work_start,dob)
                    VALUES ( :n, :pn, :em, :fi, :gn, :ad, :rs, :wa, :ws, :dob)";
            $stmt = $pdo->prepare($sql);
            $mapping = array(
                ':n' => $_POST['name'],
                ':pn' => (int)$_POST['phone_no'],
                ':em' => $_POST['email'],
                ':fi' =>(int) $_POST['fb_id'],
                ':gn' => $_POST['gender'],
                ':ad' => $_POST['address'],
                ':rs' => $_POST['r_status'],
                ':wa' => $_POST['work_at'],
                ':ws' => $_POST['work_start'],
                ':dob' => $_POST['dob']
            );
                $stmt->execute($mapping);
            // $_SESSION['success'] = 'Profile added';
            header('Location: add.php');
            return;


    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <h1 align='center'>Add information</h1>
    <form action="" method="post" name='add'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name='name'>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name='email'>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="phone_no">Phone</label>
                <input type="text" class="form-control" id="phone_no" name='phone_no'>
            </div>
            <div class="form-group col-md-4">
                <label for="fb_id">Facebook Id</label>
                <input type="text" class="form-control" id="fb_id" name='fb_id'>
            </div>
            <div class="form-group col-md-4">
                <label for="gender">Gender</label>
                <input type="text" class="form-control" id="gender" name='gender'>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name='address'>
            </div>
            <div class="form-group col-md-4">
                <label for="r_status">Relationship Status</label>
                <input type="text" class="form-control" id="r_status" name='r_status'>
            </div>
            <div class="form-group col-md-2">
                <label for="dob">Date of Birth</label>
                <input type="text" class="form-control" id="dob" name='dob'>
            </div>
            
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="work_at">Work at</label>
                <input type="text" class="form-control" id="work_at" name='work_at'>
            </div>
            <div class="form-group col-md-6">
                <label for="work_start">Work Start</label>
                <input type="text" class="form-control" id="work_start" name='work_start'>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add information</button>
    </form>
    </div>
</body>
</html>
<?php
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION['row'])){
    // print_r($_SESSION['row']);
    // echo session_id();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <div class="container  ">
        <table class="table text-center table-striped table-bordered table-hover">
            <thead>
                <tr class="bg-success">

                    <th colspan='2' scope="col" >Leaked information about <?=$_SESSION['row']['name']?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Facebook Name</th>
                    <td><?=$_SESSION['row']['name']?></td>
                </tr>
                <tr>
                    <th scope="row">Facebook Id</th>
                    <td><?=$_SESSION['row']['fb_id']?></td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td><?=$_SESSION['row']['gender']?></td>
                </tr>
                <tr>
                    <th scope="row">Relationship Status</th>
                    <td><?=$_SESSION['row']['r_status']?></td>
                </tr>
                <tr >
                    <th scope="row">Phone Number</th>
                    <td><?=$_SESSION['row']['phone_no']?></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?=$_SESSION['row']['email']?></td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td><?=$_SESSION['row']['address']?></td>
                </tr>
                <tr>
                    <th scope="row">Works at</th>
                    <td><?=$_SESSION['row']['work_at']?></td>
                </tr>
                <tr>
                    <th scope="row">Work Start date</th>
                    <td><?=$_SESSION['row']['work_start']?></td>
                </tr>
                <tr>
                    <th scope="row">Date of Birth</th>
                    <td><?=$_SESSION['row']['dob']?></td>
                </tr>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary"><- Back to Home</a>
    </div>
</body>
</html>
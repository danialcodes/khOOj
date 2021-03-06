<?php
    // if(!isset($_SESSION)) session_start();

    require_once "pdo.php";

    if(isset($_COOKIE['old_count']) && $_SESSION['visit_count'] - $_COOKIE['old_count'] >1000-2 ){
        setcookie("limit",  "limit exceeded" , time() + (86400), "/");
        setcookie("old_count", $_SESSION['visit_count'] , time() + (86400*365), "/");
    }

    if(isset($_SESSION['visit_count'])){

        $sql = "SELECT * from user_count where session_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':id'=> session_id()
            ));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row!=false){
            $sqle = "UPDATE user_count SET visit=:v where user_id = :uid ";
            $stmte = $pdo->prepare($sqle);
            $mapping = array(
                        ':v' => $_SESSION['visit_count'],
                        ':uid'=>$row['user_id']
                        );
            $stmte->execute($mapping);

            if(isset($_SESSION['search']) ) {
                $sqls = "UPDATE user_count SET search=:s where user_id = :uid ";
                $stmts = $pdo->prepare($sqls);
                if($row['search']==null){
                    $mappings = array(
                        ':s' => $_SESSION['search'],
                        ':uid'=>$row['user_id']
                        );
                }
                else{
                $mappings = array(
                            ':s' => $row['search'].",". $_SESSION['search'],
                            ':uid'=>$row['user_id']
                            );
                }
                $stmts->execute($mappings);
            }
            unset($_SESSION['search']);




        }
        else{
            $sqle = "INSERT INTO user_count (session_id,visit,ip_address) values (:sid, :v,:ip)";
            $stmte = $pdo->prepare($sqle);
            $mapping = array(
                        ':v' => $_SESSION['visit_count'],
                        ':sid'=> session_id(),
                        ':ip' => $_SESSION['ip_address']
                        );
            $stmte->execute($mapping);


            if(isset($_SESSION['search']) ) {
                $sqls = "UPDATE user_count SET search=:s where user_id = :uid ";
                $stmts = $pdo->prepare($sqls);
                $mappings = array(
                            ':s' => $row['search'].",". $_SESSION['search'],
                            ':uid'=>$row['user_id']
                            );
                $stmts->execute($mappings);
            }
            unset($_SESSION['search']);

        }

    }
        
?>
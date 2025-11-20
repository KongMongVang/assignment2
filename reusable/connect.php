<?php
    $connect = mysqli_connect(
                'localhost', 
                'root', 
                'root', //PUT YOUR PASSWORD. FOR MAC LEAVE PASSWORD EMPTY
                'parks' //YOUR DATABASE NAME
            );
            if(!$connect){
                die('Connection Failed: ' . mysqli_connect_error());
            }

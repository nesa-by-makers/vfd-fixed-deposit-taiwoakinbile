<?php

    $server = "localhost";
    $username ="root";
    $password = "Archetype";
    $database = "vfd_fd_form";

    $connection = new mysqli($server, $username, $password, $database);

    if($connection->connect_error) {
        die("Database connection failed: " . $connection->connect_error );
    }

   // helps to fix escape strings
    $Fullname = mysqli_escape_string($connection, $_POST["fullname"]);
    $Phonenumber = $_POST["Pnumber"];
    $Raddr = $_POST["R-addr"];
    $Oaddr =  $_POST["O-addr"];
    $Duration =  $_POST["Duration"];
    $Occupation = $_POST["Occupation"];
    $Amount =  $_POST["Amount"];
    $AcctNum = $_POST["AcctNum"];
    $AcctName=  $_POST["AcctName"];
    $BankName= $_POST["BankName"];
    $NKName = $_POST["NKName"];
    $NKNumber = $_POST["NKNumber"];
    $NKEmail = $_POST["NKEmail"];
    $Reference = $_POST["Reference"];

   
    
    //inserts value into customer info , do not regard auto-incremented values
    $query4 = "INSERT INTO customerinfo(Fullname, PhoneNo, ResidentialAdd, OfficeAdd, Occupation)
    VALUES ('".$Fullname."', '".$Phonenumber."','".$Raddr."','".$Oaddr."', '".$Occupation."');";

    if($connection->query($query4)==true){   //passes auto-incremented value into the value that needs it
    $CustomerID = $connection->insert_id;
    }

    $query1 = "INSERT INTO customerpayoutdetails(AccountNumber, BankName, Fullname, CustomerID)
     VALUES ('".$AcctNum."','".$BankName."', '".$AcctName."','".$CustomerID."' );";

    if($connection->query($query1)==true){
    $payoutID = $connection->insert_id;
    }
    else {
        echo "Payout Error:".$connection->error;
    }

    $query2 = "INSERT INTO nextofkindetails(NKName, NKPhoneNumber, NKEmail, NameofReference, CustomerID)
    VALUES ('".$NKName."','".$NKNumber."','".$NKEmail."', '".$Reference."','".$CustomerID."');";
    
    $query3 = "INSERT INTO customerplacementinfo(proposedDuration, FDAmount, CustomerID, payoutID)
    VALUES ('".$Duration."','".$Amount."' ,'".$CustomerID."','".$payoutID."' );";
    


    
    echo $query4;
    echo $query3;

   // $connection->query($query);           //query that runs db

    if($connection->query($query3)==true){
        echo "record inserted successfully";
    }
    else{
        echo "errrrrr NO!".$connection->error;
    }

    $connection-> close();

   // echo "Connection successful!";
?>

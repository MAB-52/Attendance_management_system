<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "faculty_registration";

    $conn = new mysqli($server, $username, $password, $db);

    if ($conn -> connect_error)
    {
        die("Connection failed: " . $conn -> connect_error);
    }
    // else
    // {
    //     echo "Success connecting db";
    // }

    //Queries.
    // SELECT * FROM `faculty_registration`

    // INSERT INTO `faculty_registration` (`sr.no`, `name`, `mobile_no`, `birth_date`, `qualification`, `email`, `password`) VALUES ('1', 'testname', '1234567890', '2024-06-13', 'B.tech', '123@gmail.com', '123'); 

    //  INSERT INTO `faculty_registration` (`sr.no`, `name`, `mobile_no`, `birth_date`, `qualification`, `email`, `password`) VALUES ('2', 'name', '1234567980', '2024-06-12', 'M.tech', '124@gmail.com', '123');

    //INSERT INTO `student_registration`(`student_id`, `student_name`, `roll_no`, `course`, `branch`, `semester`, `status`, `faculty_id`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]')
?>
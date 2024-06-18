# Attendance_management_system

Overview -
The Attendance Management System is a web-based application developed using PHP and MySQL. It allows faculty members to add student records and manage attendance efficiently. The system ensures that attendance statuses remain persistent even when new student records are added.

Features -
  User Authentication: Secure login for faculty members.
  Add New Students: Faculty can add new student records with details like name, roll number, course, branch, and semester.
  Mark Attendance: Faculty can mark students as present or absent.
  Persistent Attendance Status: The attendance status remains unchanged even when new students are added or the page is refreshed.
  
Installation -
  Prerequisites -
    Web Server: Apache or any web server with PHP support.
    PHP: Version 7.0 or above.
    MySQL: Version 5.6 or above.
    
Steps - 

Clone the Repository -

        git clone https://github.com/MAB-52/Attendance_management_system.git

Set Up the Database - 

Create a MySQL database.
Import the database.sql file to set up the necessary tables.

Configure Database Connection -

Update the config.php file with your database credentials.

php -
Copy code -

    <?php
    $host = 'localhost';
    $user = 'your_db_username';
    $password = 'your_db_password';
    $dbname = 'attendance_system';

    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    ?>

Start the Web Server

Ensure your web server is running and navigate to the project directory in your browser.

Usage -

  Login
  Navigate to the login page.
  Enter your credentials to log in.
  Add New Student
  Go to the "Add New Student" section.
  Fill in the student's details.
  Click "ADD STUDENT" to save the record.
  Mark Attendance
  Check the boxes next to student names to mark them as present.
  Click "Submit Attendance" to save the attendance status.


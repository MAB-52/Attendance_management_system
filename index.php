<?php 
  SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-warning-subtle">

    <!-- http://localhost/PHP_Projects/Attendance_management_system/ -->

    <!-- PHP -->
    <?php 

      include("./php/config.php");

      if (isset($_POST["submit"])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
      
        $sql = "SELECT * FROM `faculty_registration` WHERE `email` = '$email' AND `password` = '$password';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
      
        if ($result->num_rows > 0) {
            $_SESSION['valid'] = TRUE;
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['mobile_no'] = $row['mobile_no'];
            $_SESSION['birth_date'] = $row['birth_date'];
            $_SESSION['qualification'] = $row['qualification'];
        
            header('Location: student.php');
            exit();  
        } else {
            echo "<script>alert('Wrong Email or Password.');</script>";
        }
      
        // Connection close.
        $conn->close();
      }
    ?>

    <!-- HTML -->
    
    <div class="container-fluid bg-dark text-white mb-5"> 
      <p class="h1 text-center fw-bold p-3">ATTENDANCE MANAGEMENT SYSTEM</p>
    </div>

    <!-- Login-form -->
    <div class="container-fluid shadow-lg w-50 mt-5 bg-light rounded-5">
      <p class="fw-bold fs-2 text-center p-4 text-success">LOGIN</p>

      <div class="row">
        <div class="col-5 m-3 p-3">
          <img src="./assets/asset 21.png" alt="" style="width:20rem;">
        </div>
        <div class="col m-4">
          <form action="" class="mt-3" method="post">
            <label for="email" class="m-1">Email: </label>
            <input type="text" class="form-control mb-3 border-0 border-bottom bg-light" name="email" placeholder="Email" required>
            <label for="password">Password: </label>
            <input type="password" class="form-control mb-3 border-0 border-bottom bg-light" name="password" placeholder="Password" autocomplete="off" required>
            <div class="row">
              <input class="btn btn-success mt-3" type="submit" name="submit" value="LOGIN">
            </div>
            <p class="mt-3">New Registration? <a href="register.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Register Here</a></p>
          </form>
        </div>
      </div>
    </div>
  
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
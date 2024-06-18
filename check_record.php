<?php 
  SESSION_START();
  include("./php/config.php");
  if(!isset($_SESSION['valid']))
    {
        header('location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Attendance Management System</title>
</head>
<body class="bg-warning-subtle">
    <!-- HEADER -->
    <div class="container-fluid">
        <div class="row bg-dark justify-content-center align-items-center">
            <div class="col-md-1">
                <a class="link-offset-2" href="student.php">
                    <input class="btn btn-danger w-100" type="button" value="BACK" name="back">
                </a>
            </div>
            <div class="col-md-8">
                <p class="h3 m-3 p-3 text-center text-white fw-bold">STUDENT'S RECORDS</p>
            </div>
            <div class="col-md-1">
                <a class="link-offset-2" href="logout.php">
                    <input class="btn btn-success w-100" type="button" value="LOGOUT" name="logout">
                </a>
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="container">
        <!-- Display Records -->
        <div class="row text-center">
            <p class="fs-4 fw-semibold my-4">Mark Attendance
                <?php echo date("d/m/Y"); ?>
            </p>
        </div>

        <!-- Table to Display Student's Info -->
        <table class="table table-dark table-hover">
            <thead>
              <tr>
                <th scope="col">Sr.No</th>
                <th scope="col">Name</th>
                <th scope="col">Roll No</th>
                <th scope="col">Course</th>
                <th scope="col">Branch</th>
                <th scope="col">Semester</th> 
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="fs-5" scope="row">1</th>
                <td class="fs-5">Alex</td>
                <td class="fs-5">20</td>
                <td class="fs-5">BBA</td>
                <td class="fs-5">Finance</td>
                <td class="fs-5">6</td>
                <td class="fs-5 fw-semibold">Present</td>
              </tr>
              <tr>
                <th class="fs-5" scope="row">2</th>
                <td class="fs-5">Max</td>
                <td class="fs-5">30</td>
                <td class="fs-5">B.E.</td>
                <td class="fs-5">Computer</td>
                <td class="fs-5">4</td>
                <td class="fs-5 fw-semibold">Absent</td>
              </tr>
            </tbody>
        </table>

    </div>
    
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
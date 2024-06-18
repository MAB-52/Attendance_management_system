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
    <link rel="stylesheet" href="./css/student.css">
    <title>Attendance Management System</title>
</head>
<body class="bg-warning-subtle">

<!-- PHP -->
<?php
include("./php/config.php");

$faculty_email = $_SESSION["email"];
$query = "SELECT * FROM `faculty_registration` where `email` = '$faculty_email';";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if ($row)
{
    $id = $row['sr_no'];
} 
else 
{
    echo "No faculty member found with this email.";
    exit();
}

// Check and reset attendance if a new day has started
$today = date("d-m-Y");
$students_query = "SELECT * FROM `student_registration` WHERE `faculty_id` = '$id';";
$students_result = mysqli_query($conn, $students_query);
while ($student = mysqli_fetch_assoc($students_result)) {
    if ($student['date'] != $today) {
        $reset_query = "UPDATE `student_registration` SET `status` = 'Absent', `date` = '$today' WHERE `student_id` = '{$student['student_id']}';";
        mysqli_query($conn, $reset_query);
    }
}        

// Handle form submission for adding a student
if(isset($_POST["add_student"]))
{
    $student_name = trim($_POST["student_name"]);
    $roll_no = trim($_POST["roll_no"]);
    $course = trim($_POST["course"]);
    $branch = trim($_POST["branch"]);
    $semester = trim($_POST["semester"]);

    $sql = "INSERT INTO `student_registration`(`student_name`, `roll_no`, `course`, `branch`, `semester`, `faculty_id`) VALUES ('$student_name','$roll_no','$course','$branch','$semester','$id');";

    if (mysqli_query($conn, $sql)) 
    {
        echo "
        <script>
        alert('New record added successfully.');
        </script>";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} 

// Handle checkbox change to update attendance
if (isset($_POST["submit_attendance"])) {
    $student_ids = $_POST['student_ids'];
    $statuses = isset($_POST['statuses']) ? $_POST['statuses'] : [];
    
    foreach ($student_ids as $index => $student_id) {
        $status = in_array($student_id, $statuses) ? 'Present' : 'Absent';
        $update_query = "UPDATE `student_registration` SET `status` = '$status' WHERE `student_id` = '$student_id';";
        mysqli_query($conn, $update_query);
    }

    echo "<script>alert('Attendance updated successfully');</script>";
}
?>

<!-- HEADER -->
<div class="container-fluid">
    <div class="row bg-dark justify-content-center align-items-center">
        <div class="col-md-10">
            <p class="h3 m-3 p-3 text-center text-white fw-bold">
                Welcome 
                <?php 
                if (isset($_SESSION['name'])) {
                    echo ($_SESSION['name']);
                } else {
                    echo "Email session variable is not set.";
                }
                ?>
            !!</p>
        </div>
        <div class="col-md-1">
            <a class="link-offset-2" href="logout.php">
                <input class="btn btn-success w-100" type="button" value="LOGOUT" name="logout">
            </a>
        </div>
    </div>
</div>

<!-- MAIN-SECTION -->
<div class="container-fluid w-75">
    <div class="row justify-content-center align-items-center my-4">
        <div class="col-12">
            <p class="fs-3 fw-semibold text-center">Add New Student</p>
        </div>
        <div class="row mt-2">
            <form action="" method="post" class=" w-100">
                <div class="d-flex w-100">
                    <div class="col-7 ms-1 me-1">
                        <label for="student_name" class="fs-5 fw-semibold m-1">Student's Name: </label>
                        <input type="text" class="form-control p-2" name="student_name" placeholder="Student's Name" required>
                    </div>
                    <div class="col-5 me-2">
                        <label for="roll_no" class="fs-5 fw-semibold m-1">Student's Roll No: </label>
                        <input type="text" class="form-control p-2" name="roll_no" placeholder="Student's Roll No" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <label for="course" class="fs-5 fw-semibold m-1">Course: </label>
                        <input type="text" class="form-control p-2" name="course" placeholder="Course" required>
                    </div>
                    <div class="col-4">
                        <label for="branch" class="fs-5 fw-semibold m-1">Branch: </label>
                        <input type="text" class="form-control p-2" name="branch" placeholder="Branch" required>
                    </div>
                    <div class="col-4">
                        <label for="semester" class="fs-5 fw-semibold m-1">Semester: </label>
                        <input type="text" class="form-control p-2" name="semester" placeholder="Semester:" required>
                    </div>
                </div>

                <div class="row justify-content-center align-items-center mt-4">
                    <div class="col-2">
                    <input class="btn btn-primary w-100" type="submit" value="ADD STUDENT" name="add_student">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>

    <div class="row text-center">
        <p class="fs-4 fw-semibold my-4">Mark Attendance
            <?php echo date("d/m/Y"); ?>
        </p>
    </div>

    <!-- Table to Display Student's Info -->
    <form action="" method="post">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Roll No</th>
                    <th scope="col">Course</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Semester</th> 
                    <th scope="col">Attendance</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $students_query = "SELECT * FROM `student_registration` where `faculty_id` = '$id';";
            $students_result = mysqli_query($conn, $students_query);
            if (mysqli_num_rows($students_result) > 0) {
                $sr_no = 1;
                while ($student = mysqli_fetch_assoc($students_result))              
                {
                    $attendance_status = ($student['status'] == 'Present') ? 'checked' : '';
                    echo "<tr>";
                    echo "<th class='fs-5' scope='row'>{$sr_no}</th>";
                    echo "<td class='fs-5'>{$student['student_name']}</td>";
                    echo "<td class='fs-5'>{$student['roll_no']}</td>";
                    echo "<td class='fs-5'>{$student['course']}</td>";
                    echo "<td class='fs-5'>{$student['branch']}</td>";
                    echo "<td class='fs-5'>{$student['semester']}</td>";
                    echo "<td>
                            <input type='hidden' name='student_ids[]' value='{$student['student_id']}'>
                            <input class='form-check-input check_box' type='checkbox' name='statuses[]' value='{$student['student_id']}' $attendance_status>
                          </td>";
                    echo "</tr>";                        
                    $sr_no++;
                }
            } 
            else 
            {
                echo "<tr><td colspan='7' class='text-center'>No students found</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <div class="mb-2 justify-content-center align-items-center">
            <button class="btn btn-success" type="submit" name="submit_attendance">Submit Attendance</button>
        </div>
    </form>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-warning-subtle">
    
    <!-- PHP -->
    <?php
        include("./php/config.php");
        if (isset($_POST["submit"])) {
            $name = trim($_POST["name"]);
            $mobile_no = trim($_POST["mobile_no"]);
            $birth_date = trim($_POST["birth_date"]);
            $qualification = trim($_POST["qualification"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            $errors = [];

            // Validate email
            if (empty($email)) {
                $errors[] = "Email is required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            // Validate password
            if (empty($password)) {
                $errors[] = "Password is required.";
            } elseif (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            } elseif (!preg_match("/[0-9]/", $password)) {
                $errors[] = "Password must contain at least one number.";
            } elseif (!preg_match("/[a-z]/", $password)) {
                $errors[] = "Password must contain at least one lowercase letter.";
            } elseif (!preg_match("/[A-Z]/", $password)) {
                $errors[] = "Password must contain at least one uppercase letter.";
            } elseif (!preg_match("/[\W]/", $password)) {
                $errors[] = "Password must contain at least one special character.";
            }

            if (empty($errors)) {
                // Hash the password 
                // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Check for unique email
                $checkEmail = "SELECT * FROM `faculty_registration` WHERE `email` = '$email';";
                $result = $conn->query($checkEmail);

                if ($result->num_rows > 0) 
                {
                    echo "<script>alert('Email already exists.');</script>";
                } 
                else 
                {
                    $sql = "INSERT INTO `faculty_registration` (`name`, `mobile_no`, `birth_date`, `qualification`, `email`, `password`) VALUES ('$name', '$mobile_no', '$birth_date', '$qualification', '$email', '$password');";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>
                                alert('New record added successfully.');
                                window.location.href = 'index.php';
                              </script>";
                    } 
                    else 
                    {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            } 
            else 
            {
                // Display validation errors
                foreach ($errors as $error) {
                    echo "<script>alert('$error');</script>";
                }
            }
        }

        // Connection close
        $conn->close();

    ?> 

    <!-- Registration-form -->
    <div class="container-fluid shadow-lg w-50 mt-3 bg-light rounded-5">
        <p class="fw-bold fs-2 text-center p-4 border-bottom text-success">FACULTY REGISTRATION</p>

        <div class="row">
        <form action="" method="post">
            <label for="name" class="m-1">Name: </label>
            <input type="text" class="form-control mb-2 border-0 border-bottom bg-light p-2" name="name" placeholder="Name" required>

            <label for="mobile_no" class="m-1">Mobile No: </label>
            <input type="text" class="form-control mb-2 border-0 border-bottom bg-light p-2" name="mobile_no" placeholder="Mobile No" required>

            <label for="birth_date" class="m-1">Birth Date: </label>
            <input type="text" class="form-control mb-2 border-0 border-bottom bg-light p-2" name="birth_date" placeholder="YYYY-MM-DD" required>

            <label for="qualification" class="m-1">Qualification: </label>
            <input type="text" class="form-control mb-2 border-0 border-bottom bg-light p-2 " name="qualification" placeholder="Qualification" required>

            <label for="email" class="m-1">Email: </label>
            <input type="text" class="form-control mb-2 border-0 border-bottom bg-light" name="email" placeholder="Email" required>

            <label for="password" class="m-1">Password: </label>
            <input type="password" class="form-control mb-2 border-0 border-bottom bg-light" name="password" placeholder="Password" autocomplete="off" required>

            <div class="d-flex justify-content-center mb-3">
              <input class="btn btn-success mt-3" name="submit" type="submit" value="REGISTER">
            </div>
        </form>
        </div>
        
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
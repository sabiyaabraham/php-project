<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "marks";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn) {
        die("COULD NOT CONNECT! " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM student_info WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $roll = $_POST['roll'];
                $reg = $_POST['reg'];
                $phy = $_POST['phy'];
                $che = $_POST['che'];
                $maths = $_POST['maths'];
                $eng = $_POST['eng'];
                $psp = $_POST['psp'];

                $totalMarks = $phy + $che + $maths + $eng + $psp;

                $percentage = ($totalMarks / 500) * 100;
                $grade = '';

                if ($percentage >= 90) {
                    $grade = 's';
                } elseif ($percentage >= 80) {
                    $grade = 'A';
                } elseif ($percentage >= 70) {
                    $grade = 'B';
                } elseif ($percentage >= 60) {
                    $grade = 'C';
                } elseif ($percentage >= 50) {
                    $grade = 'D';
                } else {
                    $grade = 'F';
                }

                $updateSql = "UPDATE student_info SET name = '$name', roll = '$roll', reg = '$reg', phy = '$phy', che = '$che', maths = '$maths', eng = '$eng', psp = '$psp', total_marks = '$totalMarks', grade = '$grade' WHERE id = '$id'";

                if (mysqli_query($conn, $updateSql)) {
                    mysqli_close($conn);
                    header("Location: view.php");
                    exit();
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Student record not found.";
        }
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Record</title>
  <link rel="stylesheet" href="./index.css">
</head>
<body>
    
  <div class="box">
    <h1>Edit Student Record</h1>
    <form method="POST" action="">
        <label class="form-label" for="name">Name:</label>
        <input class="form-input" type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>

        <label class="form-label" for="roll">Roll Number:</label>
        <input class="form-input" type="text" id="roll" name="roll" value="<?php echo $row['roll']; ?>" required><br>

        <label class="form-label" for="reg">Registration Number:</label>
        <input class="form-input" type="text" id="reg" name="reg" value="<?php echo $row['reg']; ?>" required><br>

        <label class="form-label" for="phy">Physics:</label>
        <input class="form-input" type="text" id="phy" name="phy" value="<?php echo $row['phy']; ?>" required><br>

        <label class="form-label" for="che">Chemistry:</label>
        <input class="form-input" type="text" id="che" name="che" value="<?php echo $row['che']; ?>" required><br>

        <label class="form-label" for="maths">Mathematics:</label>
        <input class="form-input" type="text" id="maths" name="maths" value="<?php echo $row['maths']; ?>" required><br>

        <label class="form-label" for="eng">English:</label>
        <input class="form-input" type="text" id="eng" name="eng" value="<?php echo $row['eng']; ?>" required><br>

        <label class="form-label" for="psp">PSP:</label>
        <input class="form-input" type="text" id="psp" name="psp" value="<?php echo $row['psp']; ?>" required><br>

        <input class="form-submit" type="submit" value="Update">
    </form>
    </div>
</body>
</html>

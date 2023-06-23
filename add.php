<!DOCTYPE html>
<html>
<head>
    <title>Save Data</title>
  <link rel="stylesheet" href="./index.css">
</head>
<body>
    <div class="container">
        <?php
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
            $grade = 'A+';
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

        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "marks";
        $conn = mysqli_connect($host, $user, $pass, $dbname);

        if (!$conn) {
            die("COULD NOT CONNECT! " . mysqli_connect_error());
        }

        $sql = "INSERT INTO student_info (name, roll, reg, phy, che, maths, eng, psp, total_marks, grade)
                VALUES ('$name', '$roll', '$reg', '$phy', '$che', '$maths', '$eng', '$psp', '$totalMarks', '$grade')";

        if (mysqli_query($conn, $sql)) {
            echo "<h2>Data saved successfully.</h2>";
        } else {
            echo "<h2>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h2>";
        }

        mysqli_close($conn);
        ?>
        <br /> <br /> <br />
       <button id="backBtn" style="background-color: red;">BACK</button>
        <button id="homeBtn" style="background-color: green;">HOME</button>
    </div>
        
    <script>
    document.getElementById("backBtn").addEventListener("click", function() {
      window.location.href = "add.html";
    });

    document.getElementById("homeBtn").addEventListener("click", function() {
      window.location.href = "index.html";
    });
  </script>
</body>
</html>

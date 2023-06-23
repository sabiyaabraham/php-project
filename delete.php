<!DOCTYPE html>
<html>
<head>
    <title>Save Data</title>
  <link rel="stylesheet" href="./index.css">
</head>
<body>
    <div class="container">
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

            $sql = "DELETE FROM student_info WHERE id = '$id'";

            if (mysqli_query($conn, $sql)) {
                echo "<h2>Record deleted successfully.</h2>";
            } else {
                echo "<h2>Error deleting record: </h2> " . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
        ?>
        <br /> <br /> <br />
       <button id="backBtn" style="background-color: red;">BACK</button>
        <button id="homeBtn" style="background-color: green;">HOME</button>
    </div>
        
    <script>
    document.getElementById("backBtn").addEventListener("click", function() {
      window.location.href = "view.php";
    });

    document.getElementById("homeBtn").addEventListener("click", function() {
      window.location.href = "index.html";
    });
  </script>
</body>
</html>

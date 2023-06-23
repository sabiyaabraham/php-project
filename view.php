<!DOCTYPE html>
<html>
<head>
    <title>View Data</title>
    
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .delete-btn, .edit-btn {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }
        .edit-btn {
            background-color: orange;
        }
    </style>
    <script>
        function confirmDelete(name, id) {
            if (confirm("Do you want to delete the record for " + name + "?")) {
                window.location.href = "delete.php?id=" + id;
            }
        }

        function goToEdit(id) {
            window.location.href = "edit.php?id=" + id;
        }
    </script>
</head>
<body>
    <h1>Student Data</h1>

    <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "marks";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn) {
        die("COULD NOT CONNECT! " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM student_info";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Roll No</th>";
        echo "<th>Reg No</th>";
        echo "<th>Name</th>";
        echo "<th>Physics</th>";
        echo "<th>Chemistry</th>";
        echo "<th>Maths</th>";
        echo "<th>English</th>";
        echo "<th>PSP</th>";
        echo "<th>Total Marks</th>";
        echo "<th>Grade</th>";
        echo "<th>Actions</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['roll'] . "</td>";
            echo "<td>" . $row['reg'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['phy'] . "</td>";
            echo "<td>" . $row['che'] . "</td>";
            echo "<td>" . $row['maths'] . "</td>";
            echo "<td>" . $row['eng'] . "</td>";
            echo "<td>" . $row['psp'] . "</td>";
            echo "<td>" . $row['total_marks'] . "</td>";
            echo "<td>" . $row['grade'] . "</td>";
            echo "<td>";
            echo "<button class='delete-btn' onclick=\"confirmDelete('" . $row['name'] . "', " . $row['id'] . ")\">Delete</button>";
            echo "<button class='edit-btn' onclick=\"goToEdit(" . $row['id'] . ")\">Edit</button>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No data found.</p>";
    }

    mysqli_close($conn);
    ?>

    <br>
    <a href="index.html">Home</a>
</body>
</html>

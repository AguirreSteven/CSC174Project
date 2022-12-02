<html>
<style>
table {
  border-collapse: collapse;
}

tr, td {
  border: 1px solid black;
}
  
</style>



<body>
CSC 174 Project<br>
Welcome to the Sacramento County Library Website System!<br>
We now offer free online registration to our residents in the Sacramento area.<br>
To register, please insert your information below and pick up your library card at your nearest branch.<br>
Our new state-of-the-art technology allows you to register with just your name!<br>
Just enter your name and our AI software will do the rest.<br>


<form action="Library.php" method="POST"><br>

Full Name: <input type = "text" name = "Name" ><br><br>
<!-- DOB: <input type = "date" name = "DOB"><br><br>
Street Number: <input type = "text" name = "StreetNum" pattern = "[0-9]{0,10}" >&nbsp;10 Numerical Digits Max<br><br> 
Street Name: <input type = "text" name = "StreetName"><br><br>
City: <input type = "text" name = "City"><br><br>
Zip Code: <input type = "text" name = "ZipCode" pattern = "[0-9]{0,5}">&nbsp;5 Numerical Digits Max<br><br> -->

<input type = "submit" name = "submit">
</form>


</body>
</html>

<?php

//database access credentials
$servername = "ecs-pd-proj-db.ecs.csus.edu";
$database = "CSC174003";
$username = "CSC174003";
$password = "Csc134_907442822";

//connects to the MySQL server
$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection has failed" . $conn->connect_error);
} else{
    echo "SQL Connection Successful!<br>";
}


//when the submission button is clicked, pass user inputs into the database
if (isset($_POST['submit'])) {
    $UID = rand(0,99999);
    $mType = "Member";
    $Name = $_POST['Name'];
    $DOB = "1947-09-22";
    $StreetNum = "6000";
    $StreetName = "Jed Smith Dr";
    $City = "Sacramento";
    $ZipCode = 95819;

    $query = "INSERT INTO Member(UID, mType, DOB, Name, StreetNum, StreetName, City, ZipCode
    ) VALUES (
        '".$UID."',
        '".$mType."',
        '".$DOB."',
        '".$Name."',
        '".$StreetNum."',
        '".$StreetName."',
        '".$City."',
        '".$ZipCode."'
    );";

    if (!$result = mysqli_query($conn,$query)) {
        die('There was an error running the query [' . $conn->error . ']');
    } else {
        echo "\n\nRecord has been successfully added!";
    };

}



$query = "SELECT * FROM Member";
//MySQL Member Table
echo "<table>";
echo "<br>";
echo "<tr><td>". "Name" . "<td>" . "UID" . "<td>" . "mType" . "<td>" . "DOB". "<td>" ."StreetNum". "<td>" ."StreetName". "<td>" ."City". "<td>" ."ZipCode";
if ($result_set = mysqli_query($conn,$query)) {
    while ($row = $result_set->fetch_assoc()) {
        echo "<tr><td>". $row['Name'],'<td>'.$row['UID'],'<td>'.$row['mType'],'<td>'.$row['DOB'],'<td>'.$row['StreetNum'],'<td>'.$row['StreetName'],'<td>'.$row['City'],'<td>'.$row['ZipCode']."</td></tr>";
    }
    $result_set->close();
}
echo "</table>";

?>
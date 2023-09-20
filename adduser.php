
<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("location: login.php");
    exit();
}
$Write = "<?php $" . "card=''; " . "echo $" . "card;" . " ?>";
file_put_contents('UIDContainer.php', $Write);

$connection = mysqli_connect('localhost', 'root', '', 'atte');


$departments = [];
$departmentsQuery = "SELECT department_id, department_name FROM departments";
$departmentsResult = mysqli_query($connection, $departmentsQuery);
while ($department = mysqli_fetch_assoc($departmentsResult)) {
    $departments[] = $department;
}


$classes = [];
$classesQuery = "SELECT class_id, class_name FROM classes";
$classesResult = mysqli_query($connection, $classesQuery);
while ($class = mysqli_fetch_assoc($classesResult)) {
    $classes[] = $class;
}


mysqli_close($connection);

?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <?php include('includes/header.php') ?>
  <form class="grid rounded-md shadow-lg p-6 my-12 mx-auto bg-slate-800 max-w-md" action="includes/adduser.inc.php" method="post">
    <div class="grid grid-cols-2 gap-4">
      <div class="col-span-2 sm:col-span-1">
        <label class="text-white" for="card">Card Number</label>
        <input type="text" class="border outline-none focus:valid:border-green-500 my-2 p-2 rounded-md w-full" name="card" id="card" placeholder="Enter Student Card" >
      </div>

      <div class="col-span-2 sm:col-span-1">
        <label class="text-white" for="username">Full Name</label>
        <input type="text" class="border outline-none focus:valid:border-green-500 my-2 p-2 rounded-md w-full" name="username" id="fusername" placeholder="Enter Full Name" >
      </div>

      <div class="col-span-2 sm:col-span-1">
        <label class="text-white" for="email">Email</label>
        <input type="email" class="border outline-none focus:valid:border-green-500 my-2 p-2 rounded-md w-full" name="email" id="email" placeholder="Enter Email" >
      </div>

      <div class="col-span-2 sm:col-span-1">
        <label class="text-white" for="gender">Gender</label>
        <select class="border outline-none focus:valid:border-green-500 my-2 p-2 rounded-md w-full" name="gender" id="gender" >
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>

      <div class="col-span-2">
        <label class="text-white" for="department">Department</label>
        <select class="border outline-none focus:valid:border-green-500 my-2 p-2 rounded-md w-full" name="department" id="department" >
          <?php foreach ($departments as $department) : ?>
            <option value="<?php echo $department['department_id']; ?>"><?php echo $department['department_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-span-2">
        <label class="text-white" for="class">Class</label>
        <select class="border outline-none focus:valid:border-green-500 my-2 p-2 rounded-md w-full" name="class" id="class" >
          <?php foreach ($classes as $class) : ?>
            <option value="<?php echo $class['class_id']; ?>"><?php echo $class['class_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-span-2">
        <label class="text-white" for="dob">Date Of Birth</label>
        <input class="border outline-none focus:valid:border-green-500 my-2 p-2 rounded-md w-full" type="date" name="dob" id="dob">
      </div>
    </div>

    <div class="grid">
      <input type="submit" name="submit" class="border p-2 hover:bg-white hover:text-slate-800 font-bold cursor-pointer text-white capitalize rounded-md my-2 w-full" value="Submit">
    </div>
  </form>
     <?php
        if (isset($_GET['errors'])) {
    $errorMessages = explode(',', $_GET['errors']);
    foreach ($errorMessages as $error) {
        echo '<p class="text-center py-2 text-sky-500">' . htmlspecialchars($error) . '</p>';
    }
}
?>
</body>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    setInterval(function() {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var cardValue = xhr.responseText.trim();
          document.getElementById("card").value = cardValue;
        }
      };
      xhr.open("GET", "UIDContainer.php", true);
      xhr.send();
    }, 1000);
  });
</script>

</html>

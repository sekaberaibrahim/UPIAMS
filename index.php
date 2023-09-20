<?php
session_start();

if (isset($_SESSION['user_email'])) {
  header("location: dashboard.php");
  exit();
}
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    main {
      background-image: url('https://iamondemand.com/wp-content/uploads/2015/01/Screenshot_1011.png');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      height: 100dvh;

    }
  </style>
</head>

<body>
  <?php include('includes/header.php') ?>
  <main class="flex flex-col items-center justify-center">
    <h1 class="text-3xl text-white font-bold text-center">Welcome To ULK P.I Smart Attendance</h1>
    <button class="border px-4 py-2 my-2 bg-slate-900 text-white font-semibold rounded-xl">Get Started</button>
  </main>
</body>

</html>
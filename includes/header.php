<nav class="md:flex items-center py-2 px-6 bg-slate-800 text-white justify-between">
    <div class="flex justify-between">
        <div class="text-3xl">
        ULK POLYTECHNIC INSTITUTE
    </div>

   
    <button id="mobileMenuButton" class="md:hidden">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>
    </div>

    <ul id="menuItems" class="hidden md:flex text-center space-y-4 md:space-y-0 justify-center md:justify-between capitalize gap-x-6 items-center">
        <?php
        if (isset($_SESSION['user_email'])) {
            echo '<li><a href="dashboard.php">dashboard</a></li>';
            echo '<li><a href="attendanceTable.php">Attendance</a></li>';
            echo '<li><a href="manage_users.php">manage users</a></li>';
            echo '<li><a href="devices.php">devices</a></li>';
            echo '<li><a href="logout.php">logout</a></li>';
        } else {
            echo '<li><a href="index.php">home</a></li>';
            echo '<li><a href="about.php">about</a></li>';
            echo '<li><a href="login.php">login</a></li>';
        }
        ?>
    </ul>
</nav>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const mobileMenuButton = document.getElementById("mobileMenuButton");
        const menuItems = document.getElementById("menuItems");

        mobileMenuButton.addEventListener("click", function() {
            menuItems.classList.toggle("hidden");
        });
    });
</script>

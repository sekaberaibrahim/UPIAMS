<?php
// search_users.php

// Replace these with your actual database credentials
$db_host = 'localhost';
$db_name = 'Atte';
$db_user = 'root';
$db_pass = '';

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    try {
        
        $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

        
       $stmt = $dbh->prepare("SELECT u.*, d.department_name, c.class_name
                          FROM users u
                          JOIN departments d ON u.department_id = d.department_id
                          JOIN classes c ON u.class_id = c.class_id
                          WHERE u.email LIKE :query OR u.username LIKE :query
                          OR d.department_name LIKE :query OR c.class_name LIKE :query");
                          
    $queryParam = '%' . $query . '%';
    $stmt->bindParam(':query', $queryParam);
    $stmt->execute();

      
        $filteredUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

       
        $html = '';
        foreach ($filteredUsers as $user) {
            $html .= '<tr>';
            
            $html .= '<td class="border px-4 py-2">' . $user['user_id'] . '</td>';
            $html .= '<td class="border px-4 py-2">' . $user['card'] . '</td>';
            $html .= '<td class="border px-4 py-2">' . $user['email'] . '</td>';
            $html .= '<td class="border px-4 py-2">' . $user['username'] . '</td>';
            $html.='<td class="border px-4 py-2">'. $user['department_name'].'</td>';
            $html.='<td class="border px-4 py-2">'. $user['class_name'].'</td>';

            $html .= '<td class="border px-4 py-2">';
            $html .= '<a href="update_user.php?user_id=' . $user['user_id'] . '" class="text-blue-600 hover:underline">Update</a>';
            $html .= '<a href="delete_user.php?user_id=' . $user['user_id'] . '" class="text-red-600 hover:underline ml-2">Delete</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        
        echo $html;
    } catch (PDOException $e) {
       
        echo 'Database Error: Unable to perform search.';
    }
} else {
    echo 'Search query not provided.';
}
?>

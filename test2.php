<?php
include 'includes/book-config.inc.php';

?>
<html>
    <body>
        <?php
        
        try {
            echo '<hr>';
            $db = new EmployeeGateway($connection);
            echo '<h3>Sample Employee (id=11)</h3>';
            echo $result['EmployeeID'] . ' ' . $result['FirstName'] . ' ' . $result['LastName'] . ' ' . $result['Address'];
            
            $result = $db->getAll();
            echo '<h3>Sample Employees</h3>';
            foreach ($result as $row) {
                echo $row['EmployeeID'] . ' ' . $row['LastName'] . ', ';
            }
        }
        catch (Exception $e) {
            die ($e->getMessage());
        }
        
        ?>
    </body>
</html>
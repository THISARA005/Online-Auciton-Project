<?php
        include "db/config.php";

        $limit = 7;
        $page = "";
        if(isset($_POST["page_b"])){
            $page = $_POST["page_b"];
        }else{
            $page = 1;
        }

        $offset = ($page - 1) * $limit;

        $selectB = "SELECT `user_id` , `first_name` , `last_name` , `users`.`address_id` ,`address`.`address` , `contact` 
        FROM `users` LEFT JOIN `address` ON `users`.`address_id` = `address`.`address_id` WHERE user_type = 'buyer' ORDER BY `user_id` DESC LIMIT $offset , $limit";
        $resultB = mysqli_query($conn, $selectB);
        $boutput = '';
        if (mysqli_num_rows($resultB) > 0) {
           $boutput .= " <table>
                    <tr>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                    </tr>";
                    while ($rowb = mysqli_fetch_array($resultB)) {
                        $boutput .= "<tr>
                            <td>{$rowb['user_id']}</td>
                            <td> {$rowb['first_name']} {$rowb['last_name']}</td>
                            <td> {$rowb['contact']}</td>
                            <td> {$rowb['address']}</td>
                        </tr>";
                    } //end while loop 
                $boutput .= "</table>";

                $pageQuery = mysqli_query($conn, "SELECT `user_id` FROM users WHERE user_type = 'buyer'");
                $totalRecord = mysqli_num_rows($pageQuery);
                $totalPage = ceil($totalRecord / $limit);
                
                $boutput .= '<div id="pagination">';
                for($i=1; $i<=$totalPage; $i++){
                $i == $page ? $active = "active" : $active = '';
                $boutput .= "<a class='{$active}' href='' id='{$i}'>{$i}</a>";
            }
                $boutput .= '</div>';
                    echo $boutput;
                     } else{
                        echo 'No record Found';
                     }
?>
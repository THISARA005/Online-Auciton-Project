<?php
        include "db/config.php";

        $limit = 7;
        $page = "";
        if(isset($_POST["page_s"])){
            $page = $_POST["page_s"];
        }else{
            $page = 1;
        }

        $offset = ($page - 1) * $limit;

        $selectS = "SELECT `user_id` , `first_name` , `last_name` , `users`.`comp_id` ,`company`.`comp_nam`, `company`.`comp_reg` , `contact` 
        FROM `users` LEFT JOIN `company` ON `users`.`comp_id` = `company`.`comp_id` WHERE user_type = 'seller' ORDER BY `user_id` DESC LIMIT $offset , $limit";
        $soutput = '';
        $resultS = mysqli_query($conn, $selectS);
        if (mysqli_num_rows($resultS) > 0) {
           $soutput .= " <table>
                    <tr>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>Contact</th>
                        <th>Company Name</th>
                        <th>Company Reg</th>
                    </tr>";
                    while ($rows = mysqli_fetch_array($resultS)) {
                        $soutput .= "<tr>
                            <td>{$rows['user_id']}</td>
                            <td> {$rows['first_name']} {$rows['last_name']}</td>
                            <td> {$rows['contact']}</td>
                            <td> {$rows['comp_nam']}</td>
                            <td> {$rows['comp_reg']}</td>
                        </tr>";
                    } //end while loop 
                $soutput .= "</table>";

                $pageQuery = mysqli_query($conn, "SELECT `user_id` FROM users WHERE user_type = 'seller'");
                $totalRecord = mysqli_num_rows($pageQuery);
                $totalPage = ceil($totalRecord / $limit);
                
                $soutput .= '<div id="pagination">';
                for($i=1; $i<=$totalPage; $i++){
                $i == $page ? $active = "active" : $active = '';
                $soutput .= "<a class='{$active}' href='' id='{$i}'>{$i}</a>";
            }
                $soutput .= '</div>';
                    echo $soutput;
                     } else{
                        echo 'No record Found';
                     }
?>

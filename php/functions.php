<?php
    function prx($data){//to check if the value inserted prints or not
        echo'<pre>';
        print_r($data);
        die();
    }

    function get_safe_value($data){
        global $connect;//connect is in another file so while using and need the access then use "global"
        if($data){
            return mysqli_real_escape_string($connect, $data);
        }
    }

    function Redirect($link){
        ?>
        <script>
            window.location.href = "<?php echo $link ?>"
        </script>
        <?php
    }
    
    function checkUser(){
        if (isset($_SESSION["user_id"]) && $_SESSION['user_id'] != ''){}
    else{
        Redirect('login.php');
    }
    }

    function getDashboard($type) {
        global $connect;
//total income
//total expense
//total loans
//total savings
    // Initialize the sub_query variable to an empty string in case no filter is needed
    $sub_query = '';
    
    // Check the type of savings we need to query
    if ($type == 'total savings') {
        // No filter for total savings, return the sum of all amounts
        $sub_query = '';
    }
    $query = "SELECT SUM(amount) AS amount, SUM(goal) AS goal FROM savings $sub_query";
        $res = mysqli_query($connect, $query);
    
        // Check if the query executed successfully
        if ($res) {
            $row = mysqli_fetch_assoc($res);
            return [
                'amount' => $row['amount'] ? $row['amount'] : 0, // Return the amount or 0 if null
                'goal' => $row['goal'] ? $row['goal'] : 0  // Return the goal or 0 if null
            ];
        } else {
            return "Error: " . mysqli_error($connect); // Return error if query fails
        }
    }
    function getSavings($type) {
        global $connect;
    
        // Initialize the sub_query variable to an empty string in case no filter is needed
        $sub_query = '';
    
        // Check the type of savings we need to query
        if ($type == 'total savings') {
            // No filter for total savings, return the sum of all amounts
            $sub_query = '';
        }
        // If 'this month', filter for the current month
        else if ($type == 'this month') {
            $sub_query = "WHERE MONTH(created_at) = MONTH(CURRENT_DATE) AND YEAR(created_at) = YEAR(CURRENT_DATE)";
        }
        // If 'this year', filter for the current year
        else if ($type == 'this year') {
            $sub_query = "WHERE YEAR(created_at) = YEAR(CURRENT_DATE)";
        }
        // If 'monthly savings goal', filter for the current month and fetch the goal
        else if ($type == 'monthly savings goal') {
            $sub_query = "WHERE MONTH(created_at) = MONTH(CURRENT_DATE) AND YEAR(created_at) = YEAR(CURRENT_DATE)";
        }
        // If 'yearly savings goal', filter for the current year and fetch the goal
        else if ($type == 'yearly savings goal') {
            $sub_query = "WHERE YEAR(created_at) = YEAR(CURRENT_DATE)";
        }
    
        // Query to sum both the amount and goal for the specified type
        $query = "SELECT SUM(amount) AS amount, SUM(goal) AS goal FROM savings $sub_query";
        $res = mysqli_query($connect, $query);
    
        // Check if the query executed successfully
        if ($res) {
            $row = mysqli_fetch_assoc($res);
            return [
                'amount' => $row['amount'] ? $row['amount'] : 0, // Return the amount or 0 if null
                'goal' => $row['goal'] ? $row['goal'] : 0  // Return the goal or 0 if null
            ];
        } else {
            return "Error: " . mysqli_error($connect); // Return error if query fails
        }
    }

?>
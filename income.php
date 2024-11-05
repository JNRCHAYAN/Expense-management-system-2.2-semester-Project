
<?php
include 'dbcon.php';
if(isset($_POST['submit']))
{
    $date = $_POST['Date'];
    $category = $_POST['Category'];
    $amount = $_POST['Amount'];
    


   $setvalue_db ="INSERT INTO `income`(`DATE`, `category`,`amount`) 
   VALUES ('$amount','$category','$amount')";

    $res = mysqli_query($con ,  $setvalue_db);

    if($res)
    {
        ?>
        <script>
            alert('Data store');
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert('Not Store');
        </script>
        <?php
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Overview</title>
    <link rel="stylesheet" href="income.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="navigation">
            <h2>Menu</h2>
            <ul>
                <li><a href="#"><span class="icon">🏠</span> Home</a></li>
                <li><a href="#"><span class="icon">💰</span> Income</a></li>
                <li><a href="#"><span class="icon">💸</span> Expenses</a></li>
                <li><a href="#"><span class="icon">📊</span> Loan</a></li>
                <li><a href="#"><span class="icon">💼</span> Investment</a></li>
                <li><a href="#"><span class="icon">💵</span> Savings</a></li>
                <li><a href="#"><span class="icon">🔒</span> Profile</a></li>
                <li><a href="#"><span class="icon">⚙️</span> Settings</a></li>
            </ul>
        </div>

        <div class="main">
            <div class="head">
                <h1>INCOME</h1>
            </div>

            <div class="section">
                <h3>Overview</h3>
                <div style="display: flex; justify-content: center;">
                    <div class="box income">
                        <h3>Income</h3>
                        <p>200 tk</p>
                    </div>
                    <div class="box expense">
                        <h3>Expense</h3>
                        <p>100 tk</p>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3>My Income</h3>
                <div class="my-income-card">
                    <form action="" method="post">
                        <h3>Filter Options</h3>
                        <div class="filter-group">
                            <div>
                                <label for="start-date">Start Date</label>
                                <input type="date" id="start-date">
                            </div>
                            <div>
                                <label for="end-date">End Date</label>
                                <input type="date" id="end-date">
                            </div>
                            <div>
                                <label for="category-filter">Category</label>
                                <select id="category-filter">
                                    <option value="">All Categories</option>
                                    <option value="business">Business</option>
                                    <option value="interest">Interest</option>
                                    <option value="dividend">Dividend</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn" type="submit">Filter</button>
                    </form>

                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2024-01-01</td>
                                <td>Business</td>
                                <td>1000 tk</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2024-01-05</td>
                                <td>Interest Income</td>
                                <td>2000 tk</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2024-01-10</td>
                                <td>Dividend Income</td>
                                <td>1500 tk</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="section">
                <div class="section-item">
                    <h2>Add Income</h2>
                    <form action="" method="post">
                        <div>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" required>
                        </div>
                        <div>
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category" required>
                        </div>
                        <div>
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" id="amount" required>
                        </div>
                        <button class="btn" type="submit" name="submit">Add Income</button>
                    </form>
                </div>
                <div class="section-item">
                    <h2>Graph</h2>
                    <div style="height: 200px; background-color: #ecf0f1; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <p>Graph goes here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

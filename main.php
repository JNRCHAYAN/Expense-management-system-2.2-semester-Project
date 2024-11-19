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
                      <p><?php echo $set?>TK </p>
                    </div>
                    <div class="box expense">
                        <h3>Expense</h3>
                        <p><?php echo $sett ?> TK</p>
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
                                <input type="date" name="start" id="start-date">
                            </div>
                            <div>
                                <label for="end-date">End Date</label>
                                <input type="date" name="end" id="end-date">
                            </div>
                            <div>
                                <label for="category-filter">Category</label>
                                <input type="text" name="categoryy" id="end-date">
                            </div>
                        </div>
                        <button class="btn" type="submit" name="s">Filter</button>   
                    </form>

                   
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
                            <input type="number" name="amount" id="amount" required>
                        </div>
                        <button class="btn" type="submit" name="submit">Add Income</button>
                    </form>
                </div>
              
            </div>
        </div>
    </div>
</body>
</html>

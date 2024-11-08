<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <li><a href="#"><span class="icon">⚙</span> Settings</a></li>
            </ul>
        </div>


<div class="main">
            <div class="head">
                <h1>EXPENSE</h1>
            </div>

            <div class="section">
                <h3>Overview</h3>
                
                    <div class="box expense">
                        <h3>Income</h3>
                        <p>200 tk</p>
                    </div>
                    <div class="box expense">
                        <h3>Expense</h3>
                        <p>100 tk</p>
                    </div>
            
            </div>

            <div class="section1">
                <h3>My Expense</h3>
                <div class="my-income-card">
                    <form action="" method="post" >
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
                <thead><tr>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Amount</th>
                    
                    <th colspan="2">Operation</th>
                </tr>
            </thead>
            
               
            
            </table>
                </div>
            </div>

            <div class="section2">
                <div class="section-item">
                    <h2>Add Expense</h2>
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
                        <button class="btn" type="submit" name="submit">Add Expense</button>
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
<?php
require './order_functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>How It Works - Chez Session Bistro</title>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
   <header class="site-header">
      <div class="wrap header-flex">
         <div>
            <h1>Chez Session Bistro</h1>
            <p class="subtitle">How Session Persistence Works</p>
         </div>
         <nav class="site-nav">
            <a href="index.php">Order Form</a>
            <a href="about.php" class="active">How It Works</a>
            <a href="forget_order.php">Forget Order</a>
         </nav>
      </div>
   </header>

   <main class="wrap single-col">
      <section class="card">
         <h2>Request and Session Flow</h2>
         <p class="muted">PHP sessions keep order selections on the server inside <code>$_SESSION</code> while the browser only holds the session ID cookie, so choices survive moving from the form to the receipt and back without exposing raw order state in URL query strings.</p>
         <ol class="flow-list">
            <li><strong>index.php:</strong> Starts the session through <code>order_functions.php</code> and displays the dessert, drink, and drink size controls.</li>
            <li><strong>POST submit:</strong> Submitting the form sends the selected values to <code>process_order.php</code>.</li>
            <li><strong>process_order.php:</strong> Calls <code>order()</code> to save <code>$_SESSION['dessert']</code>, <code>$_SESSION['drink']</code>, and <code>$_SESSION['drinkSize']</code> (using <code>(not selected)</code> for skipped fields), stamps a <code>lastVisit</code> cookie, and prints the receipt.</li>
            <li><strong>Order Again!:</strong> Returning to <code>index.php</code> calls <code>dessertSelected()</code>, <code>drinkSelected()</code>, and <code>drinkSizeSelected()</code> to output <code>selected</code> or <code>checked</code> on matching controls.</li>
            <li><strong>forget_order.php:</strong> Unsets the three session keys, runs <code>session_destroy()</code>, and redirects back to a fresh <code>index.php</code> form.</li>
         </ol>
         <div class="btn-row">
            <a href="index.php" class="btn btn-primary">Back to Order Form</a>
         </div>
      </section>
   </main>

   <footer class="site-footer">
      <p>Chez Session Bistro - Flow Overview</p>
   </footer>
</body>
</html>

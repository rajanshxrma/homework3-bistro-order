<?php
require './order_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $visitStamp = date('F j, Y g:i a');
   setcookie('lastVisit', $visitStamp, time() + 86400, '/');
   $orderSummary = order();
} else {
   $orderSummary = receiptSummary();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Order Receipt - Chez Session Bistro</title>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
   <header class="site-header">
      <div class="wrap header-flex">
         <div>
            <h1>Chez Session Bistro</h1>
            <p class="subtitle">Kitchen Receipt</p>
         </div>
         <nav class="site-nav">
            <a href="index.php">Order Form</a>
            <a href="about.php">How It Works</a>
            <a href="forget_order.php">Forget Order</a>
         </nav>
      </div>
   </header>

   <main class="wrap single-col">
      <section class="card">
         <h2>Your Bistro Receipt</h2>
         <p class="muted">Your selections are stored on the server in your PHP session.</p>

         <div class="receipt-card">
            <?= $orderSummary; ?>
         </div>

         <div class="insight-card">
            <h3>Order Feedback</h3>
            <p><?= htmlspecialchars(completionMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="muted"><?= htmlspecialchars(pairingSuggestion(), ENT_QUOTES, 'UTF-8'); ?></p>
         </div>

         <div class="insight-card pricing-box">
            <div>
               <h3>Estimated Total</h3>
               <p class="price-big"><?= htmlspecialchars(formattedTotal(), ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div>
               <h3>Order Profile</h3>
               <p><?= htmlspecialchars(orderProfile(), ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <p class="muted full-span"><?= htmlspecialchars(pricingNote(), ENT_QUOTES, 'UTF-8'); ?></p>
         </div>

         <div class="btn-row">
            <a href="index.php" class="btn btn-primary">Order Again!</a>
            <a href="forget_order.php" class="btn btn-outline">Forget Order</a>
         </div>
      </section>
   </main>

   <footer class="site-footer">
      <p>Chez Session Bistro - Receipt Page</p>
   </footer>
</body>
</html>

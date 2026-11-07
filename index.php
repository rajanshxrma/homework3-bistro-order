<?php
require './order_functions.php';

$welcomeBack = 'First visit today? Pick your dessert, drink, and size below.';
if (!empty($_COOKIE['lastVisit'])) {
   $last = htmlspecialchars($_COOKIE['lastVisit'], ENT_QUOTES, 'UTF-8');
   $welcomeBack = "Welcome back! Your last order was placed on {$last}.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Chez Session Bistro - Order Form</title>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
   <header class="site-header">
      <div class="wrap header-flex">
         <div>
            <h1>Chez Session Bistro</h1>
            <p class="subtitle">Dessert &amp; Drink Counter</p>
         </div>
         <nav class="site-nav">
            <a href="index.php" class="active">Order Form</a>
            <a href="about.php">How It Works</a>
            <a href="forget_order.php">Forget Order</a>
         </nav>
      </div>
   </header>

   <main class="wrap main-grid">
      <section class="card">
         <h2>Build Your Order</h2>
         <p class="welcome-banner"><?= $welcomeBack ?></p>

         <form action="process_order.php" method="post" class="order-form">
            <div class="field-group">
               <label for="dessert">Dessert</label>
               <select id="dessert" name="dessert">
                  <option value="none">(choose a dessert)</option>
                  <option value="Cheesecake" <?= dessertSelected('Cheesecake'); ?>>Cheesecake ($4.25)</option>
                  <option value="Chocolate Cake" <?= dessertSelected('Chocolate Cake'); ?>>Chocolate Cake ($4.50)</option>
                  <option value="Carrot Cake" <?= dessertSelected('Carrot Cake'); ?>>Carrot Cake ($4.00)</option>
                  <option value="Tiramisu" <?= dessertSelected('Tiramisu'); ?>>Tiramisu ($4.75)</option>
               </select>
            </div>

            <div class="field-group">
               <label for="drink">Drink</label>
               <select id="drink" name="drink">
                  <option value="none">(choose a drink)</option>
                  <option value="Coffee" <?= drinkSelected('Coffee'); ?>>Coffee ($2.25)</option>
                  <option value="Hot Chocolate" <?= drinkSelected('Hot Chocolate'); ?>>Hot Chocolate ($2.75)</option>
                  <option value="Root Beer" <?= drinkSelected('Root Beer'); ?>>Root Beer ($2.50)</option>
                  <option value="Tea" <?= drinkSelected('Tea'); ?>>Tea ($2.00)</option>
                  <option value="Milk" <?= drinkSelected('Milk'); ?>>Milk ($1.75)</option>
               </select>
            </div>

            <fieldset class="field-group">
               <legend>Drink size</legend>
               <div class="radio-group">
                  <label class="radio-option">
                     <input type="radio" name="drinkSize" value="Small" <?= drinkSizeSelected('Small'); ?>>
                     Small (+$0.00)
                  </label>
                  <label class="radio-option">
                     <input type="radio" name="drinkSize" value="Medium" <?= drinkSizeSelected('Medium'); ?>>
                     Medium (+$0.60)
                  </label>
                  <label class="radio-option">
                     <input type="radio" name="drinkSize" value="Large" <?= drinkSizeSelected('Large'); ?>>
                     Large (+$1.15)
                  </label>
               </div>
            </fieldset>

            <div class="btn-row">
               <button type="submit" class="btn btn-primary">Submit Order</button>
               <a href="forget_order.php" class="btn btn-outline">Forget Order</a>
            </div>
         </form>
      </section>

      <aside class="side-stack">
         <div class="card">
            <h3>Saved Session Status</h3>
            <p><?= htmlspecialchars(completionMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="muted"><?= htmlspecialchars(pairingSuggestion(), ENT_QUOTES, 'UTF-8'); ?></p>
            <ul class="saved-list">
               <li>Dessert: <strong><?= htmlspecialchars(sessionValue('dessert'), ENT_QUOTES, 'UTF-8'); ?></strong></li>
               <li>Drink: <strong><?= htmlspecialchars(sessionValue('drink'), ENT_QUOTES, 'UTF-8'); ?></strong></li>
               <li>Drink size: <strong><?= htmlspecialchars(sessionValue('drinkSize'), ENT_QUOTES, 'UTF-8'); ?></strong></li>
            </ul>
         </div>

         <div class="card pricing-box">
            <div>
               <h3>Last Saved Estimate</h3>
               <p class="price-big"><?= htmlspecialchars(formattedTotal(), ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div>
               <h3>Order Profile</h3>
               <p><?= htmlspecialchars(orderProfile(), ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <p class="muted full-span"><?= htmlspecialchars(pricingNote(), ENT_QUOTES, 'UTF-8'); ?></p>
         </div>
      </aside>
   </main>

   <footer class="site-footer">
      <p>Chez Session Bistro - PHP Sessions &amp; Cookies Order App</p>
   </footer>
</body>
</html>

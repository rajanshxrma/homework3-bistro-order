<?php

date_default_timezone_set('America/New_York');
session_start();

function order(): string {
   $dessert = trim($_POST['dessert'] ?? 'none');
   $drink = trim($_POST['drink'] ?? 'none');
   $drinkSize = trim($_POST['drinkSize'] ?? '');

   $allowedDesserts = ['Cheesecake', 'Chocolate Cake', 'Carrot Cake', 'Tiramisu'];
   $allowedDrinks = ['Coffee', 'Hot Chocolate', 'Root Beer', 'Tea', 'Milk'];
   $allowedSizes = ['Small', 'Medium', 'Large'];

   $_SESSION['dessert'] = ($dessert !== '' && $dessert !== 'none' && in_array($dessert, $allowedDesserts, true))
      ? $dessert
      : '(not selected)';

   $_SESSION['drink'] = ($drink !== '' && $drink !== 'none' && in_array($drink, $allowedDrinks, true))
      ? $drink
      : '(not selected)';

   $_SESSION['drinkSize'] = ($drinkSize !== '' && in_array($drinkSize, $allowedSizes, true))
      ? $drinkSize
      : '(not selected)';

   return receiptSummary();
}

function sessionValue(string $key): string {
   return $_SESSION[$key] ?? '(not selected)';
}

function receiptSummary(): string {
   $d = htmlspecialchars(sessionValue('dessert'), ENT_QUOTES, 'UTF-8');
   $b = htmlspecialchars(sessionValue('drink'), ENT_QUOTES, 'UTF-8');
   $s = htmlspecialchars(sessionValue('drinkSize'), ENT_QUOTES, 'UTF-8');

   return "Dessert: {$d}<br>Drink: {$b}<br>Drink size: {$s}";
}

function completedChoiceCount(): int {
   $count = 0;
   foreach (['dessert', 'drink', 'drinkSize'] as $key) {
      if (sessionValue($key) !== '(not selected)') {
         $count++;
      }
   }
   return $count;
}

function completionMessage(): string {
   $count = completedChoiceCount();

   if ($count === 3) {
      return 'All 3 items are selected for this order.';
   }

   if ($count === 0) {
      return 'Pick a dessert, a drink, and a drink size to build your order.';
   }

   return "Saved {$count} of 3 order choices so far.";
}

function pairingSuggestion(): string {
   $dessert = sessionValue('dessert');
   $drink = sessionValue('drink');

   if ($dessert === '(not selected)' || $drink === '(not selected)') {
      return 'Choose both a dessert and a drink to see a pairing note.';
   }

   if ($dessert === 'Cheesecake' && $drink === 'Coffee') {
      return 'Pairing note: Cheesecake with coffee is our classic bistro combo.';
   }

   if ($dessert === 'Chocolate Cake' && $drink === 'Milk') {
      return 'Pairing note: Chocolate cake and cold milk balance out the rich cocoa.';
   }

   if ($dessert === 'Tiramisu' && $drink === 'Coffee') {
      return 'Pairing note: Tiramisu and coffee double up on the espresso flavor.';
   }

   if ($dessert === 'Carrot Cake' && $drink === 'Tea') {
      return 'Pairing note: Carrot cake with hot tea makes a light afternoon break.';
   }

   return "Pairing note: {$dessert} paired with {$drink}.";
}

function dessertPrice(): float {
   $prices = [
      'Cheesecake' => 4.25,
      'Chocolate Cake' => 4.50,
      'Carrot Cake' => 4.00,
      'Tiramisu' => 4.75,
   ];

   return $prices[sessionValue('dessert')] ?? 0.0;
}

function drinkPrice(): float {
   $basePrices = [
      'Coffee' => 2.25,
      'Hot Chocolate' => 2.75,
      'Root Beer' => 2.50,
      'Tea' => 2.00,
      'Milk' => 1.75,
   ];
   $sizeUpcharge = [
      'Small' => 0.00,
      'Medium' => 0.60,
      'Large' => 1.15,
   ];

   $drink = sessionValue('drink');
   $drinkSize = sessionValue('drinkSize');

   if (!isset($basePrices[$drink])) {
      return 0.0;
   }

   return $basePrices[$drink] + ($sizeUpcharge[$drinkSize] ?? 0.0);
}

function estimatedTotal(): float {
   return dessertPrice() + drinkPrice();
}

function formattedTotal(): string {
   return '$' . number_format(estimatedTotal(), 2);
}

function pricingNote(): string {
   if (sessionValue('drink') !== '(not selected)' && sessionValue('drinkSize') === '(not selected)') {
      return 'Select a drink size to include any size upcharge.';
   }

   if (completedChoiceCount() === 0) {
      return 'No items saved in the current session yet.';
   }

   return 'Estimated from your saved dessert, drink, and drink size.';
}

function orderProfile(): string {
   $total = estimatedTotal();

   if ($total >= 6.50) {
      return 'Full cafe combo';
   }

   if ($total >= 4.00) {
      return 'Balanced dessert break';
   }

   if ($total > 0) {
      return 'Light snack order';
   }

   return 'No selections yet';
}

function dessertSelected(string $dessert): string {
   return ($_SESSION['dessert'] ?? '') === $dessert ? 'selected' : '';
}

function drinkSelected(string $drink): string {
   return ($_SESSION['drink'] ?? '') === $drink ? 'selected' : '';
}

function drinkSizeSelected(string $drinkSize): string {
   return ($_SESSION['drinkSize'] ?? '') === $drinkSize ? 'checked' : '';
}

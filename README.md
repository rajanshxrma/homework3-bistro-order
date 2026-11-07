# homework3-bistro-order

php bistro order form using server-side sessions and a visit cookie.

## files
- `index.php` - order form with dessert, drink, and drink size restore helpers
- `process_order.php` - saves order selections into `$_SESSION` and shows the receipt
- `order_functions.php` - `session_start()`, `order()`, fallback handling, pricing, and restore helpers
- `forget_order.php` - clears session values, calls `session_destroy()`, and redirects back to `index.php`
- `about.php` - short overview of the session request loop
- `styles.css` - responsive stylesheet for the form and receipt pages

session()->put("cart.$productId", [
'quantity' => 2,
'selected_variants' => [
'Color' => 'Red',
'Size' => 'M',
],
]);

[//]: # (TODO json_encode -> normalize_variants)
CartItem::create([
'user_id' => $user->id,
'product_id' => $entry['product_id'],
'quantity' => $entry['quantity'],
'selected_variants' => json_decode($normalizedVariants, true), // store as array
]);

[//]: # (TODO Jozef might have to run command:)
composer dump-autoload

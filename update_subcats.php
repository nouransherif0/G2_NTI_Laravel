<?php
$mapping = [
    "Hot Coffee" => "image/coffee/hot coffee category .jpg",
    "Iced Coffee" => "image/coffee/iced coffee category .jpg",
    "Single Fruit Juice" => "image/fresh juice/fresh juice.jpg",
    "Blended Juice" => "image/fresh juice/mixfruite.jpg",
    "Hot Matcha" => "image/matcha/hot matcha.jpg",
    "Iced Matcha" => "image/matcha/iced matcha .jpg",
    "Mojito" => "image/refreshers/mojito.jpg",
    "Iced Tea" => "image/refreshers/iced tea.jpg",
    "Fruit Smoothies" => "image/smoothies/fruit smooth.jpg",
    "Dessert Smoothies" => "image/smoothies/dessert smoothie.jpg",
    "Mugs & Cups" => "image/shop/cups.jpg",
    "Coffee & Matcha Powders" => "image/shop/matcha powder.jpg"
];

foreach ($mapping as $name => $image) {
    App\Models\Subcategory::where('name', $name)->update(['image' => $image]);
}
echo "Subcategories images updated successfully!\n";

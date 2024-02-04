 <?php
include _DIR_ . '/../includes/db_connection.php'; // Use _DIR_ to get the current directory
include _DIR_ . '/../includes/product_functions.php';
//  Insert products for Medication category
addProduct('Pain Relief', 'Medication', 5.99, 50, 1);
addProduct('Cold and Cough Remedies', 'Medication', 8.49, 30, 1);
addProduct('Allergy Medication', 'Medication', 12.99, 20, 1);
addProduct('Prescription Medication', 'Medication', 0.00, 10, 1); // Assuming prescription medications have no price

//  Insert products for Medical Supplies category
addProduct('First Aid Kit', 'Medical Supplies', 15.99, 25, 2);
addProduct('Bandage and Dressing', 'Medical Supplies', 7.49, 40, 2);
addProduct('Thermometer', 'Medical Supplies', 12.99, 15, 2);
addProduct('Health Monitors', 'Medical Supplies', 29.99, 10, 2);

//  Insert products for Health Essential category
addProduct('Vitamins and Supplements', 'Health Essential', 9.99, 50, 3);
addProduct('Personal Care Products', 'Health Essential', 6.49, 3);
addProduct('Skin Care Items', 'Health Essential', 14.99, 20, 3);
addProduct('Oral Health Products', 'Health Essential', 4.99, 40, 3);

//  Insert products for Specialty Products category
addProduct('Diabetes Supplies', 'Specialty Products', 19.99, 15, 4);
addProduct('Baby Care Essentials', 'Specialty Products', 22.49, 20, 4);
addProduct('Orthopedic Support', 'Specialty Products', 29.99, 10, 4);
addProduct('Elderly Care Products', 'Specialty Products', 17.99, 25, 4);

// HTML Head Section
echo "<html>";
echo "<head>";
echo "<title>Medical Store</title>";
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";

echo "</head>";

// HTML Body Section
echo "<body>"

if($productAdded){ 
    echo "<p>Product added successfully!</p>";
}
else{ 
    echo "<p>Failed to add the product.</p>";
}
// Display a message if products were added
//echo "<p>Products added successfully!</p>";

// Display products for each category
//echo "<h2>Product List:</h2>";

$categories = ['Medication', 'Medical Supplies', 'Health Essential', 'Specialty Products'];

foreach ($categories as $category) {
    $categoryProducts = getProductsByCategory($category);

    echo "<h3>$category</h3>";
    echo "<ul>";
    foreach ($categoryProducts as $product) {
        echo "<li>{$product['name']} - {$product['price']} - {$product['quantity_in_stock']}</li>";
    }
    echo "</ul>";
}
// AJAX script to load products asynchronously
echo "<script>";
echo "
    $(document).ready(function() {
        // Example: Load products for all categories
        $.each(['Medication', 'Medical Supplies', 'Health Essential', 'Specialty Products'], function(index, category) {
            $.ajax({
                url: 'ajax_load_products.php',
                type: 'POST',
                data: { category: category },
                success: function(response) {
                    $('#category-' + category).append(response);
                }
            });
        });
    })";

echo "</script>";

// HTML Body Closing Tag
echo "</body>";

// HTML Closing Tag
echo "</html>";
?>
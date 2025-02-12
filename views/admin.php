<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Card: Số lượng người bán -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-700">Số lượng người bán</h2>
                <p class="text-4xl font-bold text-blue-600 mt-4"><?php echo($seller['seller']); ?></p>
            </div>
            
            <!-- Card: Số lượng người mua -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-700">Số lượng người mua</h2>
                <p class="text-4xl font-bold text-green-600 mt-4"><?php echo $user['buyer']; ?></p>
            </div>
            
            <!-- Card: Tổng số lượng đơn hàng -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-700">Tổng số lượng đơn hàng</h2>
                <p class="text-4xl font-bold text-red-600 mt-4"><?php echo $order['total_orders']; ?></p>
            </div>
        </div>
    </div>
</body>
</html>

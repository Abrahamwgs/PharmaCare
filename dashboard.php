<?php
include 'conn.php';
$med_count = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM medicines"))[0];
$expiring_soon = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM medicines WHERE expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)"))[0];
$low_stock = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM medicines WHERE quantity < 10"))[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .sidebar {
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-blue-800 text-white w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0">
            <div class="flex items-center space-x-2 px-4">
                <i class="fas fa-prescription-bottle-alt text-2xl"></i>
                <span class="text-2xl font-extrabold">PharmaCare</span>
            </div>
            <nav>
                <a href="dashboard.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                <a href="med_list.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-pills mr-2"></i>Medicines
                </a>
                <a href="form.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-plus-circle mr-2"></i>Add Medicine
                </a>
            </nav>
        </div>

        <div class="flex-1 ml-64 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Welcome, Admin</span>
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="card bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Total Medicines</p>
                            <h3 class="text-3xl font-bold"><?= $med_count ?></h3>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-pills text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="card bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Expiring Soon</p>
                            <h3 class="text-3xl font-bold"><?= $expiring_soon ?></h3>
                        </div>
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <i class="fas fa-exclamation-triangle text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="card bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Low Stock</p>
                            <h3 class="text-3xl font-bold"><?= $low_stock ?></h3>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-box-open text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Medicines</h2>
                    <a href="med_list.php" class="text-blue-600 hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            $recent_meds = mysqli_query($con, "SELECT * FROM medicines ORDER BY med_id DESC LIMIT 5");
                            while($row = mysqli_fetch_array($recent_meds)): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $row['name'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap <?= $row['quantity'] < 10 ? 'text-red-600 font-bold' : '' ?>">
                                    <?= $row['quantity'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">$<?= number_format($row['price'], 2) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap <?= strtotime($row['expiry_date']) < strtotime('+30 days') ? 'text-red-600 font-bold' : '' ?>">
                                    <?= date('d/m/Y', strtotime($row['expiry_date'])) ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.querySelector('.menu-btn');
            const sidebar = document.querySelector('.sidebar');
            
            if(menuBtn) {
                menuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>
<?php mysqli_close($con); ?>
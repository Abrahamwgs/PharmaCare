<?php
include 'conn.php';

$qry = "SELECT * FROM medicines ORDER BY expiry_date ASC";
$res = mysqli_query($con, $qry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
        <div class="sidebar bg-blue-800 text-white w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0">
            <div class="flex items-center space-x-2 px-4">
                <i class="fas fa-prescription-bottle-alt text-2xl"></i>
                <span class="text-2xl font-extrabold">PharmaCare</span>
            </div>
            <nav>
                <a href="dashboard.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                <a href="med_list.php" class="block py-2.5 px-4 rounded transition duration-200 bg-blue-700 text-white">
                    <i class="fas fa-pills mr-2"></i>Medicines
                </a>
                <a href="form.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-plus-circle mr-2"></i>Add Medicine
                </a>
            </nav>
        </div>

        <div class="flex-1 ml-64 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Medicine List</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Welcome, Admin</span>
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <table border="1" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; margin: 20px 0;">
                    <thead>
                        <tr style="background-color: #4CAF50; color: white;">
                            <th style="padding: 12px; text-align: left;">Medicine ID</th>
                            <th style="padding: 12px; text-align: left;">Name</th>
                            <th style="padding: 12px; text-align: left;">Quantity</th>
                            <th style="padding: 12px; text-align: left;">Price</th>
                            <th style="padding: 12px; text-align: left;">Category</th>
                            <th style="padding: 12px; text-align: left;">Expiry Date</th>
                            <th style="padding: 12px; text-align: left;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($res)): ?>
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;"><?= $row['med_id'] ?></td>
                            <td style="padding: 10px;"><?= $row['name'] ?></td>
                            <td style="padding: 10px; text-align: center;"><?= $row['quantity'] ?></td>
                            <td style="padding: 10px; text-align: right;"><?= number_format($row['price'], 2) ?></td>
                            <td style="padding: 10px;"><?= $row['category'] ?></td>
                            <td style="padding: 10px;"><?= date('d/m/Y', strtotime($row['expiry_date'])) ?></td>
                            <td style="padding: 10px;">
                                <a href='edit.php?id=<?= $row['med_id'] ?>' style="color: #2196F3; text-decoration: none;">Edit</a> | 
                                <a href='delete.php?id=<?= $row['med_id'] ?>' style="color: #f44336; text-decoration: none;" onclick='return confirm("Delete this medicine?")'>Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
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

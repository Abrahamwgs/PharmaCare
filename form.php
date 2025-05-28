<!DOCTYPE html>
<html>
<head>
    <title>Add New Med</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 450px;
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 28px;
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #3498db;
            margin: 10px auto;
            border-radius: 2px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"],
        select,
        input[type="date"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        input[type="date"]:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        input[type="submit"] {
            background: linear-gradient(to right, #3498db, #2c3e50);
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        input[type="submit"]:hover {
            background: linear-gradient(to right, #2980b9, #1a252f);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            <div class="container">
                <h1>Pharmacy Inventory</h1>
                <form action="post.php" method="POST">
                    <?php 
                    if(isset($_GET['success']) && $_GET['success'] == '1') {
                        echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">Medicine added successfully.</span>
                            </div>';
                    }
                    ?>
                    <label for="med_id">Medicine ID:</label><br>
                    <input type="text" id="med_id" name="med_id" required><br><br>
                    <label for="name">Medicine Name:</label><br>
                    <input type="text" id="name" name="name" required><br><br>
                    <label for="quantity">Quantity:</label><br>
                    <input type="number" id="quantity" name="quantity" min="1" required><br><br>
                    <label for="price">Price (per unit):</label><br>
                    <input type="number" id="price" name="price" min="0.01" step="0.01" required><br><br>
                    <label for="category">Category:</label><br>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="Antibiotic">Antibiotic</option>
                        <option value="Painkiller">Painkiller</option>
                        <option value="Antihistamine">Antihistamine</option>
                        <option value="Antacid">Antacid</option>
                        <option value="Other">Other</option>
                    </select><br><br>
                    <label for="expiry">Expiry Date:</label><br>
                    <input type="date" id="expiry" name="expiry" required><br><br>
                    <input type="submit" value="Add to Inventory" name="reg">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
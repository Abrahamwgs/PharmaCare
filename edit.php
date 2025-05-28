<?php
include 'conn.php';

$id = $_GET['id'];
$qry = "SELECT * FROM medicines WHERE med_id = $id";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_array($res);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $expiry = $_POST['expiry'];
    
    $update_qry = "UPDATE medicines SET name='$name', quantity='$quantity', price='$price', 
                  category='$category', expiry_date='$expiry' WHERE med_id=$id";
    
    if (mysqli_query($con, $update_qry)) {
        header("Location: med_list.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medicine</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            color: #2b6cb0;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .form-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
        }
        .form-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        }
        .btn-primary {
            background-color: #4299e1;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #3182ce;
        }
        .btn-secondary {
            background-color: #e2e8f0;
            color: #4a5568;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: background-color 0.2s;
        }
        .btn-secondary:hover {
            background-color: #cbd5e0;
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
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-chart-bar mr-2"></i>Reports
                </a>
            </nav>
        </div>

        <div class="flex-1 ml-64 p-8">
            <div class="form-container">
                <form method="post">
                    <h2><i class="fas fa-pills mr-2"></i>Edit Medicine</h2>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" value="<?= $row['name'] ?>" class="form-input" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Quantity</label>
                        <input type="number" name="quantity" value="<?= $row['quantity'] ?>" class="form-input" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Price</label>
                        <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" class="form-input" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Category</label>
                        <select name="category" class="form-input" required>
                            <option value="Antibiotic" <?= $row['category'] == 'Antibiotic' ? 'selected' : '' ?>>Antibiotic</option>
                            <option value="Painkiller" <?= $row['category'] == 'Painkiller' ? 'selected' : '' ?>>Painkiller</option>
                            <option value="Antihistamine" <?= $row['category'] == 'Antihistamine' ? 'selected' : '' ?>>Antihistamine</option>
                            <option value="Antacid" <?= $row['category'] == 'Antacid' ? 'selected' : '' ?>>Antacid</option>
                            <option value="Other" <?= $row['category'] == 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Expiry Date</label>
                        <input type="date" name="expiry" value="<?= $row['expiry_date'] ?>" class="form-input" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i>Update
                        </button>
                        <a href="med_list.php" class="btn-secondary">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php mysqli_close($con); ?>
</body>
</html>
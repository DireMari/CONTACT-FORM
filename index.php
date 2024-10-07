<?php
session_start(); 

if (!isset($_SESSION['submissions'])) {
    $_SESSION['submissions'] = [];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
      
        $firstName = htmlspecialchars(trim($_POST['first_name']));
        $lastName = htmlspecialchars(trim($_POST['last_name']));
        $age = htmlspecialchars(trim($_POST['age']));
        $contact = htmlspecialchars(trim($_POST['contact']));
        $address = htmlspecialchars(trim($_POST['address']));

     
        $_SESSION['submissions'][] = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'age' => $age,
            'contact' => $contact,
            'address' => $address,
        ];
    } elseif (isset($_POST['reset'])) {
        
    } elseif (isset($_POST['delete'])) {
        
        $index = (int)$_POST['delete_index'];
        if (isset($_SESSION['submissions'][$index])) {
            unset($_SESSION['submissions'][$index]);
          
            $_SESSION['submissions'] = array_values($_SESSION['submissions']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT FORM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFC0CB;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: #FFF5EE;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color:#383838;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .reset-btn {
            background-color: ;
        }
        .reset-btn:hover {
            background-color: #ec971f;
        }
        .submission {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>CONTACT FORM</h2>
        <form action="" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            
            <label for="contact ">Contact Number:</label>
            <input type="text" id="contact" name="contact" required>
            
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
            
            <button type="submit" name="submit">Submit</button>
            <button type="submit" name="reset" class="reset-btn">Reset Fields</button>
        </form>

        <?php if (!empty($_SESSION['submissions'])): ?>
            <div class="submission">
                <h3>Submitted Data</h3>
                <?php foreach ($_SESSION['submissions'] as $index => $submission): ?>
                    <p>
                        <strong>Submission <?php echo $index + 1; ?>:</strong><br>
                        <strong>First Name:</strong> <?php echo $submission['first_name']; ?><br>
                        <strong>Last Name:</strong> <?php echo $submission['last_name']; ?><br>
                        <strong>Age:</strong> <?php echo $submission['age']; ?><br>
                        <strong>Contact:</strong> <?php echo $submission['contact']; ?><br>
                        <strong>Address:</strong> <?php echo $submission['address']; ?><br>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </p>
                    <hr>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>


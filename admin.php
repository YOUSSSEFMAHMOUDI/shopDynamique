<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Add Product</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
    include('nav.php');
    ?>
  <div class="container">
    <h1>Add Product</h1>
    <form action="./add_product.php" method="POST">
      <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" id="price" name="price" required step="0.01">
      </div>
      <div class="form-group">
        <label for="image">Image URL:</label>
        <input type="text" class="form-control" id="image" name="image" required>
      </div>
      
      <button type="submit" class="btn btn-primary">Add Product</button>
      
    </form>
  </div>

   
  
  

  

</body>
</html>

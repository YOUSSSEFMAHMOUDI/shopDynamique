
<?php
// Connexion à la base de données
include_once('db.php');

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}
if (!isset($_GET['id'])) {
    // Récupérer la liste des produits depuis la base de données
    $sql = "SELECT id, name  FROM products";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Choisissez le produit à modifier :</h3>";
        echo '<ul class="list-group">';
        while ($row = $result->fetch_assoc()) {
            echo "<li class= \"list-group-item\"><a class=\"pre\" href='modify_product.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></li><br>";
        }
        echo '</ul>';
    } else {
        echo "Aucun produit trouvé.";
    }
}
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Récupérer les données du produit

        $name = $row['name'];
        $price = $row['price'];
        $image = $row['img'];


        // Display the form
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                h3 {
                    font-family: Verdana, Geneva, Tahoma, sans-serif;
                    font-size: x-large;
                    text-align: center;
                }

                .pre {
                    color: red;
                    cursor: pointer;
                    
                }

                a {
                    font-family: Verdana, Geneva, Tahoma, sans-serif;
                    text-decoration: none;
                }
                .form{
                    margin-left: 325px;
                    margin-top: 50px;
                    
                }
                
                
            </style>
        </head>

        <body>
        <?php
    include('nav.php');
    ?>
        
            <form action="modify_product.php" method="post">
            <h3>Choisissez le produit à modifier</h3>
                <div class="form">
                    
                <input type="hidden" name="id" value="<?php echo $productId; ?>"> <br>
                <input type="text" name="name" value="<?php echo $name; ?>" style="border-radius: 12px; height: 40px ;border: 1px solid; width: 350px;"> <br> <br>  <br>
                <input type="text" name="price" value="<?php echo $price; ?>" style="border-radius: 12px; height: 40px; border: 1px solid; width: 350px;"><br> <br>  <br>
                <input type="text" name="image" value="<?php echo $image; ?>" style="border-radius: 12px; height: 40px ;border: 1px solid;width: 350px;"><br> <br> <br> 
                <input type="submit" value="Modifier" style="border-radius: 18px;margin-left: 100px; width: 120px;  height: 40px; border: 1px solid;
                background-color: blue; border: 1px solid blue; color:antiquewhite"><br>
                </div>
            </form>
            
        </body>

        </html>
<?php
    } else {
        echo "Aucun produit trouvé avec l'ID : " . $productId;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<?php
// Récupération des valeurs du formulaire
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Requête de mise à jour du produit
    $query = "UPDATE products SET name = '$name', price = '$price', img = '$image' WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // La mise à jour a réussi
        // Rediriger vers la page qui affiche la liste des produits ou afficher un message de succès
        header('Location: index.php');
        exit;
    } else {
        // La mise à jour a échoué
        // Gérer l'erreur ou afficher un message d'erreur
        echo "Erreur lors de la mise à jour du produit.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
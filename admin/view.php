<?php
    require 'database.php';

    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']); 
    }

    $db = Database::connect();
    $pdostatement = $db->prepare('SELECT items.id, items.name, items.description, items.img, items.price, categories.name AS category 
    FROM items LEFT JOIN categories ON items.category=categories.id
    WHERE items.id = ?');
    $pdostatement->execute(array($id));
    $item = $pdostatement->fetch();
    Database::disconnect();

    function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bestie Burger</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" ></script>
        <link href="http://fonts.googleapis.com/css?family=Bebas Neue" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-grain"></span> Bestie Burger <span class="glyphicon glyphicon-grain"></span></h1>
        <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Check un item</strong></h1>
                    <br>
                    <form>
                        <div class="form-group">
                            <label><u>Nom: </u></label><?php echo ' ' . $item['name'];?>
                        </div>
                        <div class="form-group">
                            <label><u>Description: </u></label><?php echo ' ' . $item['description'];?>
                        </div>
                        <div class="form-group">
                            <label><u>Prix: </u></label><?php echo ' ' . number_format((float)$item['price'],2,'.','') . ' €';?>
                        </div>
                        <div class="form-group">
                            <label><u>Categorie: </u></label><?php echo ' ' . $item['category'];?>
                        </div>
                        <div class="form-group">
                            <label><u>Apparence: </u></label><?php echo ' ' . $item['img'];?>
                        </div>
                    </form>
                    <div class="form-actions">
                            <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 site">
                    <div class="thumbnail"> 
                        <img src="<?php echo '../img/'. $item['img'];?>" alt="">
                        <div class="price"><?php echo number_format((float)$item['price'], 2, '.', '');?></div>
                        <div class="caption">
                            <h4><?php echo $item['name'];?></h4>
                            <p><?php echo $item['description'];?></p>
                            <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp Prêt à déguster ?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
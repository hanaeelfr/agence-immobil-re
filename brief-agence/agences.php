<?php
    $servername = "localhost";
    $username = "root";
    $password = "";



    try
        {
            $conn = new PDO("mysql:host=$servername;dbname=agence", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        }
        catch(PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage();
        }

        


                    if(isset($_POST['submit']))
                        {
                        $Titre = $_POST["Titre"];
                        $Description = $_POST["Description"];
                        $Adresse = $_POST["Adresse"];
                        $Superficie = $_POST["Superficie"];
                        $Prix = $_POST["Prix"];
                        $Type = $_POST["Type"];
                        $ImgName = $_FILES['Img']['name'];

                        move_uploaded_file($_FILES['Img']['tmp_name'], "./".$ImgName);


                    $Ajouter = $conn->prepare("INSERT INTO `agence` (`Titre`, `Img`, `Dscr`, `Superficie`, `Adresse`, `Montant`, `Type`) VALUES('$Titre', '$ImgName', '$Description', '$Superficie','$Adresse', '$Prix', '$Type')");

                    echo $ImgName;
                    echo $Titre;

                    $Ajouter->execute();
                        }

                        if(isset($_POST['Modifier']))
                            {
                                $ID = $_POST["ID"];
                                $Titre = $_POST["ModifierTitre"];
                                $Description = $_POST["ModifierDescription"];
                                $Adresse = $_POST["ModifierAdresse"];
                                $Superficie = $_POST["ModifierSuperficie"];
                                $Prix = $_POST["ModifierPrix"];
                                $Type = $_POST["ModifierType"];
                                $ImgName = $_FILES['ModifierImg']['name'];

                                move_uploaded_file($_FILES['ModifierImg']['tmp_name'], "./".$ImgName);

                                $Modifier = $conn->prepare("UPDATE `agence` SET Titre = '$Titre', Img = '$ImgName', Dscr = '$Description', Superficie = '$Superficie', Adresse = '$Adresse', Montant = '$Prix', Type = '$Type' WHERE ID = '$ID'");

                                $Modifier->execute();
                            }


                        if(isset($_POST['Supprimer']))
                            {
                                $ID = $_POST["ID"];

                                $Supprimer = $conn->prepare("DELETE FROM `agence` WHERE ID = '$ID'");
                                $Supprimer->execute();
                            }



           

            $sth = $conn->prepare("SELECT * FROM `agence`");
            $sth->execute();
            $response = $sth->fetchAll();
                

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href ="annonce.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
<nav class="navbar">
  <div class="container-fluid">
    <img src="logo.png" alt="logo"width="60">
  </div>
</nav>
<h1>Agence immobilère</h1>
        <!-- Button trigger modal -->
<div class="btn-cont">
<button type="button" id="Ajouter" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  +Ajouter
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="exampleModalLabel">Ajouter neuvelle annonce</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="Titre">Titre</label><br>
            <input name="Titre" id="Titre" type="text">
        </div>
        <div class="mb-3">
            <label for="Image">Ajoutez une photo</label><br>
            <input name="Img" id="Image" type="file">                
        </div>
        
        <div class="mb-3">                    
            <label for="Description">Description</label><br>
            <input name="Description" id="Description" type="text">
        </div>

        <div class="mb-3">
            <label for="Superficie">Superficie</label><br>
            <input name="Superficie" id="Superficie" type="number">
        </div>
        
        <div class="mb-3">
            <label for="Adresse">Adresse</label><br>
            <input name="Adresse" id="Adresse" type="text">                
        </div>
        
        <div class="mb-3">
            <label for="Prix">Prix</label><br>
            <input name="Prix" id="Prix" type="number">
        </div>
        
        <div class="mb-3">
            <label for="Type">Type d'annonce</label><br>
            <input name="Type" id="Type" type="text">
        </div>
        
      </div>
      <div class="modal-footer" >
        <button type="button" id="modal-ajouter" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit"  class="btn btn-primary" name="submit" value="Ajouter">
        
    </form>
      </div>
    </div>
  </div>
</div>

    <div class="select">

    <form action="" method="post" id="Type">
        
        <label for="Type">Type d'annonce :</label>
        <select name=SearchType>
            <option value=""></option>
            <option value="vente">Vente</option>
            <option value="location">Location</option>
        </select>

        <label for="Min">Min</label>
        <input id="Min" name="Min" type="number">

        <label for="Max">Max</label>
        <input id="Max" name="Max" type="number">

        <input type="submit" name="Search" class="btn btn-secondary"value="recherche" id="Search">

    </form>
    </div>
    <div class = "conteneur">
        <?php 

        if(isset($_POST["Search"]))
            {
                    $TypeAnnonce = $_POST['SearchType'];
                    $PrixMin = $_POST['Min'];
                    $PrixMax = $_POST['Max'];


                    $Search = $conn->prepare("SELECT * FROM `agence` WHERE Type = '$TypeAnnonce' AND Montant BETWEEN '$PrixMin' AND '$PrixMax'");
                    $Search->execute();
                    
                    $SearchResponse = $Search->fetchAll();

                foreach($SearchResponse as $champ)
            {
                echo "
                <div class='card'>
                    <img src=".$champ["Img"]." style='width:100%'>
                    <div class='container'>
                    <h4><b>".$champ["Titre"]."</b></h4>
                    <p>".$champ["Dscr"]."</p>
                    <p>Superficie : ".$champ["Superficie"]."mÂ²</p>
                    <p>En ".$champ["Type"]."</p>
                    <p>Prix : ".$champ["Montant"]."£</p>
                    <p>date : ".$champ["Date"]."</p>
                  
                   

<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target=#".$champ["ID"]." >
  Modifier
</button>


<div class='modal fade' id=".$champ["ID"]." tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='exampleModalLabel'>Modal title</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>

         <form action='' method='POST' enctype='multipart/form-data'>

        <label for='Titre'>Titre</label>
        <input name='ModifierTitre' id='Titre' type='text'>

        <label for='Image'>Ajoutez une photo</label>
        <input name='ModifierImg' id='Image' type='file'>

        <label for='Description'>Description</label>
        <input name='ModifierDescription' id='Description' type='text'>

        <label for='Superficie'>Superficie</label>
        <input name='ModifierSuperficie' id='Superficie' type='number'>

        <label for='Adresse'>Adresse</label>
        <input name='ModifierAdresse' id='Adresse' type='text'>

        <label for='Prix'>Prix</label>
        <input name='ModifierPrix' id='Prix' type='number'>

        <label for='Type'>Type d'annonce</label>
        <input name='ModifierType' id='Type' type='text'>

        <label for='ID'>ID</label>
        <input name='ID' id='ID' type='number' value=".$champ["ID"].">
        
        
        
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Close</button>
        <input type='submit' class='btn btn-success' name='Modifier' value='Modifier'>

        
    </form>
      </div>
    </div>
  </div>
</div>


<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#Supprimer".$champ["ID"]."'>
  Supprimer
</button>


<div class='modal fade' id='Supprimer".$champ["ID"]."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h2 class='modal-title fs-5' id='exampleModalLabel'>Modal title</h2>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>

         <form action='' method='POST' enctype='multipart/form-data'>


        <label for='ID'>ID</label>
        <input name='ID' id='ID' type='number' value=".$champ["ID"].">

        
        
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <input type='submit'class='btn btn-danger' name='Supprimer' value='Supprimer'>

        
    </form>
      </div>
    </div>
  </div>
</div>
                    </div>
                </div>
                ";
            }
        }

            else
            {
                foreach($response as $ligne)
            {
                echo "
                <div class='card'>
                    <img src=".$ligne["Img"]." style='width:100%'>
                    <div class='container'>
                    <h4><b>".$ligne["Titre"]."</b></h4>
                    <p>".$ligne["Dscr"]."</p>
                    <p>Superficie : ".$ligne["Superficie"]."mÂ²</p>
                    <p>En ".$ligne["Type"]."</p>
                    <p>Prix : ".$ligne["Montant"]."£</p>
                    <p>date : ".$ligne["Date"]."</p>

<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target=#".$ligne["ID"].">
  Modifier
</button>


<div class='modal fade' id=".$ligne["ID"]." tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h2 class='modal-title fs-5' id='exampleModalLabel'>Modification d'annonce</h2>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>

         <form action='' method='POST' enctype='multipart/form-data'>

        <label for='Titre'>Titre</label>
        <input name='ModifierTitre' id='Titre' type='text'>

        <label for='Image'>Ajoutez une photo</label>
        <input name='ModifierImg' id='Image' type='file'>

        <label for='Description'>Description</label>
        <input name='ModifierDescription' id='Description' type='text'>

        <label for='Superficie'>Superficie</label>
        <input name='ModifierSuperficie' id='Superficie' type='number'>

        <label for='Adresse'>Adresse</label>
        <input name='ModifierAdresse' id='Adresse' type='text'>

        <label for='Prix'>Prix</label>
        <input name='ModifierPrix' id='Prix' type='number'>

        <label for='Type'>Type d'annonce</label>
        <input name='ModifierType' id='Type' type='text'>

        <label for='ID'></label>
        <input name='ID' id='ID' type='hidden' value=".$ligne["ID"].">

        
        
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <input type='submit'class='btn btn-primary'name='Modifier' class='btn btn-secondary' value='Modifier'>

        
    </form>
      </div>
    </div>
  </div>
</div>


<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#Supprimer".$ligne["ID"]."'>
  Supprimer
</button>


<div class='modal fade' id='Supprimer".$ligne["ID"]."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h2 class='modal-title fs-5' id='exampleModalLabel'>Suppression d'annonce</h2>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>

          <form action='' method='POST' enctype='multipart/form-data'>


        <label for='ID'>Etes-vous sur de vouloir supprimer l'annonce ?</label>
        <input name='ID' id='ID' type='hidden' value=".$ligne["ID"].">

        
        
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <input class='btn btn-danger' type='submit' name='Supprimer' value='Supprimer'>

        
        </form>
      </div>
    </div>
  </div>
</div>
                    </div>
                </div>
                ";
            }
            }
        
        
        ?>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>


</html>
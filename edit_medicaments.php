<?php
require_once 'connection.php';

$id_medicaments = $_GET["id_medicaments"];

if(empty($id_medicaments)){

         header('Location: listing_medicaments.php');
         exit;
}

if(isset($_POST)  && !empty($_POST)){

      // var_dump($_POST);

      $control_form_err = false;

     

      if(! get_magic_quotes_gpc() ) {
        $id = addslashes ($_POST['id']);
        $nom = addslashes ($_POST['nom']);
        $description = addslashes ($_POST['description']);
        $prix = addslashes ($_POST['prix']);
        $stock = addslashes ($_POST['stock']);
        $reference = addslashes ($_POST['reference']);
        $created_at = addslashes ($_POST['created_at']);
     } else {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];
        $reference = $_POST['reference'];
        $created_at = $_POST['created_at'];

        if(!empty($_POST['id'])  &&  !empty($_POST['nom'] ) && !empty($_POST['description']) && !empty($_POST['prix'])  && !empty($_POST['stock'])  && !empty($_POST['reference'])  && !empty($_POST['created_at'])){

        $sql = " UPDATE  users  SET   nom='".$nom."',description='".$description."',prix='".$prix."',stock='".$stock."',reference='".$reference."',created_at='".$created_at."' WHERE  id='".$id_medicaments."' ";
        mysqli_select_db( $conn, 'medicaments' );
        $retval = mysqli_query( $conn, $sql );
   
        if(! $retval ) {
                $control_form_err = true;
         }

     }

}

$sql = " SELECT id, nom, description, prix, stock, reference, created_at FROM  medicament  WHERE id='".$id_medicaments."' ";
$retval = mysqli_query( $conn, $sql );

$results = array();
if($retval){

    while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        $results[] = $row;
    }

    if(count($results)<=0){

        header('Location:  listing_users.php');
        exit;
    }
   
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>listing medicament</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Audran MASSACRY <sup>2</sup></div>
            </a>

            <div class= search-bar>
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pages</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Listing:</h6>
                        <a class="collapse-item" href="listing_medicaments.php">Medicaments</a>
                        <a class="collapse-item" href="listing_users.php">Users</a>
                        <a class="collapse-item" href="user-medicament.php">User / Medicament</a>
                        <a class="collapse-item" href="login.php">Login</a>
                        <a class="collapse-item" href="register.php">Register</a>
                    </div>
                </div>
            </li>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ajout</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ajouter:</h6>
                        <a class="collapse-item" href="add_users.php">User</a>
                        <a class="collapse-item" href="add_medicaments.php">Medicaments</a>
                        <a class="collapse-item" href="add_panier.php">Panier</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
                <div class="container-fluid">
                    <h2>Modifier</h2>

                    <form  action ="<?php $_PHP_SELF ?>" method= "POST">


                    <?php   if(isset($_POST)  && !empty($_POST)){  ?>

                    <?php   if(!$control_form_err){  ?>

                    <div class="alert alert-success" role="alert">
                        <a href="#" class="alert-link">Modification effectuée</a>
                    </div>

                    <?php   }  ?> 

                    <?php   if($control_form_err){  ?>

                    <div class="alert alert-danger" role="alert">
                        <a href="#" class="alert-link">Echec de la modification</a>
                    </div>

                    <?php   }  ?>  

                    <?php   }  ?>  
                    <div class="form-group">
                        <label for="labelnom">nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le nom'" value="<?= $results[0]["nom"]; ?>">
                        <?php   if(isset($_POST['nom'])  && empty($_POST['nom'])){  ?>

                            <div class="alert alert-danger" role="alert">
                                    <a href="#" class="alert-link">Le champ 'nom' doit être renseigné</a>
                            </div>

                        <?php   }  ?> 
                    
                    </div>
                    <div class="form-group">
                        <label for="labelDescription">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter la description" value="<?= $results[0]["description"]; ?>">
                    
                    </div>

                    <?php   if(isset($_POST['description'])  && empty($_POST['description'])){  ?>

                        <div class="alert alert-danger" role="alert">
                            <a href="#" class="alert-link">Le champ 'description' doit être renseigné</a>
                        </div>

                    <?php   }  ?> 

                    <div class="form-group"  style="margin-bottom:1%">
                        <label for="labelPrix">Prix</label>                         
                        <div class="input-group">
                                <input type="text" class="form-control" id="prix" name="prix" value="<?= $results[0]["prix"]; ?>">        
                            </div>  
                            
                            <?php   if(isset($_POST['prix'])  && empty($_POST['prix'])){  ?>

                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="alert-link">Le champ 'prix' doit être rensigné</a>
                            </div>

                            <?php   }  ?> 

                    <div class="form-group"  style="margin-bottom:1%">
                        <label for="labelStock">Stock</label>                         
                        <div class="input-group">
                            <input type="text" class="form-control" id="stock" name="stock" value="<?= $results[0]["stock"]; ?>">        
                        </div>  
                        
                        <?php   if(isset($_POST['stock'])  && empty($_POST['stock'])){  ?>

                        <div class="alert alert-danger" role="alert">
                            <a href="#" class="alert-link">Le champ 'stock' doit être rensigné</a>
                        </div>

                        <?php   }  ?> 
                
                    </div>

                    <div class="form-group"  style="margin-bottom:1%">
                        <label for="labelReference">Reference</label>                         
                        <div class="input-group">
                            <input type="text" class="form-control" id="reference" name="reference" value="<?= $results[0]["reference"]; ?>">        
                        </div>  
                        
                        <?php   if(isset($_POST['reference'])  && empty($_POST['reference'])){  ?>

                        <div class="alert alert-danger" role="alert">
                            <a href="#" class="alert-link">Le champ 'reference' doit être rensigné</a>
                        </div>

                        <?php   }  ?> 
                
                    </div>

                    <div class="form-group"  style="margin-bottom:1%">
                        <label for="labelCreation">Date de création</label>                         
                        <div class="input-group">
                            <input type="date" class="form-control" id="created_at" name="created_at" value="<?= $results[0]["created_at"]; ?>">        
                        </div>  
                        
                        <?php   if(isset($_POST['created_at'])  && empty($_POST['created_at'])){  ?>

                        <div class="alert alert-danger" role="alert">
                            <a href="#" class="alert-link">Le champ 'date de création' doit être rensigné</a>
                        </div>

                        <?php   }  ?> 
                
                    </div>

                    <input type="hidden"  name = "id_clients"  value="<?= $id_clients ?>"  />

                    <button type="submit" class="btn btn-primary">Enregister</button>
                    </form>
                   
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <?php  include 'templates/footer.php'; ?>
    </body>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</html>
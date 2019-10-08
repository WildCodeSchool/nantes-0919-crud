<?php

require_once "connect.php";

// Recupérer les données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isValid = true;
    if (!isset($_POST['firstname']) || empty($_POST['firstname'])){
        $isValid = false;
    }
    if (!isset($_POST['lastname']) || empty($_POST['lastname'])){
        $isValid = false;
    }
    if (
        !isset($_POST['email'])
        || empty($_POST['email'])
        || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    ) {
        $isValid = false;
    }
    if ($isValid) {
        // Initialiser la BDD avec PDO
        $pdo = new PDO(DSN, USER, PASSWORD);
        // Requette d'ajout
        $query = "INSERT INTO contact (firstname, lastname, email) VALUES (:firstname, :lastname, :email)";
        $request = $pdo->prepare($query);
        $request->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
        $request->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
        $request->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $request->execute();
    }
}

// Faire un formulaire
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Create Contact</title>
  </head>
  <body>
      <div class="container">
          <div class="row">
              <form method="post" class="col-12">
                  <div class="form-group">
                      <label for="firstname">Firstname</label>
                      <input type="text" class="form-control" id="firstname" name="firstname">
                  </div>
                  <div class="form-group">
                      <label for="lastname">Lastname</label>
                      <input type="text" class="form-control" id="lastname" name="lastname">
                  </div>
                  <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" name="email">
                  </div>
                  <button type="submit" class="btn btn-success">Submit</button>
              </form>
          </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="<?= URLROOT . '/sass/main.css' ?>">
  <title><?php echo SITENAME; ?></title>
</head>

<body>
  <header>
    <div class="navbar navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand">
          <h2>WRITE YOUR NAME</h2>
        </a>
        <div class="d-flex">
          <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search" />
            <button class="btn btn-trans my-2 my-sm-0" type="button" id="search-btn">
              <i class="fas fa-search"></i>
            </button>
          </form>
          <?php if (!isset($_SESSION['user_id'])) { ?>
            <a href="<?= URLROOT ?>users/login" class="btn btn-light my-2 my-sm-0 ml-4">Log in</a>
            <a href="<?= URLROOT ?>users/register" class="btn btn-outline-success my-2 my-sm-0 ml-4">
              Get Started
            </a>

          <?php } else { ?>
            <a href="<?= URLROOT ?>users/logout" class="btn btn-light my-2 my-sm-0 ml-4">Log out</a>
            <a href="<?= URLROOT ?>articles/manage" class="btn btn-outline-success my-2 my-sm-0 ml-4">
              <i class="fas fa-tasks"></i>
              Manage
            </a>

          <?php } ?>


        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Architecture</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Art & illustration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Business & corporate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Culture & Education</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">E-Commerce</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Design Agences</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
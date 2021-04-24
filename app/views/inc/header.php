<?php $path = URLROOT . $_SESSION['page'];
$showSearch = false;
if ($_SESSION['page'] === 'pages/index' || $_SESSION['page'] === 'articles/category') $showSearch = true;
?>

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
        <a href="<?= URLROOT ?>" class="navbar-brand">
          <?php if (isLoggedIn()) { ?>
            <h2><?= $_SESSION['user_name'] ?></h2>
          <?php } else { ?>
            <h2>Article Blog</h2>
          <?php } ?>
        </a>
        <div class="header-controls">
          <?php if ($showSearch) { ?>
            <form class="form-inline" action="<?= URLROOT . $_SESSION['page'] ?>" method="POST">
              <input name="search" class="form-control mr-sm-2 search" type="search" placeholder="Search By Article Title" aria-label="Search" id="search" />
              <button class="btn btn-light my-2 my-sm-0" type="button" name="search" id="search-btn">
                <i class="fas fa-search"></i>
              </button>
            </form>
          <?php } ?>
          <?php if (!isLoggedIn()) { ?>
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
        <button class="navbar-toggler" type="button" id="sidebar-toggler">
          <span class="navbar-toggler-icon"></span>
        </button>

      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-bottom">
      <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>articles/category/architecture">Architecture</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>articles/category/art-illustration">Art & illustration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>articles/category/business-and-corporate">Business & corporate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>articles/category/culture-and-education">Culture & Education</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>articles/category/e-commerce">E-Commerce</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>articles/category/development">Development</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>articles/category/design-agency">Design Agency</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
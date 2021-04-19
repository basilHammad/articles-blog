<?php require APPROOT . '/views/inc/header.php'; ?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 h-100" src="<?= URLROOT; ?>img/1_KWvw0J4A3S8DwGlxyvzgqQ.jpeg" alt="First slide" />
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 h-100" src="<?= URLROOT; ?>/img/1_KWvw0J4A3S8DwGlxyvzgqQ.jpeg" alt="Second slide" />
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <?php foreach ($data['articles'] as $article) { ?>
          <div class="card mb-5">
            <div class="img-wrapper mb-4">
              <a href="<?= URLROOT; ?>articles/show/<?= $article->id; ?>">
                <img src="<?= URLROOT . 'img/article-imgs/' . $article->img ?>" alt="" />
              </a>
            </div>
            <a href="#"><strong><?= strtoupper($article->category)  ?></strong></a>
            <h2 class="pt-4"><?= $article->title ?></h2>
            <p> <?= $article->description ?> </p>
          </div>

        <?php } ?>
      </div>
      <div class="col-md-4 px-3">
        <div class="sections-wrapper px-1 py-3 mb-5 bg-light">
          <h4>Sections</h4>
          <ul>
            <li>
              <a href="#">Architecture</a>
            </li>
            <li>
              <a href="#">Art & illustration</a>
            </li>
            <li>
              <a href="#">Business & corporate</a>
            </li>
            <li>
              <a href="#">Culture & Education</a>
            </li>
            <li>
              <a href="#">E-commerce</a>
            </li>
            <li>
              <a href="#">Design Agency</a>
            </li>
            <li>
              <a href="#">Mobile & Apps</a>
            </li>
          </ul>
        </div>
        <div class="popular-articles-wrapper px-1 py-3 bg-light">
          <h4>Popular Articles</h4>
          <div class="popular-article-card">
            <div class="img-wrapper">
              <img src="<?= URLROOT; ?>img/5b67ee95d566e.jpeg" alt="" />
            </div>
            <h4 class="p-2">E-commerce</h4>
          </div>
          <div class="popular-article-card">
            <div class="img-wrapper">
              <img src="<?= URLROOT; ?>img/5b39e6babeef6.jpg" alt="" />
            </div>
            <h4 class="p-2">Design Agency</h4>
          </div>
          <div class="popular-article-card">
            <div class="img-wrapper">
              <img src="<?= URLROOT; ?>img/5b6955226700d.png" alt="" />
            </div>
            <h4 class="p-2">Art & illustration</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php require APPROOT . '/views/inc/footer.php'; ?>
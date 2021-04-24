<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/sidebar.php'; ?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block" src="<?= URLROOT; ?>img/2019-06-14_Sales-Enablement_Audience-Personas_Developer-8078-1280x853.jpg" alt="First slide" />
      <div class="carousel-caption d-none d-md-block">
        <h1>Applying Usability Principles to Stakeholder Management</h1>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block" src="<?= URLROOT; ?>/img/cc.jpg" alt="Second slide" />
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
      <div class="col-md-8 order-1 order-md-1">
        <div id="articles-container">
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
              <div class="card-link-wrapper d-flex justify-content-end">
                <a href="<?= URLROOT; ?>articles/show/<?= $article->id; ?>" class="card-link text-success push-right">Read More</a>
              </div>
            </div>
          <?php
            $id = $article->id;
          } ?>
        </div>

      </div>
      <div class="col-md-4 px-3 order-3 order-md-2">
        <div class="sections-wrapper px-3 py-3 mb-5 bg-light">
          <h4>Sections</h4>
          <ul>
            <li class="text-muted">
              <a href="<?= URLROOT ?>articles/category/architecture">Architecture</a> (<?= (isset($data['architecture_count']) ? $data['architecture_count'] : 0) ?>)
            </li>
            <li class="text-muted">
              <a href="<?= URLROOT ?>articles/category/art-illustration">Art & illustration</a> (<?= (isset($data['art-illustration_count']) ? $data['art-illustration_count'] : 0) ?>)
            </li>
            <li class="text-muted">
              <a href="<?= URLROOT ?>articles/category/business-corporate">Business & corporate</a> (<?= (isset($data['business-corporate_count']) ? $data['business-corporate_count'] : 0) ?>)
            </li>
            <li class="text-muted">
              <a href="<?= URLROOT ?>articles/category/culture-education">Culture & Education</a> (<?= (isset($data['culture-Education_count']) ? $data['culture-Education_count'] : 0) ?>)
            </li>
            <li class="text-muted">
              <a href="<?= URLROOT ?>articles/category/e-commerce">E-commerce</a> (<?= (isset($data['e-commerce_count']) ? $data['e-commerce_count'] : 0) ?>)
            </li>
            <li class="text-muted">
              <a href="<?= URLROOT; ?>articles/category/design-agency">Design Agency</a> (<?= (isset($data['design_agency_count']) ? $data['design_agency_count'] : 0) ?>)
            </li>
            <li class="text-muted">
              <a href="<?= URLROOT; ?>articles/category/development">Development</a> (<?= (isset($data['development_count']) ? $data['development_count'] : 0) ?>)
            </li>
          </ul>
        </div>
        <div class="popular-articles-wrapper px-1 py-3 bg-light">
          <h4>Popular Articles</h4>
          <?php foreach ($data['pupularArticles'] as $article) { ?>
            <div class="popular-article-card">
              <div class="img-wrapper">
                <a href="<?= URLROOT; ?>articles/show/<?= $article->id; ?>">
                  <img src="<?= URLROOT ?>img/article-imgs/<?= $article->img ?>" alt="" />
                </a>
              </div>
              <h4 class="pt-2 mb-0"><?= $article->category ?></h4>
              <p class="text-muted"> <?= $article->popularity ?> Views </p>
            </div>
          <?php } ?>
        </div>
      </div>
      <input id="last_id" type="hidden" value="<?= $data['last_id'] ?>">
      <input id="load_more_id" type="hidden" value="<?= $id ?>">
      <input id="data" type="hidden" value='<?= json_encode($data['articles']) ?>'>
      <?php if ($data['last_id'] !== $id && count($data['articles']) > 1) { ?>
        <div class="load-more_wrapper col order-2 order-md-3">
          <button id="load-more">LOAD MORE
            <span class="d-block">
              <i class="fas fa-chevron-down fa-2x d-block"></i>
              <i class="fas fa-chevron-down fa-2x d-block down"></i>
            </span>
          </button>
        </div>
      <?php } ?>

    </div>
  </div>

</section>


<?php require APPROOT . '/views/inc/footer.php'; ?>
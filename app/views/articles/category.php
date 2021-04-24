<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/sidebar.php'; ?>
<section class="py-5">
    <div class="container">
        <h1 class="pb-4"><?= $data['category'] ?></h1>
        <div class="row">
            <div class="col-md-8 order-1 order-md-1">
                <div class="row" id="articles-container">
                    <?php foreach ($data['articles'] as $article) { ?>
                        <div class="col-md-6">
                            <div class="card-small">
                                <div class="img-wrapper mb-3">
                                    <a href="<?= URLROOT; ?>articles/show/<?= $article->id; ?>">
                                        <img src="<?= URLROOT . 'img/article-imgs/' . $article->img ?>" alt="" />
                                    </a>
                                </div>
                                <h3>
                                    <?= $article->title ?>
                                </h3>
                            </div>
                        </div>
                    <?php
                        $id = $article->id;
                    } ?>
                </div>
            </div>
            <div class="col-md-4 order-3 order-md-2 px-3">
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
            <div class="col-12 order-2 order-md-3 ">
                <input id="last_id" type="hidden" value="<?= $data['last_id'] ?>">
                <input id="load_more_id" type="hidden" value="<?= $id ?>">
                <input id="data" type="hidden" value='<?= json_encode($data['articles']) ?>'>
                <?php if ($data['last_id'] !== $id && count($data['articles']) > 1) { ?>

                    <div class="load-more_wrapper">
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

    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
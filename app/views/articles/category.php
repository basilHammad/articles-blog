<?php require APPROOT . '/views/inc/header.php'; ?>
<section class="py-5">
    <div class="container">
        <h1 class="pb-4"><?= $data['category'] ?></h1>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
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
                <div class="load-more_wrapper">
                    <button class="<?= ($data['last_id']) === $id ? 'd-none' : '' ?>" id="load-more" data-id="<?= $id ?>">LOAD MORE
                        <span class="d-block">
                            <i class="fas fa-chevron-down fa-2x d-block"></i>
                            <i class="fas fa-chevron-down fa-2x d-block down"></i>
                        </span>
                    </button>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 px-3">
                <div class="sections-wrapper px-1 py-3 mb-5 bg-light">
                    <h4>Sections</h4>
                    <ul>
                        <li>
                            <a href="<?= URLROOT ?>articles/category/architecture">Architecture</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>articles/category/art-and-illustration">Art & illustration</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>articles/category/business-and-corporate">Business & corporate</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>articles/category/culture-and-education">Culture & Education</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>articles/category/e-commerce">E-commerce</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>articles/category/design-agences">Design Agency</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>articles/category/mobile-and-apps">Mobile & Apps</a>
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
                            <h4 class="p-2"><?= $article->category ?></h4>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
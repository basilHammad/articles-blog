<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container p-5">
    <?php flash('article_message'); ?>
    <div class="row mb-5">
        <div class="col-md-6">
            <h3>
                My Articles
            </h3>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <a href="<?= URLROOT ?>/articles/add" class="btn btn-primary ">
                <i class="fas fa-pencil-alt"></i> Add Article
            </a>
        </div>
    </div>

    <div class="row">
        <?php foreach ($data['articles'] as $article) {
        ?>
            <div class="col-md-6">
                <div class="card-small card-border mb-3">
                    <div class="img-wrapper mb-3">
                        <a href="<?= URLROOT; ?>articles/edit/<?= $article->id; ?>">
                            <img src="<?= URLROOT . 'img/article-imgs/' . $article->img ?>" alt="" />
                        </a>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title"><?= $article->title; ?></h2>
                        <p class="card-text"><?= $article->description; ?></p>
                        <p class="card-text"><small class="text-muted">Created By <?= $_SESSION['user_name'] ?></small></p>
                        <p class="card-text"><small class="text-muted">Created At <?= $article->created_at ?></small></p>
                        <p class="card-text"><small class="text-muted">Last Modified <?= $article->modified_at ?></small></p>
                        <div class="controls">
                            <a href="<?= URLROOT; ?>articles/edit/<?= $article->id; ?>">
                                <i class="far fa-edit fa-2x text-dark"></i>
                            </a>
                            <a href="<?= URLROOT; ?>articles/delete/<?= $article->id; ?>">
                                <i class="fas fa-trash fa-2x text-dark"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
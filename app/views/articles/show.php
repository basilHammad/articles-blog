<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/sidebar.php'; ?>

<div class="hero">
    <img src="<?= URLROOT . 'img/article-imgs/' . $data['article']->img ?>" alt="Second slide" />
</div>

<section class="article text-muted">
    <div class="container pt-5">
        <a href="<?= URLROOT . 'articles/category/' . $data['article']->category ?>">
            <h3 class="pb-5"><?= $data['article']->category ?></h3>
        </a>

        <h1 class="text-dark"><?= $data['article']->title ?></h1>
        <p><?= $data['article']->created_at ?></p>
        <p class="pb-5"><?= $data['article']->description ?></p>
        <p class="pb-5"><?= $data['article']->body ?></p>
    </div>
</section>

<section>
    <div class="container">
        <h1>COMMENTS <small>(<?= count($data['comments']) ?>)</small></h1>
        <?php foreach ($data['comments'] as $comment) { ?>
            <div class="card-small card-border mb-5">
                <div class="card-body">
                    <h2 class="card-title"><?= $comment->name ?></h2>
                    <p class="card-text text-muted"><?= $comment->body ?></p>
                </div>
            </div>
        <?php } ?>
        <form class="mt-5" action="<?= URLROOT . 'articles/show/' . $data['id']; ?>" method="POST">
            <h2 class="py-3">Join the discussion</h2>
            <textarea class="w-100 p-2" name="comment" id="comment" rows="10"></textarea>
            <div class="row py-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-lg <?= (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['name']; ?>" placeholder="Your Name">
                        <span class="invalid-feedback"><?= $data['name_error']; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg <?= (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['email']; ?>" placeholder="Your Email">
                        <span class="invalid-feedback"><?= $data['email_error']; ?></span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-md-6">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <button type="submit" name="submit" class="btn btn-success btn-block comment">ADD COMMENT</button>
                    <?php } else { ?>
                        <a href="<?= URLROOT ?>users/login" class="btn btn-danger btn-block comment">Log In To Comment</a>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="py-3">Similar Articles</h2>
        <div class="row">
            <?php foreach ($data['similar-articles'] as $similarArticle) {
                if ($data['article']->id !== $similarArticle->id) {
            ?>
                    <div class="col-md-3">
                        <div class="card-similar-articles">
                            <div class="img-wrapper mb-3">
                                <a href="<?= URLROOT; ?>articles/show/<?= $similarArticle->id; ?>">
                                    <img src="<?= URLROOT . 'img/article-imgs/' . $similarArticle->img ?>" alt="" />
                                </a>
                            </div>
                            <h3>
                                <?= $similarArticle->title ?>
                            </h3>
                        </div>
                    </div>
            <?php
                }
            } ?>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
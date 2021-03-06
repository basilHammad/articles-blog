<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/sidebar.php'; ?>
<div class="container">

    <div class="card card-body bg-light mt-5">
        <h2>Edit Article</h2>
        <form action="<?= URLROOT; ?>articles/edit/<?= $data['id'] ?> " method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title: <sup>*</sup></label>
                        <input type="text" name="title" class="form-control form-control-lg <?= (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['title']; ?>">
                        <span class="invalid-feedback"><?= $data['title_error']; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="text" id="selected-category" value="<?= $data['category']; ?>" hidden>
                        <label for="category">Category: <sup>*</sup></label>
                        <select class='form-control form-control-lg <?= (!empty($data['category_error'])) ? 'is-invalid' : ''; ?>' name="category" id="category">
                            <option></option>
                            <option value="architecture" id="architecture">Architecture</option>
                            <option value="art-illustration" id="art-illustration">Art & illustration</option>
                            <option value="business-corporate" id="business-corporate">Business & corporate</option>
                            <option value="culture-Education" id="culture-Education">Culture & Education</option>
                            <option value="e-commerce" id="e-commerce">E-Commerce</option>
                            <option value="development" id="development">Development</option>
                            <option value="design_agency" id="design_agency">Design Agency</option>
                        </select>
                        <span class="invalid-feedback"><?= $data['category_error']; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group upove-file">
                        <label for="description">Description: <sup>*</sup></label>
                        <input type="text" name="description" class="form-control form-control-lg <?= (!empty($data['description_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['description']; ?>">
                        <span class="invalid-feedback"><?= $data['description_error']; ?></span>
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="fileToUpload" class="custom-file-input <?= (!empty($data['img_error'])) ? 'is-invalid' : ''; ?>" id="img">
                            <label class="custom-file-label" for="customFile">Choose an image for the article</label>
                            <span class="invalid-feedback"><?= $data['img_error']; ?></span>
                        </div>
                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Article Content: <sup>*</sup></label>
                        <textarea name="body" class="form-control rounded-0 <?= (!empty($data['body_error'])) ? 'is-invalid' : ''; ?>" id="exampleFormControlTextarea1" rows="10">
                             <?= $data['body']; ?>
                        </textarea>
                        <span class="invalid-feedback"><?= $data['body_error']; ?></span>
                    </div>
                </div>

            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 ">
                    <input type="submit" value="Edit" class="btn btn-success btn-block">
                </div>
            </div>
        </form>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
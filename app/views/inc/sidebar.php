<div class="sidebar bg-light">
    <div class="sidebar-header-controls">
        <div class="register">
            <?php if (!isLoggedIn()) { ?>
                <a href="<?= URLROOT ?>users/login" class="btn btn-light my-2 my-sm-0 ml-4 login">Log in</a>
                <a href="<?= URLROOT ?>users/register" class="btn btn-outline-success my-2 my-sm-0 ml-4 get-started">
                    Get Started
                </a>
            <?php } else { ?>
                <a href="<?= URLROOT ?>users/logout" class="btn btn-light my-2 my-sm-0 ml-4 logout">Log out</a>
                <a href="<?= URLROOT ?>articles/manage" class="btn btn-outline-success my-2 my-sm-0 ml-4 manage">
                    <i class="fas fa-tasks"></i>
                    Manage
                </a>
            <?php } ?>
        </div>
        <?php if ($showSearch) { ?>
            <form class="form-inline mt-5 side-bar-form" action="<?= URLROOT . $_SESSION['page'] ?>" method="POST">
                <input name="search" class="form-control mr-sm-2 sidebar-search" type="search" placeholder="Search By Article Title" aria-label="Search" id="search" />
                <i class="fas fa-search" id="sidebar-search"></i>
            </form>
        <?php } ?>
    </div>
    <nav class="mt-5">
        <ul class="nav-items">
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
                <a class="nav-link" href="<?= URLROOT ?>articles/category/mobile-and-apps">Mobile & Apps</a>
            </li>
        </ul>
    </nav>
</div>
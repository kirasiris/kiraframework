<?php

use kira\libraries\Session;

?>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo '/'; ?>">
            <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30"
                height="24" class="me-1"><?= $_ENV['FRAMEWORK_NAME'] ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Home</a>
                </li>
                <li class="nav-item"><a href="/pages/about" class="nav-link">About</a></li>
            </ul>
            <ul class="navbar-nav">
                <?php if (Session::has('user')): ?>
                    <li class="nav-item"><a href="/auth/profile"
                            class="nav-link"><?php echo Session::get('user')['username'] ?></a></li>
                    <li class="nav-item">
                        <form method="POST" action="/auth/logout">
                            <button type="submit" class="nav-link"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i>Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a href="/auth/login" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="/auth/register" class="nav-link">Sign up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
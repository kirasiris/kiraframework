<?= loadPartial('header') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?= loadPartial('errors', [
                'errors' => $errors ?? []
            ]) ?>
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form method="POST" action="/auth/register">
                        <input type="text" name="username" placeholder="Username" class="form-control mb-3"
                            value="<?= $user['username'] ?? '' ?>" />
                        <input type="text" name="name" placeholder="Name" class="form-control mb-3"
                            value="<?= $user['name'] ?? '' ?>" />
                        <input type="email" name="email" placeholder="Email Address" class="form-control mb-3"
                            value="<?= $user['email'] ?? '' ?>" />
                        <input type="password" name="password" placeholder="Password" class="form-control mb-3" />
                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                            class="form-control mb-3" />
                        <button type="submit" class="btn btn-secondary btn-sm">Register</button>
                    </form>
                </div>
                <div class="card-footer">
                    <p class="m-0">
                        <a href="/auth/login">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= loadPartial('footer') ?>
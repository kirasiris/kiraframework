<?= loadPartial('header') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?= loadPartial('errors', [
                'errors' => $errors ?? []
            ]) ?>
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST" action="/auth/login">
                        <input type="text" name="email" placeholder="Email Address" class="form-control mb-3" />
                        <input type="password" name="password" placeholder="Password" class="form-control mb-3" />
                        <button type="submit" class="btn btn-secondary btn-sm">Login</button>
                    </form>
                </div>
                <div class="card-footer">
                    <p class="m-0">
                        <a href="/auth/register">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= loadPartial('footer') ?>
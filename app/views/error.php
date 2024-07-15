<?= loadPartial('header') ?>

<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3"><?= $data['status'] ?></div>
        <p class="text-center text-2xl mb-4">
            <?= $data['message'] ?>
        </p>
        <a class="block text-center" href="/">Go Back To Home</a>
    </div>
</section>

<?= loadPartial('footer') ?>
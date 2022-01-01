<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="w-full h-full grid place-items-center">
    <div class="flex flex-col gap-6">
        <div class="w-[440px] bg-white border-2 border-stone-100 rounded-lg p-8">
            <form class="flex flex-col items-center gap-8" action="/signup/save" method="POST">
                <h1 class="text-stone-800 text-2xl font-bold">Sign Up</h1>
                <div id="fields" class="w-full flex flex-col gap-6">
                    <input type="text" name="name" placeholder="Your awesome name" class="p-3 bg-gray-50 rounded-md border-2 border-stone-100 placeholder-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                    <input type="email" name="email" placeholder="awesome@mail.com" class="p-3 bg-gray-50 rounded-md border-2 border-stone-100 placeholder-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                    <input type="password" name="password" placeholder="******" class="p-3 bg-gray-50 rounded-md border-2 border-stone-100 placeholder-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                </div>
                <button class="w-full px-7 py-3 rounded-md bg-blue-600 text-white font-bold hover:bg-blue-700">Sign Up</button>
            </form>
        </div>

        <?php if (session()->getFlashdata('message')) : ?>
            <div class="px-6 py-3 rounded-md bg-red-100 text-red-600 text-sm font-bold"><?= session()->getFlashdata('message') ?></div>
        <?php endif ?>

    </div>
</div>
<?= $this->endSection() ?>
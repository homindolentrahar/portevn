<?= $this->extend('layout/template') ?>

<?= $this->section("content") ?>
<div class="w-full h-full flex flex-col gap-8 justify-start items-center">
    <div class="w-full grid grid-cols-2 lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-3 place-items-center gap-4">
        <?php foreach ($categories as $category) : ?>
            <div class="bg-blue-50 text-blue-600 text-sm font-bold px-5 py-3 rounded-md cursor-pointer hover:bg-blue-100"><?= $category['name'] ?></div>
        <?php endforeach; ?>
    </div>
    <div class="w-full grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-x-4 gap-y-6">
        <div class="flex flex-col rounded-md shadow cursor-pointer hover:shadow-md">
            <div class="relative">
                <div class="absolute w-full">
                    <div class="flex flex-row justify-between m-5">
                        <p class="text-white text-sm font-bold">Semarang</p>
                        <div class="flex flex-col items-center gap-0">
                            <p class="text-blue-50 text-sm font-medium">January</p>
                            <p class="text-white text-base font-extrabold">12</p>
                        </div>
                    </div>
                </div>
                <img v-if="event.image_url" :src="event.image_url" :alt="event.id" />
                <div class="bg-blue-800 w-full h-80 rounded-tl-md rounded-tr-md"></div>
            </div>
            <div class="flex flex-col justify-start gap-y-4 p-6">
                <div class="flex flex-col justify-center items-start gap-y-1">
                    <h1 class="text-black text-xl font-bold">Event title</h1>
                    <p class="text-slate-400 text-sm">Event description</p>
                </div>
                <h3 class="text-slate-400 text-sm font-bold">Music</h3>
                <h2 class="text-black font-extrabold self-end">Rp. 45000</h2>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="w-full h-full">
    <div class="grid grid-cols-2 gap-8 p-8 h-full">
        <div>
            <div class="w-full flex justify-between">
                <a href="/" class="
            flex
            items-center
            gap-3
            bg-blue-50
            px-4
            py-2
            w-min
            rounded-sm
            text-blue-600 text-sm
            font-bold
            cursor-pointer
            hover:bg-blue-100
            transition-all
            duration-300
          ">
                    Kembali
                </a>
                <a href="/events/edit/<?= $event[0]['event_id'] ?>" class="rounded-md px-6 py-3 bg-amber-50 text-amber-600 font-bold hover:bg-amber-100">Edit</a>
            </div>
            <div class="flex flex-col mt-8 gap-2">
                <h1 class="text-slate-900 text-4xl font-extrabold">
                    <?= $event[0]['title'] ?>
                </h1>
                <p class="text-gray-400 text-base">
                    <?= $event[0]['description'] ?>
                </p>
                <p class="mt-2 text-blue-600 font-bold text-sm">
                    <?= $event[0]['name'] ?>
                </p>
                <div class="w-fit px-8 py-6 rounded-lg bg-white shadow">
                    <?= $event[0]['event_time'] ?>
                </div>
                <div class="w-6/12 flex gap-4 px-8 py-6 rounded-lg bg-white shadow">
                    <!-- Icon -->
                    <div class="flex flex-col gap-2">
                        <h1 class="text-stone-900 text-base font-bold">
                            <?= $event[0]['location'] ?>
                        </h1>
                        <p class="text-gray-400 text-xs font-normal">
                            <?= $event[0]['location'] ?>
                        </p>
                    </div>
                    <!-- Another Icon -->
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <?php if ($event[0]['image_url']) { ?>
                <img src="/img/<?= $event[0]['image_url'] ?>" alt="<?= $event[0]['title'] ?>" class="rounded-md h-[480px]">
            <?php } else { ?>
                <div class="bg-gray-100 h-[480px] rounded-md"></div>
            <?php } ?>
            <button class="
          bg-blue-600
          text-white text-lg
          font-bold
          p-5
          rounded
          hover:bg-blue-700
          transition-all
          duration-300
        ">
                Book a ticket
            </button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
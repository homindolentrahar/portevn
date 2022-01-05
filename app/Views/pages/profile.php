<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="w-full h-full flex flex-col">
    <div class="flex gap-12">
        <div class="flex flex-col gap-6">
            <div class="w-[320px] h-[320px] rounded-lg bg-stone-300"></div>
            <div class="flex flex-col gap-1">
                <h1 class="text-stone-900 text-lg font-bold"><?= $user['user_name'] ?></h1>
                <p class="text-stone-400 text-sm"><?= $user['user_email'] ?></p>
            </div>
        </div>
        <div class="w-full flex flex-col gap-9">
            <h1 class="text-stone-900 font-bold">Your bookings</h1>
            <div class="flex flex-col gap-6">
                <?php foreach ($events as $event) { ?>
                    <div class="flex items-center w-7/12 px-6 py-4 gap-6 rounded-lg border-2 border-stone-100">
                        <img src="<?= $event['image_url'] ? '/img/' . $event['image_url'] : '/img/default.jpg' ?>" alt="<?= $event['title'] ?>" class="w-[80px] h-[80px] rounded-full">
                        <div class="w-full flex justify-between items-center gap-3">
                            <div class="flex flex-col gap-3">
                                <h1 class="text-stone-900 font-bold"><?= $event['title'] ?></h1>
                                <div class="flex gap-3">
                                    <div class="flex p-2 rounded-md border-2 border-stone-100">
                                        <?php
                                        $event_date = date('d M Y', strtotime($event['event_time']));
                                        ?>
                                        <p class="text-stone-600 text-xs font-bold"><?= $event_date ?></p>
                                    </div>
                                    <div class="flex p-2 rounded-md border-2 border-stone-100">
                                        <?php
                                        $event_time = date('H:i', strtotime($event['event_time']));
                                        ?>
                                        <p class="text-stone-600 text-xs font-bold"><?= $event_time ?></p>
                                    </div>
                                </div>
                                <p class="text-stone-400 text-xs"><?= $event['venue'] . ", " . $event['location'] ?></p>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <h1 class="text-stone-900 font-bold">x<?= $event['amount'] ?></h1>
                                <p class="text-blue-600 text-xs font-bold"><?= $event['price'] > 0 ? 'Rp.' . ($event['price'] * $event['amount']) : 'Free' ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
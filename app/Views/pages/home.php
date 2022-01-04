<?= $this->extend('layout/template') ?>

<?= $this->section("content") ?>
<?php

use CodeIgniter\HTTP\URI;
?>
<div class="w-full h-full flex flex-col gap-10 justify-start items-center">
    <?php if (session()->get('logged_in')) : ?>
        <div class="w-4/5 grid grid-cols-2 gap-6 rounded-xl bg-white border-2 border-stone-100">
            <div class="flex flex-col gap-4 p-10">
                <h1 class="text-stone-800 text-3xl font-extrabold">Create your own event!</h1>
                <p class="text-stone-400 text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsa esse rem corporis nisi voluptatem asperiores eos quaerat animi voluptate quas modi, sint dicta unde praesentium totam dolor aspernatur vitae.</p>
            </div>
            <div class="w-full h-full bg-blue-600 rounded-tr-xl rounded-br-xl grid place-content-center">
                <a href="/events/create" class="bg-white rounded-md px-9 py-4 text-blue-600 font-extrabold hover:bg-blue-50">Create Event</a>
            </div>
        </div>
    <?php endif ?>
    <div class="w-full grid grid-cols-2 lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-3 place-items-center gap-4">
        <?php foreach ($categories as $category) : ?>
            <?php
            $currentUri = new URI(current_url());
            $isSelected = "http://localhost:8080/index.php/filtered/" . $category['category_slug'] == $currentUri;
            ?>
            <a href="/filtered/<?= $category['category_slug'] ?>" class="text-sm font-bold px-5 py-3 rounded-md cursor-pointer <?= $isSelected ? "bg-blue-600 text-white hover:bg-blue-700" : "bg-blue-50 text-blue-600 hover:bg-blue-100" ?>"><?= $category['category_name'] ?></a>
        <?php endforeach; ?>
    </div>
    <?php if (!empty($events)) { ?>
        <div class="w-full grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-x-8 gap-y-6">
            <?php foreach ($events as $event) : ?>
                <a href="/events/<?= $event['event_id'] ?>" class="flex flex-col rounded-md shadow cursor-pointer hover:shadow-md">
                    <div class="relative">
                        <div class="absolute w-full">
                            <div class="flex flex-row justify-between m-5">
                                <p class="h-min text-white text-xs font-bold px-4 py-2 bg-stone-900 bg-opacity-75 rounded-md"><?= $event['location'] ?></p>
                                <div class="h-min flex flex-col items-center gap-0 px-4 py-2 bg-stone-900 bg-opacity-75 rounded-md">
                                    <?php
                                    $months = [
                                        "Default",
                                        "January",
                                        "February",
                                        "March",
                                        "April",
                                        "May",
                                        "June",
                                        "July",
                                        "August",
                                        "September",
                                        "October",
                                        "November",
                                        "December"
                                    ];
                                    $dateArray = date_parse($event['event_time']);
                                    ?>
                                    <p class="text-gray-300 text-xs font-semibold"><?= $months[$dateArray['month']] ?></p>
                                    <p class="text-white text-sm font-bold"><?= $dateArray['day'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php if ($event['image_url']) { ?>
                            <img src="/img/<?= $event['image_url'] ?>" alt="<?= $event['image_url'] ?>" class="w-full h-80 rounded-tl-md rounded-tr-md">
                        <?php } else {  ?>
                            <div class="bg-blue-800 w-full h-80 rounded-tl-md rounded-tr-md"></div>
                        <?php } ?>
                    </div>
                    <div class="flex flex-col justify-start gap-y-4 p-6">
                        <div class="flex flex-col justify-center items-start gap-y-1">
                            <h1 class="text-black text-xl font-bold"><?= $event['title'] ?></h1>
                            <p class="text-slate-400 text-sm"><?= $event['description'] ?></p>
                        </div>
                        <h3 class="text-slate-400 text-sm font-bold"><?= $event['category_name'] ?></h3>
                        <?php if ($event['price'] == 0) { ?>
                            <h2 class="text-black font-extrabold self-end">Free</h2>
                        <?php } else { ?>

                            <h2 class="text-black font-extrabold self-end">Rp.<?= $event['price'] ?></h2>
                        <?php } ?>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    <?php } else { ?>
        <div class="w-full h-max">
            <div class="flex flex-col justify-center items-center gap-4">
                <h1 class="text-stone-900 text-xl font-bold">No events found!</h1>
                <p class="text-gray-400 text-sm font-normal">There are no such event under certain category</p>
            </div>
        </div>
    <?php } ?>
</div>
<?= $this->endSection() ?>
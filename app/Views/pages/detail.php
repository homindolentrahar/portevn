<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="w-full h-full flex flex-col">
    <div class="w-full flex justify-between">
        <a href="/" class="
            flex
            items-center
            gap-3
            bg-stone-50
            pl-5
            pr-9
            py-3
            w-min
            rounded-md
            text-stone-600 text-sm
            font-bold
            cursor-pointer
            hover:bg-blue-100
            transition-all
            duration-300
          ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
        <?php if ($logged_in && $is_owner) { ?>
            <a href="/events/edit/<?= $event[0]['event_id'] ?>" class="flex gap-3 pl-5 pr-9 py-3 rounded-md bg-amber-50 text-amber-600 font-bold hover:bg-amber-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit</a>
        <?php } ?>
    </div>
    <div class="grid grid-cols-2 gap-8 p-8 h-full">
        <div class="h-full flex flex-col justify-between">
            <div class="flex flex-col gap-9">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-slate-900 text-4xl font-extrabold">
                            <?= $event[0]['title'] ?>
                        </h1>
                        <p class="text-gray-400 text-base">
                            <?= $event[0]['description'] ?>
                        </p>
                    </div>
                    <div class="w-min rounded-md bg-blue-50 text-blue-600 font-bold text-sm px-6 py-3">
                        <?= $event[0]['category_name'] ?>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="flex flex-row gap-8">
                        <div class="md:w-4/12 w-min flex items-center gap-4 px-6 py-4 rounded-md text-stone-800 text-sm font-bold bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
                            <?php
                            $time = strtotime($event[0]['event_time']);
                            $dateTime = date('d M Y', $time);
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?= $dateTime ?>
                        </div>
                        <div class="w-min md:w-4/12 flex items-center gap-4 px-6 py-4 rounded-md bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div class="flex flex-col gap-0">
                                <h1 class="text-stone-800 text-sm font-bold">
                                    <?= $event[0]['venue'] ?>
                                </h1>
                                <p class="text-stone-400 text-xs font-normal">
                                    <?= $event[0]['location'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <a target="_blank" href="<?= $event[0]['post_url'] ?>" class="md:w-4/12 w-min flex items-center gap-4 px-6 py-4 rounded-md text-stone-800 text-sm font-bold bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        Instagram Post
                    </a>
                    <div class="w-min md:w-4/12 flex items-center gap-4 px-6 py-4 rounded-md bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <div class="flex flex-col gap-0">
                            <h1 class="text-stone-800 text-sm font-bold">
                                <?= $event[0]['capacity'] ?> slot
                            </h1>
                            <p class="text-stone-400 text-xs font-normal">
                                Capacity
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-min md:w-6/12 flex items-center gap-4 px-6 py-4 rounded-md bg-white border-2 border-stone-100 hover:shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex flex-col gap-1">
                    <p class="text-stone-300 text-xs font-semibold">Author</p>
                    <div class="flex flex-col gap-0">
                        <h1 class="text-stone-800 text-sm font-bold"><?= $event[0]['user_name'] ?></h1>
                        <p class="text-stone-400 text-xs font-normal"><?= $event[0]['user_email'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-8">
            <?php if ($event[0]['image_url']) { ?>
                <img src="/img/<?= $event[0]['image_url'] ?>" alt="<?= $event[0]['title'] ?>" class="rounded-md h-[480px]">
            <?php } else { ?>
                <div class="bg-gray-100 h-[480px] rounded-md"></div>
            <?php } ?>
            <a href="/events/book/<?= $event[0]['event_id'] ?>" class="
          bg-blue-600
          text-center text-white text-lg
          font-bold
          p-5
          rounded
          hover:bg-blue-700
          transition-all
          duration-300
        ">
                Book a ticket
            </a>
            <div class="w-full flex items-center gap-4 px-6 py-4 rounded-md bg-white border-2 border-stone-100 hover:shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <div class="flex flex-col gap-1">
                    <p class="text-stone-300 text-xs font-semibold">Contact</p>
                    <div class="flex flex-col gap-0">
                        <h1 class="text-stone-800 font-extrabold"><?= $event[0]['contact'] ?></h1>
                        <p class="text-stone-400 text-sm font-normal">Contact Phone</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
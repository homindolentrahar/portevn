<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="w-full h-full flex flex-col">
    <?php
    if (isset($_SERVER['HTTP_REFERER'])) {
        $url = $_SERVER['HTTP_REFERER'];
    } else {
        $url = "/";
    }
    ?>
    <a href="<?= $url ?>" class="
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
            hover:bg-stone-100
            transition-all
            duration-300
          ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back
    </a>
    <?php $data = $event[0] ?>
    <div class="flex flex-col items-center gap-10 p-8">
        <h1 class="self-start text-stone-900 text-base font-bold">Booking Detail</h1>
        <div class="w-full flex gap-9">
            <div class="flex flex-col gap-9">
                <?php if ($data['image_url']) { ?>
                    <img src="/img/<?= $data['image_url'] ?>" alt="<?= $data['title'] ?>" class="w-[560px] h-[440px] rounded-md">
                <?php } else { ?>
                    <div class="w-[560px] h-[440px] rounded-md bg-blue-600"></div>
                <?php } ?>
                <div class="w-full flex items-center gap-4 px-6 py-4 rounded-md bg-white border-2 border-stone-100 hover:shadow">
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
                <div class="w-full flex gap-4">
                    <a target="_blank" href="<?= $event[0]['post_url'] ?>" class="w-full flex items-center gap-4 px-6 py-4 rounded-md text-stone-800 text-sm font-bold bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        Instagram Post
                    </a>
                    <div class="w-full flex items-center gap-4 px-6 py-4 rounded-md bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <div class="flex flex-col gap-0">
                            <h1 class="text-stone-800 text-sm font-bold"><?= $event[0]['contact'] ?></h1>
                            <p class="text-stone-400 text-xs font-normal">Contact Phone</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divide-x-2 divide-stone-100"></div>
            <div class="w-full flex flex-col gap-9">
                <div class="w-min rounded-md bg-blue-50 text-blue-600 font-bold text-sm px-6 py-3">
                    <?= $data['category_name'] ?>
                </div>
                <div class="flex flex-col gap-3">
                    <h1 class="text-slate-900 text-4xl font-extrabold">
                        <?= $data['title'] ?>
                    </h1>
                    <div class="flex gap-6">
                        <div class="w-3/12 flex items-center gap-4 px-6 py-4 rounded-md text-stone-800 text-sm font-bold bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
                            <?php
                            $time = strtotime($data['event_time']);
                            $dateTime = date('d M Y', $time);
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?= $dateTime ?>
                        </div>
                        <div class="w-2/12 flex items-center gap-4 px-6 py-4 rounded-md bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <div class="flex flex-col gap-0">
                                <h1 class="text-stone-800 text-sm font-bold">
                                    <?= $data['capacity'] ?> slot
                                </h1>
                                <p class="text-stone-400 text-xs font-normal">
                                    Capacity
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-3/12 flex items-center gap-4 px-6 py-4 rounded-md bg-white border-2 border-stone-100 hover:shadow transition-all duration-300">
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
                <?php if ($event[0]['price'] == 0) { ?>
                    <h1 class="text-blue-600 text-4xl font-extrabold">Free</h1>
                <?php } else { ?>
                    <h1 class="text-blue-600 text-4xl font-extrabold">Rp.<?= $data['price'] ?></h1>
                <?php } ?>
            </div>
        </div>
        <div class="w-full divide-x-4 divide-gray-900"></div>
        <form action="/booking/process" method="POST" class="w-6/12 flex flex-col items-center gap-6">
            <h1 class="text-stone-900 text-base font-bold">Participant Detail</h1>
            <div class="w-full flex flex-col gap-3">
                <input type="hidden" name="event_id" value="<?= $data['event_id'] ?>">
                <input type="text" name="name" placeholder="Your awesome name" class="p-3 bg-gray-50 rounded-md border-2 border-stone-100 placeholder-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" value="<?= session()->get('user_name') ?>" required>
                <input type="email" name="email" placeholder="awesome@mail.com" class="p-3 bg-gray-50 rounded-md border-2 border-stone-100 placeholder-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" value="<?= session()->get('user_email') ?>" required>
                <input type="phone" name="phone" placeholder="0857-xxxx-xxxx" class="p-3 bg-gray-50 rounded-md border-2 border-stone-100 placeholder-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                <input type="number" name="amount" max="<?= $event[0]['capacity'] ?>" placeholder="2 Tickets pls" class="p-3 bg-gray-50 rounded-md border-2 border-stone-100 placeholder-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>
            <div class="w-full rounded-md bg-white border-2 border-stone-100 px-6 py-4 flex flex-col items-center gap-2">
                <h1 class="text-stone-900 font-bold">Notes</h1>
                <p class="text-stone-300 text-sm font-normal">Invoice's detail regarding ticket(s) and meeting link, will be send to the corresponding email</p>
            </div>
            <button type="submit" class="w-full rounded-md bg-blue-600 text-center text-white font-bold px-7 py-4 hover:bg-blue-700">Check Out</button>
        </form>
        <div class="flex flex-col items-center gap-12 mt-10">
            <h1 class="text-stone-900 font-bold">Recommended for you</h1>
            <div class="grid grid-cols-3 gap-x-6">
                <?php foreach ($recommendations as $event) { ?>
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
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
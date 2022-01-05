<?php
$isLoggedIn = session()->get('logged_in');
?>
<nav class="flex justify-between items-center px-6 py-4">
    <a href="/" class="text-stone-900 text-xl font-bold">Portevn</a>
    <?php if ($isLoggedIn) { ?>
        <div class="flex gap-4 items-center">
            <a href="/profile" class="cursor-pointer text-stone-400 text-sm font-semibold">
                Hello <span class="text-stone-900 font-bold"><?= session()->get('user_name') ?></span> !
            </a>
            <a href="/login/logout" class="text-red-600 bg-red-50 text-base font-bold px-7 py-3 rounded-md hover:bg-red-100">Logout</a>
        </div>
    <?php } else { ?>
        <div class="flex gap-4">
            <a href="/login" class="text-stone-800 text-base font-bold px-7 py-3 rounded-md hover:bg-blue-100 hover:text-blue-600">Login</a>
            <a href="/signup" class="text-white text-base font-bold px-7 py-3 rounded-md bg-blue-600 hover:bg-blue-700">Sign Up</a>
        </div>
    <?php } ?>
</nav>
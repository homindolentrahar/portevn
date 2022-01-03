<?= $this->extend('layout/template') ?>

<?= $this->section("content") ?>
<?php $data = $event[0] ?>
<form method="POST" action="/events/update/<?= $data['event_id'] ?>" enctype="multipart/form-data" class="w-full h-full flex flex-col">
  <div class="w-full flex justify-between">
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
            bg-blue-50
            pl-5
            pr-9
            py-3
            w-min
            rounded-md
            text-blue-600 text-sm
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
    <a href="/events/delete/<?= $data['event_id'] ?>" class="
            flex
            items-center
            gap-3
            bg-red-50
            pl-5
            pr-9
            py-3
            w-min
            rounded-md
            text-red-600 text-sm
            font-bold
            cursor-pointer
            hover:bg-blue-100
            transition-all
            duration-300
          ">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
      </svg>
      Delete
    </a>
  </div>
  <div class="p-8">
    <?php if (session()->getFlashdata('error')) : ?>
      <div class="w-full text-center px-6 py-3 rounded-md bg-red-100 text-red-600 text-sm font-bold"><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>
    <input type="hidden" name="event_id" value="<?= $data['event_id'] ?>">
    <input type="hidden" name="previous_image" value="<?= $data['image_url'] ?>">
    <h1 class="text-stone-900 text-base font-bold mb-6">Update Event Form</h1>
    <div class="grid grid-cols-2 gap-x-8">
      <div class="flex flex-col gap-4">
        <?php $image = $data['image_url'] != null ? $data['image_url'] : "/img/default.png" ?>
        <img src="/img/<?= $image ?>" alt="preview" class="w-full h-[400px] rounded-md img-preview">
        <label class="px-6 py-4 rounded-md bg-blue-600 text-white text-sm font-bold text-center hover:bg-blue-700 cursor-pointer">
          Select Image
          <input type="file" class="hidden" id="image" name="image" onchange="previewImage()">
        </label>
        <div>
          <label for="post_url" class="block mb-2 text-sm text-stone-400">Instagram Post</label>
          <input type="text" name="post_url" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="Your Instagram Post URL" value="<?= $data['post_url'] ?>" />
        </div>
        <div>
          <label for="contact" class="block mb-2 text-sm text-stone-400">Contact</label>
          <input type="number" name="contact" value="<?= $data['contact'] ?>" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="0856-xxxx-xxxx" required />
        </div>
        <div class="flex gap-x-6"></div>
      </div>
      <div class="flex flex-col gap-4">
        <div>
          <label for="title" class="block mb-2 text-sm text-stone-400">Event name</label>
          <input type="text" name="title" value="<?= $data['title'] ?>" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="Your awesome event" required />
        </div>
        <div>
          <label for="description" class="block mb-2 text-sm text-stone-400">Event description</label>
          <textarea type="text" name="description" rows="6" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="Detail about your event" required><?= $data['description'] ?></textarea>
        </div>
        <div>
          <label for="event_time" class="block mb-2 text-sm text-stone-400">Event time</label>
          <input type="date" name="event_time" value="<?= date('Y-m-d', strtotime($data['event_time'])) ?>" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              p-3
            " />
        </div>
        <div>
          <label for="category" class="block mb-2 text-sm text-stone-400">Event category</label>
          <select name="category" value="<?= $data['category_id'] ?>" class="
              bg-stone-50
              text-stone-900 text-sm
              p-3
              rounded-md
              border-2 border-stone-100
              focus:ring-2 focus:ring-blue-300 focus:outline-none
            ">
            <option value="default">Choose a category</option>
            <?php foreach ($categories as $category) : ?>
              <option value="<?= $category['category_id'] ?>" <?php if ($category['category_id'] == $data['category_id']) echo "selected" ?>><?= $category['category_name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div>
          <label for="venue" class="block mb-2 text-sm text-stone-400">Event venue</label>
          <input type="text" name="venue" value=<?= $data["venue"] ?> class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="Cool place to held event" required />
        </div>
        <div>
          <label for="location" class="block mb-2 text-sm text-stone-400">Event location</label>
          <input type="text" name="location" value="<?= $data['location'] ?>" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="Venue location" required />
        </div>
        <div>
          <label for="price" class="block mb-2 text-sm text-stone-400">Event price</label>
          <input type="number" name="price" value="<?= $data['price'] ?>" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="0.0" required />
        </div>
        <div>
          <label for="capacity" class="block mb-2 text-sm text-stone-400">Capacity</label>
          <input type="number" name="capacity" value="<?= $data['price'] ?>" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="0" required />
        </div>
        <button type="submit" class="
            bg-blue-600
            px-6
            py-4
            text-white text-base
            font-bold
            rounded-md
            my-6
          ">
          Update an Event
        </button>
      </div>
    </div>
  </div>
</form>
<?= $this->endSection() ?>
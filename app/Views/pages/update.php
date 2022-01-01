<?= $this->extend('layout/template') ?>

<?= $this->section("content") ?>
<div class="w-full h-full flex flex-col">
    <div class="flex gap-4 justify-between">
        <h1 class="text-stone-900 text-base font-bold mb-6">Update Event Form</h1>
        <a href="/delete" class="h-min px-5 py-2 rounded-md bg-red-50 text-red-600 text-sm font-bold hover:bg-red-100">Delete</a>
    </div>
    <div class="grid grid-cols-2 gap-x-8">
        <div class="flex flex-col gap-4">
            <div id="imageBox" class="
            grid
            place-items-center
            w-full
            h-[400px]
            bg-stone-50
            rounded-md
            border-2 border-stone-100
          ">
            </div>
            <div>
                <label for="instagram" class="block mb-2 text-sm text-stone-400">Instagram Post</label>
                <input type="text" name="instagram" v-model="instagramPost" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="Awesome IG post" />
            </div>
            <div>
                <label for="contact" class="block mb-2 text-sm text-stone-400">Contact</label>
                <input type="number" name="contact" v-model="contact" class="
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
                <label for="email" class="block mb-2 text-sm text-stone-400">Event name</label>
                <input type="text" name="name" :v-model="name" class="
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
                <textarea type="text" name="description" v-model="description" rows="6" class="
              bg-stone-50
              border-2 border-stone-100
              text-stone-900 text-sm
              placeholder-stone-400 placeholder-opacity-75
              rounded-md
              focus:ring-2 focus:ring-blue-300 focus:outline-none
              w-full
              p-3
            " placeholder="Detail about your event" required></textarea>
            </div>
            <div>
                <label for="event_time" class="block mb-2 text-sm text-stone-400">Event time</label>
                <input type="datetime-local" name="event_time" v-model="eventTime" class="
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
                <select name="category" ref="category" class="
              bg-stone-50
              text-stone-900 text-sm
              p-3
              rounded-md
              border-2 border-stone-100
              focus:ring-2 focus:ring-blue-300 focus:outline-none
            ">
                    <option value="default">Choose a category</option>
                    <option v-for="cat in categories" :key="cat.category_id" :value="cat.category_id">
                        {{ cat.name }}
                    </option>
                </select>
            </div>
            <div>
                <label for="venue" class="block mb-2 text-sm text-stone-400">Event venue</label>
                <input type="text" name="venue" v-model="venue" class="
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
                <input type="text" name="location" v-model="location" class="
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
                <input type="number" name="price" v-model="price" class="
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
                <label for="price" class="block mb-2 text-sm text-stone-400">Capacity</label>
                <input type="number" name="price" v-model="price" class="
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
            <button type="submit" @click="handleSave" class="
            bg-blue-600
            px-6
            py-4
            text-white text-base
            font-bold
            rounded-md
            my-6
          ">
                Post an Event
            </button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
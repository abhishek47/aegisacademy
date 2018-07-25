<modal name="new-thread" height="auto">
  <div class="p-4 pt-6">
    <form class="flex flex-col">

        <div>
            <label class="uppercase text-grey-darker text-sm block font-semibold tracking-wide mb-2">Title</label>
            <input type="text" name="title" class="p-3 border w-full" placeholder="What is your discussion about?">
        </div>

        <div class="mt-4">
            <label class="uppercase text-grey-darker text-sm block font-semibold tracking-wide mb-2">Body</label>
            <textarea class="p-3 border w-full h-24 mb-2" name="body"></textarea>
             <span  class="text-md tracking-wide text-grey-dark">You can use <b class="font-semibold">latex</b> and <b class="font-semibold">markdown</b> to add more pretty question.</span>
        </div>

        <div class="mt-6 flex justify-end ">
            <button @click="hideModal('new-thread')" class="bg-grey hover:bg-grey-dark rounded text-white mr-4 shadow p-2 px-6 font-semibold text-sm tracking-wide">Cancel</button>
            <button class="bg-green hover:bg-green-dark shadow rounded text-white p-2 px-6 font-semibold text-sm tracking-wide">Publish</button>
        </div>

    </form>
  </div>
</modal>
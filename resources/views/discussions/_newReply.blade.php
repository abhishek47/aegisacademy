<div class="mt-6 ml-8 pl-8 mb-8 pb-8">
    <form action="/discussions/{{$discussion->id}}/replies" method="POST">
        @csrf
        <textarea name="body" class="w-full border h-32 p-2 rounded" required="required">

        </textarea>
         <span  class="text-sm mt-1 tracking-wide text-grey-dark block">You can use <b class="font-semibold">latex</b> and <b class="font-semibold">markdown</b> to add more pretty replies.</span>

         <button type="submit" class="bg-green mt-3 hover:bg-green-dark shadow rounded text-white p-2 px-6 font-semibold text-sm tracking-wide">Post Reply</button>

    </form>
</div>
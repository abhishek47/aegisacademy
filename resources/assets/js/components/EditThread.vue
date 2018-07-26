<template>
    <modal name="edit-thread" height="auto">
      <div class="p-4 pt-6">
         <h2 class="text-2xl font-semibold text-black tracking-wide mb-6">Edit Thread</h2>
        <form class="flex flex-col">
            <div>
                <label class="uppercase text-grey-darker text-sm block font-semibold tracking-wide mb-2">Title</label>
                <input type="text" v-model="form.title" @keydown="errors.title = null" class="p-3 border w-full" :class="errors.title ? 'border border-red' : ''" placeholder="What is your discussion about?">
                <span class="text-sm text-red font-semibold mt-2 block" v-if="errors.title">{{ errors.title[0] }}</span>
            </div>

            <div class="mt-4">
                <label class="uppercase text-grey-darker text-sm block font-semibold tracking-wide mb-2">Body</label>
                <textarea class="p-3 border w-full h-24 mb-2" @keydown="errors.body = null" :class="errors.body ? 'border border-red' : ''" v-model="form.body"></textarea>
                <span class="text-sm text-red font-semibold mt-2 mb-3 -mt-2 block" v-if="errors.body">{{ errors.body[0] }}</span>
                 <span  class="text-md tracking-wide text-grey-dark">You can use <b class="font-semibold">latex</b> and <b class="font-semibold">markdown</b> to add more pretty question.</span>
            </div>

            <div class="mt-6 flex justify-end ">
                <button  @click.prevent="hideMe" class="bg-grey hover:bg-grey-dark rounded text-white mr-4 shadow p-2 px-6 font-semibold text-sm tracking-wide">Cancel</button>
                <button @click.prevent="update" class="bg-green hover:bg-green-dark shadow rounded text-white p-2 px-6 font-semibold text-sm tracking-wide" :class="isSubmitting ? 'is-loading pointer-events-none cursor-not-allowed' : 'pointer-events-auto cursor-pointer'">Update</button>
            </div>

        </form>
      </div>
    </modal>
</template>

<script>
    export default {
        props: ['thread'],

        data() {
            return {
                isSubmitting: false,
                form: {
                    title: '',
                    body: '',
                },
                errors: {}
            }
        },

        created() {
            this.thread = JSON.parse(this.thread);
            this.form.title = this.thread.title;
            this.form.body = this.thread.body;
        },

        methods: {
            hideMe() {
                this.$modal.hide('edit-thread');
            },

            update() {
                this.isSubmitting = true;
                var self = this;

                axios.put('/discussions/' + this.thread.id , this.form)
                     .then(function(response) {
                        self.isSubmitting = false;
                        var did = response.data.discussion_id;
                        window.location = '/discussions/' + did;
                     }).catch(error => {
                        self.isSubmitting = false;
                        self.errors = error.response.data.errors;
                     });
            },

        }
    }
</script>
<template>
    <div v-if="deleted == false"  class="flex mt-8">
        <img class="rounded-full" src="/img/user.png" style="width: 40px;height: 40px;">
        <div class="flex flex-col ml-4 w-full">
          <div class="flex items-center justify-between">
            <div class="flex">
              <a href="/discussions/show" class="no-underline">
                <h4 class="text-md tracking-wide text-black  font-semibold">
                {{ reply.user.name }} <span class="text-sm text-grey capitalize">Posted <span class="text-grey-dark">{{ reply.created_at | moment('Do MMM YYYY') }}</span></span>
                </h4>
              </a>
              <a href="#" @click.prevent="editing = true" v-if="reply.is_mine" class="no-underline border-grey border-l pl-3 border-r-0 border-y-0 text-sm hover:underline  text-blue-dark font-normal tracking-wide ml-4" >Edit</a>
            </div>

            <div v-if="ownedThread" class="flex items-center">
            <button v-if="isBest" class="bg-green hover:bg-green-dark ml-2 p-2 px-4 shadow text-xs tracking-wide pointer-events-none rounded-lg text-white uppercase font-semibold">
              <i class="fa fa-star"></i> Best Answer</button>

            <button @click="markBest" v-else class="bg-transparent border-2 border-grey-darkest hover:bg-grey-lighter ml-2 p-2 px-4 text-xs tracking-wide rounded text-grey-darker uppercase font-semibold">Best Answer</button>
            </div>
          </div>
          <div class="mt-6 mb-8 pb-6 text-lg text-grey-darker leading-normal">
             <div v-if="editing" >
                <textarea  v-model="comment" class="p-3 border border-grey w-full h-24 rounded"></textarea>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      <button @click="update" class="bg-blue p-2 px-6 text-sm rounded text-white hover:bg-blue-dark font-semibold">Update</button>
                      <button @click="comment = reply.body;editing = false" class="bg-grey-light hover:bg-grey ml-2 p-2 px-6 text-sm rounded text-grey-darker font-semibold">Cancel</button>
                    </div>

                    <div>
                       <button @click="deleteReply" class="bg-red hover:bg-red-dark ml-2 p-2 px-6 text-sm rounded text-white font-semibold"><i class="fa fa-trash"></i> Delete</button>
                    </div>

                </div>
            </div>

            <platex v-else :body="reply.body"></platex>
          </div>

          <div class="flex items-center justify-between">
            <span class="text-grey-dark tracking-wide">{{ likesString }}</span>

            <div>
              <a v-if="isLiked" href="" @click.prevent="unlikeReply" class="no-underline text-sm hover:text-brand text-grey-dark font-semibold"><i class="fa fa-thumbs-down"></i> Unlike</a>
              <a v-else href="" @click.prevent="likeReply" class="no-underline text-sm hover:text-brand text-grey-dark font-semibold"><i class="fa fa-thumbs-up"></i> Like</a>

            </div>
          </div>
          <hr class="w-full border-grey-lighter border mt-4">
        </div>
      </div>
</template>

<script>
    export default {
        props: ['replyData', 'ownedThread'],

        data() {
            return {
                deleted: false,
                editing: false,
                comment: '',
                reply: {},
                isLiked: false,
                isBest: false,
                likesString: '',
            }
        },

        created() {
          this.reply = JSON.parse(this.replyData);
          this.comment = this.reply.body
          this.isLiked = this.reply.is_liked;
          this.isBest  = this.reply.is_best;
          this.likesString = this.reply.likes_string;
        },

        methods: {
            update() {

            },

            deleteReply() {
               this.deleted = true;
            },

            likeReply(){
               var self = this;
                axios.post('/discussions/replies/' + this.reply.id + '/like').then(function(response){
                   self.isLiked = true;
                   self.likesString = response.data.like_string;
                });
            },

            unlikeReply(){
               var self = this;
                axios.post('/discussions/replies/' + this.reply.id + '/dislike').then(function(response){
                   self.isLiked = false;
                   self.likesString = response.data.like_string;
                });
            },

            markBest() {
              this.isBest = true;
              var self = this;
                axios.post('/discussions/replies/' + this.reply.id + '/best').then(function(response){
                   window.location = '/discussions/' + self.reply.thread.id;p
                });
            }
        }
    }
</script>
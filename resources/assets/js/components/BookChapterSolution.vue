<template>
    <div v-if="deleted == false"  class="shadow mb-3 border-grey-light border bg-white p-3 pt-4">
            <div class="flex items-center justify-between">
                 <div class="flex mb-3">
                     <img class="mr-3 rounded-full border-2" src="/img/user.png"  style="width: 60px;height: 60px;" />
                     <div class="mt-2">
                        <h4 class="text-lg font-semibold text-grey-darkest" v-text="solution.user.name"></h4>
                        <p class="mt-2 text-blue">{{ solution.created_at | moment('Do MMM YYYY') }}</p>
                     </div>
                </div>
                <div class="flex -mt-2">
                 <button v-if="upvoted" @click="downvote" class="bg-grey-light p-3 text-grey-darkest hover:bg-grey rounded-l text-sm"><i class="fa fa-thumbs-up"></i> Upvoted</button>
                 <button v-else @click="upvote" class="bg-grey-light p-3 text-grey-darkest hover:bg-grey rounded-l text-sm"><i class="fa fa-thumbs-up"></i> Upvote</button>
                 <span class="bg-grey-light rounded-r p-3 text-grey-darkest border-grey border-l" v-text="upvotes"></span>
                 <div v-if="solution.is_mine">
                     <button @click="deleteComment" class="bg-red p-3 text-md rounded ml-3 text-white hover:bg-red-dark"><i class="fa fa-trash"></i></button>
                     <button @click="editing = !editing" class="bg-blue p-3 text-md rounded ml-1 text-white hover:bg-blue-dark"><i class="fa fa-edit"></i></button>
                 </div>
                </div>
            </div>

            <div v-if="editing" >
                <textarea  v-model="comment" class="p-3 border border-grey w-full h-32"></textarea>
                <div class="flex">
                    <button @click="updateComment" class="bg-teal p-2 px-6 text-md rounded text-white hover:bg-teal-dark">Update</button>
                    <button @click="comment = solution.body;editing = false" class="bg-transparent border-2 ml-2 border-blue p-2 px-6 text-md rounded text-blue hover:bg-blue hover:text-white">Cancel</button>
                </div>

            </div>

            <div v-else class="p-4 pl-2">
                <platex  :body="comment"></platex>
            </div>



        </div>
</template>

<script type="text/javascript">


    export default {
        props: ['solution'],

        data() {
            return {
                upvoted: false,
                upvotes: 0,
                editing: false,
                deleted: false,
                comment: '',
            }
        },

        created(){
            this.upvoted = this.solution.upvoted;
            this.upvotes = this.solution.upvotes;
            this.comment = this.solution.body;
        },


        methods: {
            upvote() {
                var self = this;
                axios.post('/book-chapter-question/solution/' + this.solution.id + '/upvote').then(function(){
                    self.upvoted = true;
                    self.upvotes += 1;
                });
            },

            downvote() {
                var self = this;
                axios.post('/book-chapter-question/solution/' + this.solution.id + '/downvote').then(function(){
                    self.upvoted = false;
                    self.upvotes -= 1;
                });
            },

            updateComment() {
                var self = this;

               axios.put('/book-chapter-question/solution/' + this.solution.id, {comment: this.comment}).then(function(){
                    self.editing = false;
                });
            },

            deleteComment(){
                var self = this;

                   axios.delete('/book-chapter-question/solution/' + this.solution.id).then(function(){
                        self.deleted = true;
                    });


            },
        }


    }
</script>
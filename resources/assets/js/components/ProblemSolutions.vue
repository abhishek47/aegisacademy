<template>

    <div class="mt-6 p-3">
        <hr class="border border-grey-darker my-4">
        <div class="shadow mb-3 border-grey-light border bg-white p-3 pt-4">
            <div class="flex mb-3">
                 <img class="mr-3" src="/img/solution.png"  style="width: 60px;height: 100%;" />
                 <div class="mt-1">
                    <h4 class="text-lg font-semibold text-grey-darkest">AEGIS ACADEMY</h4>
                    <p class="mt-2 text-blue">Solution from our experts</p>
                 </div>
            </div>


            <platex :body="solution"></platex>
        </div>

        <div v-for="usersolution in solutions">
            <problem-solution :solution="usersolution"></problem-solution>
        </div>

        <div>
            <div v-if="adding">
                 <textarea v-model="comment" class="border-2 border-grey-dark p-2 w-full h-24 mb-0" placeholder="Enter your comment here..">

                </textarea>
                <span  class="text-md tracking-wide text-grey-dark">You can use latex and markdown to add more pretty comments.</span>
                <div class="flex mt-2">
                    <button @click="submitComment"  class="mt-2 mr-2 rounded bg-brand p-2 text-white border-2 border-brand  hover:bg-brand-dark text-md font-semibold tracking-wide">
                        Post Comment
                    </button>
                    <button @click="adding = false"  class="mt-2 rounded  bg-transparent p-2 text-brand border-2 border-teal hover:bg-teal hover:text-white text-md font-semibold tracking-wide">
                        Cancel
                    </button>


                </div>
            </div>


            <button v-else @click="adding = true" class="block mt-0 rounded w-full bg-transparent p-3 text-brand border-2 border-brand hover:bg-brand hover:text-white text-lg font-semibold tracking-wide">
                Add Comment
            </button>


        </div>


    </div>

</template>


<script>

    import ProblemSolution from './ProblemSolution.vue';

    export default {
        props: ['solution', 'questionId'],

        data() {
            return {
                solutions: {},
                adding: false,
                comment: '',
            }
        },

        components: {
            'problem-solution': ProblemSolution
        },

        created() {
            var self = this;
            axios.get('/problem-question/' + this.questionId + '/solutions').then(function(response){
                self.solutions = response.data.solutions;
            });
        },

        methods: {
            submitComment(){
                var self = this;
                axios.post('/problem-question/' + this.questionId + '/solutions', {comment: this.comment}).then(function(response){
                    self.solutions.push(response.data.data);
                    self.comment = '';
                    self.adding = false;
                });
            }
        }
    }
</script>
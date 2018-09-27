<template>
    <div class="flex flex-col mt-6 ml-2">

                    <div class="flex items-center text-xl font-semibold mb-8">
                             <a
                                class="shadow-md rounded-l rounded-sm bg-white border-t border-b border-l border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light hover:text-white no-underline"
                                href="#"
                                rel="prev"

                                @click.prevent="changeQuestion(questionIndex - 1)"
                            >
                                <i class="fa fa-arrow-left text-lg"></i>
                            </a>

                              <a  v-for="(question,index) in questions" class="shadow-md border-t border-b border-l border-brand-light px-4 py-2  hover:text-white no-underline"
                                  :class="question.id == currentQuestion.id ? 'bg-brand hover:bg-brand-light text-white' : question.user_answer == null ? 'bg-white hover:bg-brand-dark text-brand' :
                                    'bg-grey-darkest text-white'"
                                  href="#" @click.prevent="changeQuestion(index)" v-text="index+1"></a>


                              <a
                                class="shadow-md rounded-r rounded-sm bg-white border-t border-b border-l border-r border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light hover:text-white no-underline"
                                href="#"
                                rel="next"

                                @click.prevent="changeQuestion(questionIndex + 1)"
                            >
                                <i class="fa fa-arrow-right text-lg"></i>
                            </a>
                        </div>

                   <div class="flex mb-6">
                    <div class="w-full">


                    <span class="problem-question block text-md tracking-wide font-normal leading-normal" >
                        <platex ref="questionBody" :sourceUrl="'/book-chapter-question/'+currentQuestion.id+'/question'"></platex>
                    </span>





                    </div>

                </div>

                <div class="flex flex-col w-full p-3 pl-0 items-stretch justify-space-around">
                        <div class="px-4 -mt-2 mb-3"  v-if="currentQuestion.is_subjective">
                            <label class="text-md text-brand font-semibold tracking-wide mb-2 block">Your Answer :</label>
                            <input type="text" v-if="currentQuestion.user_answer == null" v-model="subjective_answer" placeholder="Enter your answer" class="w-full block border rounded pl-2" style="height: 43px;font-size: 18px;">

                            <input type="text" v-else v-model="currentQuestion.user_answer" readonly class="w-full block border rounded pl-2 bg-grey-lighter" style="height: 43px;font-size: 18px;">
                        </div>
                        <ul v-else class="block w-full list-reset flex justify-space-around mb-4 mt-4">
                            <li v-for="(option,index) in currentQuestion.options"   class="block w-full pr-8 ">
                                 <div v-if="currentQuestion.user_answer == null" @click="chooseOption(index)"  @mouseover="hoveredIndex = index" @mouseleave="hoveredIndex = null" class="flex w-full block text-lg no-underline hover:bg-grey-lightest hover:rounded-2 p-2 tracking-wide cursor-pointer" :class="selectedIndex == index ? 'bg-grey-lightest' : ''">
                                    <span class="border-2 border-grey-darker p-2 mr-4 bg-grey-lighter" style="width: 35px;height: 35px;border-radius: 100%;">
                                        <span v-if="hoveredIndex == index || selectedIndex == index" class="rounded-full h-6 w-6 bg-grey-darker absolute -mt-1 -ml-1"></span>
                                    </span>
                                    <span class="mt-2 text-black" v-text="option.text"></span>
                                </div>
                                <div v-else class="flex w-full block text-lg no-underline p-2 tracking-wide cursor-pointer"
                                    :class="currentQuestion.answer == index+1 ? 'bg-white border border-grey shadow' : ''">

                                    <span class="border-2 border-grey-darker p-2 mr-4 bg-grey-lighter" style="width: 35px;height: 35px;border-radius: 100%;">
                                         <span v-if="currentQuestion.user_answer == index+1" class="rounded-full h-6 w-6 bg-grey-darker absolute -mt-1 -ml-1"></span>
                                    </span>
                                    <span class="mt-2 text-black" :class="currentQuestion.answer != index+1  ? 'text-grey-dark' : ''" v-text="option.text"></span>
                                    <img v-if="currentQuestion.answer == index+1" src="/img/thisnoe.png" style="width: 40px;height: 100%;" class="mt-1 ml-3"/>
                                </div>
                            </li>


                        </ul>

                           <div class="flex mt-6">
                        <img class="mr-4" src="/img/studentsicon.png" style="width: 70px;height: 100%;">
                        <div class="mt-3">
                            <p class="text-lg text-blue font-normal mb-2"><b class="font-semibold" v-text="currentQuestion.solvings_count"></b> people solved this.</p>
                             <p class="text-lg text-blue mt-1 font-normal"><b class="font-semibold" v-text="currentQuestion.solutions_count"></b> comments in discussion.</p>
                        </div>
                    </div>

                        <div class="answer-response" v-show="currentQuestion.user_answer != null && !currentQuestion.is_subjective">
                            <h4 v-if="currentQuestion.user_answer != currentQuestion.answer && currentQuestion.user_answer != 0" class="font-normal tracking-wide text-xl ml-4 mt-2">You answered incorrect. <img class="ml-2 -mb-1" src="/img/thumb-down.png" style="width: 30px;"></h4>

                            <h4 v-if="currentQuestion.user_answer == currentQuestion.answer" class="font-normal tracking-wide text-xl ml-4 mt-2">You answered correct. <img class="ml-2 -mb-1" src="/img/happy.png" style="width: 30px;"></h4>

                            <h4 v-if="currentQuestion.user_answer == 0" class="font-normal tracking-wide text-xl ml-4 mt-2">You viewed the solution <img class="ml-2 -mb-1" src="/img/view.png" style="width: 30px;"></h4>
                        </div>

                         <div class="answer-response" v-show="currentQuestion.user_answer != null && currentQuestion.is_subjective">
                            <h4 v-if="currentQuestion.user_answer != currentQuestion.subjective_answer && currentQuestion.user_answer != 0" class="font-normal tracking-wide text-xl ml-4 mt-2">You answered incorrect. <img class="ml-2 -mb-1" src="/img/thumb-down.png" style="width: 30px;"></h4>

                            <h4 v-if="currentQuestion.user_answer == currentQuestion.subjective_answer" class="font-normal tracking-wide text-xl ml-4 mt-2">You answered correct. <img class="ml-2 -mb-1" src="/img/happy.png" style="width: 30px;"></h4>

                            <h4 v-if="currentQuestion.user_answer == 0" class="font-normal tracking-wide text-xl ml-4 mt-2">You viewed the solution <img class="ml-2 -mb-1" src="/img/view.png" style="width: 30px;"></h4>
                        </div>

                        <button v-if="currentQuestion.user_answer == null && !currentQuestion.is_subjective" @click="submitAnswer()" class="rounded bg-orange hover:bg-orange-dark p-2 px-8 mt-6 text-md text-white font-semibold tracking-wide ml-4 mr-8"
                            :class="selectedIndex == null || currentQuestion.is_blocked  ? 'pointer-events-none cursor-not-allowed bg-orange-lightest' : 'pointer-events-auto cursor-pointer'">
                            Submit
                        </button>

                         <button v-if="currentQuestion.user_answer == null && currentQuestion.is_subjective" @click="submitSubjectiveAnswer()" class="rounded bg-orange hover:bg-orange-dark p-2 px-8 mt-6 text-md text-white font-semibold tracking-wide ml-4 mr-8"
                            :class="currentQuestion.is_blocked  ? 'pointer-events-none cursor-not-allowed bg-orange-lightest' : 'pointer-events-auto cursor-pointer'">
                            Submit
                        </button>



                        <button v-if="currentQuestion.user_answer != null && questionIndex + 1 != questions.length" @click="changeQuestion(questionIndex+1)"
                          class="rounded bg-teal hover:bg-teal-dark p-2 px-8 mt-6 text-md text-white font-semibold tracking-wide ml-4 mr-8">
                            Next Question
                        </button>

                          <button v-if="!showSolutions" @click="showSolution" class="rounded border-2 border-brand hover:bg-brand font-semibold p-2 px-8 mt-6 text-md text-brand hover:text-white tracking-wide ml-4 mr-8">
                            View Solutions
                        </button>

                        <button v-else="!showSolutions" @click="showSolutions = !showSolutions" class="rounded bg-brand font-semibold p-2 px-8 mt-6 text-md text-white tracking-wide ml-4 mr-8">
                            Hide Solutions
                        </button>

                    </div>

                <chapter-solutions v-if="showSolutions" :solution="currentQuestion.solution" :question-id="currentQuestion.id"></chapter-solutions>
                </div>
</template>

<script>

    import BookChapterSolutions from './BookChapterSolutions.vue';

    export default {
        props: ['problemSet'],

        data() {
            return {
                problem: {},
                currentQuestion: null,
                questions: [],
                hoveredIndex: null,
                selectedIndex: null,
                questionIndex: 0,
                showSolutions: false,
                subjective_answer: '',
            }
        },

        components: {
            'chapter-solutions': BookChapterSolutions
        },

        created() {
           this.problem = JSON.parse(this.problemSet);
           this.currentQuestion = this.problem.questions[0];
           this.questions = this.problem.questions


        },

        methods: {
            showSolution() {
             if(this.currentQuestion.user_answer != null)
                    {
                        this.showSolutions = !this.showSolutions;
                    } else {
                         var answer = 0;
                        var is_correct = 0;

                        var self = this;
                        axios.post('/book-chapter-question/' + this.currentQuestion.id + '/answer', { answer: answer, is_correct: is_correct})
                            .then(function(){
                                self.currentQuestion.user_answer = answer;
                                self.showSolutions = !self.showSolutions;
                            });
                    }

            },
            changeQuestion(index){
                if(index >= 0 && index < this.questions.length)
                {
                    this.selectedIndex = null;
                    this.currentQuestion = this.questions[index];
                    this.$refs.questionBody.fetchBody('/book-chapter-question/'+this.currentQuestion.id+'/question');
                    this.questionIndex = index;
                    this.showSolutions = false;
                }

            },

            chooseOption(index)
            {
                if(this.currentQuestion.user_answer == null)
                {
                      if(this.selectedIndex == index)
                        {
                             this.selectedIndex = null;
                        } else {
                             this.selectedIndex = index;
                        }
                }


            },

            submitAnswer()
            {

                var answer = this.selectedIndex + 1;
                var is_correct = answer == this.currentQuestion.answer ? 1 : 0;

                var self = this;
                axios.post('/book-chapter-question/' + this.currentQuestion.id + '/answer', { answer: answer, is_correct: is_correct})
                    .then(function(){
                        self.currentQuestion.user_answer = answer;
                    });
            },

            submitSubjectiveAnswer()
            {

                var answer = this.subjective_answer;
                var is_correct = this.subjective_answer == this.currentQuestion.subjective_answer ? 1 : 0;

                var self = this;
                axios.post('/book-chapter-question/' + this.currentQuestion.id + '/answer', { answer: answer, is_correct: is_correct})
                    .then(function(){
                        self.currentQuestion.user_answer = answer;
                    });
            }



        }
    }
</script>
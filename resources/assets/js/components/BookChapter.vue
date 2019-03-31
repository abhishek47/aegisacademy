<template>
    <div class="flex flex-col mt-6 ml-2">

                    <div class="flex items-center text-xl font-semibold mb-8 problems-paginator">
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
                       
                      

                      



                        <button v-if="questionIndex + 1 != questions.length" @click="changeQuestion(questionIndex+1)"
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

                <chapter-solutions  v-if="showSolutions"  :solution="currentQuestion.solution" :question-id="currentQuestion.id"></chapter-solutions>
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
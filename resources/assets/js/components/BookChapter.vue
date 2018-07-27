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
                                  :class="question.id == currentQuestion.id ? 'bg-brand hover:bg-brand-light text-white' : 'bg-white hover:bg-brand-dark text-brand'"
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
                        <ul class="block w-full list-reset flex justify-space-around mb-4 mt-4">
                            <li v-for="(option,index) in currentQuestion.options"   class="block w-full pr-8 ">
                                <div class="flex w-full block text-lg no-underline p-2 tracking-wide cursor-pointer"
                                    :class="currentQuestion.answer == index+1 ? 'bg-white border border-grey shadow' : ''">

                                    <span class="border-2 border-grey-darker p-2 mr-4 bg-grey-lighter" style="width: 35px;height: 35px;border-radius: 100%;">

                                    </span>
                                    <span class="mt-2 text-black" :class="currentQuestion.answer != index+1  ? 'text-grey-dark' : ''" v-text="option.text"></span>
                                    <img v-if="currentQuestion.answer == index+1" src="/img/thisnoe.png" style="width: 40px;height: 100%;" class="mt-1 ml-3"/>
                                </div>
                            </li>


                        </ul>

                         <div class="flex mt-6">
                        <img class="mr-4" src="/img/studentsicon.png" style="width: 50px;height: 100%;">
                        <div class="mt-3">
                             <p class="text-lg text-blue mt-1 font-normal"><b class="font-semibold" v-text="currentQuestion.solutions_count"></b> comments in discussion.</p>
                        </div>
                    </div>





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

                    this.showSolutions = !this.showSolutions;


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



        }
    }
</script>
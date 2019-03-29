 <!--    <div class="flex mt-6">
                        <img class="mr-4" src="/img/studentsicon.png" style="width: 70px;height: 100%;">
                        <div class="mt-3">
                            <p class="text-lg text-blue font-normal mb-2"><b class="font-semibold" v-text="currentQuestion.solvings_count"></b> people solved this.</p>
                             <p class="text-lg text-blue mt-1 font-normal"><b class="font-semibold" v-text="currentQuestion.solutions_count"></b> comments in discussion.</p>
                        </div>
                    </div> -->

                      <!--  <div class="answer-response" v-show="currentQuestion.user_answer != null && !currentQuestion.is_subjective">
                            <h4 v-if="currentQuestion.user_answer != currentQuestion.answer && currentQuestion.user_answer != 0" class="font-normal tracking-wide text-xl ml-4 mt-2">You answered incorrect. <img class="ml-2 -mb-1" src="/img/thumb-down.png" style="width: 30px;"></h4>

                            <h4 v-if="currentQuestion.user_answer == currentQuestion.answer" class="font-normal tracking-wide text-xl ml-4 mt-2">You answered correct. <img class="ml-2 -mb-1" src="/img/happy.png" style="width: 30px;"></h4>

                            <h4 v-if="currentQuestion.user_answer == 0" class="font-normal tracking-wide text-xl ml-4 mt-2">You viewed the solution <img class="ml-2 -mb-1" src="/img/view.png" style="width: 30px;"></h4>
                        </div> -->

                       <!--  <div class="answer-response" v-show="currentQuestion.user_answer != null && currentQuestion.is_subjective">
                            <h4 v-if="currentQuestion.user_answer != currentQuestion.subjective_answer && currentQuestion.user_answer != 0" class="font-normal tracking-wide text-xl ml-4 mt-2">You answered incorrect. <img class="ml-2 -mb-1" src="/img/thumb-down.png" style="width: 30px;"></h4>

                            <h4 v-if="currentQuestion.user_answer == currentQuestion.subjective_answer" class="font-normal tracking-wide text-xl ml-4 mt-2">You answered correct. <img class="ml-2 -mb-1" src="/img/happy.png" style="width: 30px;"></h4>

                            <h4 v-if="currentQuestion.user_answer == 0" class="font-normal tracking-wide text-xl ml-4 mt-2">You viewed the solution <img class="ml-2 -mb-1" src="/img/view.png" style="width: 30px;"></h4>
                        </div> -->

                     <!--   <button v-if="currentQuestion.user_answer == null && !currentQuestion.is_subjective" @click="submitAnswer()" class="rounded bg-orange hover:bg-orange-dark p-2 px-8 mt-6 text-md text-white font-semibold tracking-wide ml-4 mr-8"
                            :class="selectedIndex == null || currentQuestion.is_blocked  ? 'pointer-events-none cursor-not-allowed bg-orange-lightest' : 'pointer-events-auto cursor-pointer'">
                            Submit
                        </button> -->

                       <!--  <button v-if="currentQuestion.user_answer == null && currentQuestion.is_subjective" @click="submitSubjectiveAnswer()" class="rounded bg-orange hover:bg-orange-dark p-2 px-8 mt-6 text-md text-white font-semibold tracking-wide ml-4 mr-8"
                            :class="currentQuestion.is_blocked  ? 'pointer-events-none cursor-not-allowed bg-orange-lightest' : 'pointer-events-auto cursor-pointer'">
                            Submit
                        </button> -->


                          <!--   <button v-if="!showSolutions" @click="showSolution" class="rounded border-2 border-brand hover:bg-brand font-semibold p-2 px-8 mt-6 text-md text-brand hover:text-white tracking-wide ml-4 mr-8">
                            View Solutions
                        </button>

                        <button v-else="!showSolutions" @click="showSolutions = !showSolutions" class="rounded bg-brand font-semibold p-2 px-8 mt-6 text-md text-white tracking-wide ml-4 mr-8">
                            Hide Solutions
                        </button> -->
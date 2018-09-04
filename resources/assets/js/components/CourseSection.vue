<template>
    <div class="flex flex-col mt-6 ml-2">



                   <div class="flex mb-6">
                    <div class="w-full">


                    <span v-if="currentSection.content_type == 0" class="block text-md tracking-wide font-normal leading-normal" >
                        <platex ref="sectionBody" :body="currentSection.body"></platex>
                    </span>

                    <div v-if="currentSection.content_type == 1">
                     <video
                      id="vid1"
                      class="video-js vjs-default-skin mx-auto"

                      controls
                      width="640" height="364"
                      :data-setup="videoData"
                    >
                    </video>
                    </div>


                    <div v-if="currentSection.content_type == 2">
                    <course-problem :problem-set="currentSection.problem"></course-problem>

                    </div>




                    </div>

                </div>


                <div v-if="sections.length > 0" class="flex items-center text-xl font-semibold mb-8">
                             <a
                                class="shadow-md rounded-l rounded-sm bg-white border-t border-b border-l border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light hover:text-white no-underline"
                                href="#"
                                rel="prev"

                                @click.prevent="changeSection(sectionId - 1)"
                            >
                                <i class="fa fa-arrow-left text-lg"></i>
                            </a>

                             <a
                                class="shadow-md  bg-white border-t border-b border-l border-brand-light px-3 py-2  no-underline"
                                href="#"
                                rel="prev"
                                :class="sectionId == -1 ? 'bg-brand hover:bg-brand-light text-white' : 'bg-white hover:bg-brand-dark text-brand hover:text-white'"
                                @click.prevent="changeSection(-1)"
                            >
                                <i class="fa fa-circle text-lg"></i>
                            </a>

                              <a  v-for="(section,index) in sections" class="shadow-md border-t border-b border-l border-brand-light px-4 py-2  hover:text-white no-underline"
                                  :class="section.id == currentSection.id && sectionId != -1 ? 'bg-brand hover:bg-brand-light text-white' : 'bg-white hover:bg-brand-dark text-brand'"
                                  href="#" @click.prevent="changeSection(index)" v-text="index+1"></a>


                              <a
                                class="shadow-md rounded-r rounded-sm bg-white border-t border-b border-l border-r border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light hover:text-white no-underline"
                                href="#"
                                rel="next"

                                @click.prevent="changeSection(sectionId + 1)"
                            >
                                <i class="fa fa-arrow-right text-lg"></i>
                            </a>
                        </div>
                </div>
</template>

<script>


    export default {
        props: ['sectionSet'],

        data() {
            return {
                currentSection: null,
                mainsection: {},
                sections: [],
                sectionId: -1,
                videoData: ''
            }
        },


        created() {
          console.log(this.sectionSet);
           this.mainsection = this.sectionSet;
           this.currentSection = this.mainsection;
           this.sections = this.mainsection.subsections
           if(this.currentSection.content_type == 1)
            {
               videoData = "{ 'techOrder': ['youtube'], 'sources': [{ 'type': 'video/youtube', 'src':" + currentSection.video.url +"}] }"
            }

        },

        methods: {

            changeSection(index){
                if(index < -1) {
                    this.sectionId = -1;
                } else if(index > this.sections.length)
                {
                    this.sectionId = this.sections.length - 1;
                } else {
                    this.sectionId = index;
                if(index >= 0 && index < this.sections.length)
                {
                    this.currentSection = this.sections[index];
                    if(this.currentSection.content_type == 0)
                    {
                      this.$refs.sectionBody.fetchBody('/subsections/'+this.currentSection.id+'/body');
                    } else if(this.currentSection.content_type == 1)
                    {
                       videoData = "{ 'techOrder': ['youtube'], 'sources': [{ 'type': 'video/youtube', 'src':" + this.currentSection.video.url +"}] }"
                    }
                } else if(index == -1) {

                    this.currentSection = this.mainsection;
                    this.$refs.sectionBody.fetchBody('/course-sections/'+this.currentSection.id+'/body');

                }
                }


            },






        }
    }
</script>
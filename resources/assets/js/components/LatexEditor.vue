<template>

	<div>

		<!-- File Upload Input -->
		<div style="height:0px;overflow:hidden">
		     <form id="file-upload" method="POST" action="/image/upload" enctype="multipart/form-data">
		       <input type="file" id="fileInput" name="files" />
		     </form>
		 </div>

		<!-- Article Source Container -->
		<div  class="latex-editor" v-show="this.inEdit">
			<div class="toolbar">

            	<div class="btn-group flex" role="group" aria-label="Basic example">

				  <button type="button" @click="handleToolbarItem('h2')" class="btn btn-secondary"><i class="fa fa-heading"></i></button>
				  <button type="button" @click="handleToolbarItem('b')" class="btn btn-secondary"><i class="fa fa-bold"></i></button>
				  <button type="button" @click="handleToolbarItem('[a]')" class="btn btn-secondary"><i class="fa fa-link"></i></button>
				  <button type="button" @click="handleToolbarItem('[ul]')" class="btn btn-secondary"><i class="fa fa-list-ul"></i></button>
				  <button type="button" @click="handleToolbarItem('[table]')" class="btn btn-secondary"><i class="fa fa-table"></i></button>
				  <button type="button" @click="handleToolbarItem('[img]')" class="btn btn-secondary"><i class="fa fa-image"></i></button>
				  <button type="button" @click="handleToolbarItem('[eg]')" class="btn btn-secondary">E.g.</button>
				  <button type="button" @click="handleToolbarItem('[sn]')" class="btn btn-secondary">Sn.</button>
				  <button type="button" @click="handleToolbarItem('[th]')" class="btn btn-secondary">Th.</button>
				  <button type="button" @click="handleToolbarItem('[pr]')" class="btn btn-secondary">Pr.</button>
				  <button type="button" @click="handleToolbarItem('[def]')" class="btn btn-secondary">Def.</button>
				  <button type="button" @click="handleToolbarItem('[box]')" class="btn btn-secondary">Box</button>
				  <button type="button" @click="handleToolbarItem('[center]')" class="btn btn-secondary">Center</button>
				  <button type="button" @click="update();" class="btn btn-secondary"><i class="fa fa-eye"></i></button>

				  <button type="button" @click="saveContent();" class="btn btn-secondary"><i class="fa fa-save"></i></button>



				</div>


      		</div>
      		<div>
				<textarea v-model="source" ref="source"></textarea>
			</div>
		</div>

		<!-- Article HTML Body after conversion -->
		<portal to="edit-link">
			<button class="btn btn-link text-secondary mt-1 float-right" @click="toggleEditing()"><i class="fa fa-edit"></i> Edit</button>
		</portal>

		<div v-show="this.inEdit == false">
			<div class="text-center text-xl text-red" v-show="this.mjRunning">Please wait. Loading ...</div>
			<div class="markdown-body" ref="buffer" style="display: none;"></div>

			<div class="markdown-body" ref="preview"></div>
		</div>



	</div>


</template>


<script>


    import PracticeProblems from './PracticeProblems.vue';

    export default {


    	props: ['sourceUrl'],

    	data() {
	    	return {

	    		source: '',
	    		delay: 0,        // delay after keystroke before updating
			    preview: null,     // filled in by Init below
			    buffer: null,      // filled in by Init below
			    timeout: null,     // store setTimout id
			    mjRunning: false,  // true when MathJax is processing
			    oldText: null,     // used to check if an update is needed,
			    textarea: null,
			    buffer: null,
			    preview: null,
			    inEdit: false,

	    	}
    	},

    	components: {
            'practice-problems': PracticeProblems
        },

        mounted() {
           	var self = this;

           	// fetch source data
        	axios.get(this.sourceUrl).then(function(response){
        		self.source = response.data.body;

        		// Initialise all elements to variables

	        	self.callback = MathJax.Callback(["createPreview",self]);

	        	self.callback.autoReset = true;

	        	self.init();

				self.update();

        	});

        },

        methods: {

        	toggleEditing() {
        		this.inEdit = !this.inEdit;
        	},

        	saveContent(){
        		this.source = this.textarea.value;

        		var self = this;
        		axios.post(this.sourceUrl, {body: this.source}).then(function(){
        			self.$toastr.s("The wiki page was updated!");
        			self.update();
        		});
        	},

        	// Initialise all elements to variables
            init() {
              this.preview = this.$refs.preview;
		      this.buffer = this.$refs.buffer;
		      this.textarea = this.$refs.source;
		    },

		    // Switch the buffer and preview, and display the right one.
		    swapBuffers() {
		      var buffer = this.preview;
		      var preview = this.buffer;
		      this.buffer = buffer;
		      this.preview = preview;
		      buffer.style.display = "none";
		      buffer.style.position = "absolute";
		      preview.style.position = "";
		      preview.style.display = "";
		    },

		    // This gets called when a key is pressed in the textarea.
		    update() {
		      if (this.timeout) {clearTimeout(this.timeout)}
		      this.timeout = setTimeout(this.callback,this.delay);
		  	},


		    // Creates the preview and runs MathJax on it.
		    createPreview(){


		      	this.inEdit = false;

		      this.timeout = null;

		      if (this.mjRunning) return;

		      var text = this.textarea.value;

		      if (text === this.oldtext) return;

		      text = this.escape(text);                       //Escape tags before doing stuff
		      this.buffer.innerHTML = this.oldtext = text;
		      this.mjRunning = true;

		      MathJax.Hub.Queue(
		        ["Typeset",MathJax.Hub,this.buffer],
		        ["previewDone",this]
		      );

		    },


		    // Handler when the preview is ready to ouput
		    previewDone() {



		    	this.mjRunning = false;

		    	var text = this.buffer.innerHTML;

		    	// replace occurrences of &gt; at the beginning of a new line
		        // with > again, so Markdown blockquotes are handled correctly
		        text = text.replace(/^&gt;/mg, '>');
		        text = md.render(text) ;
		        this.buffer.innerHTML = this.aegismarked(text);

		        this.swapBuffers();

		        $('.table-of-contents').prepend('<h3 class="heading">Contents</h3>');



		    },

		    // Escape the unnessary chars
		    escape(html, encode) {
		      return html
		        .replace(!encode ? /&(?!#?\w+;)/g : /&/g, '&amp;')
		        .replace(/</g, '&lt;')
		        .replace(/>/g, '&gt;')
		        .replace(/"/g, '&quot;')
		       .replace(/'/g, '&#39;');
		    },

		    // If you want to enable such buggy fast updates, you should
		    // add something like  onkeypress="Preview.UpdateKeyPress(event)" to textarea's attributes.
		    updateKeyPress(event) {

		      if (event.keyCode < 16 || event.keyCode > 47) {
		        this.preview.innerHTML = '<p>' + md.render(this.textarea.value) + '</p>';
		        this.buffer.innerHTML = '<p>' + md.render(this.textarea.value) + '</p>';
		      }
		      this.update();


		    },


		    // AEGIS SPECIAL MARKDOWN
		    aegismarked(text)
			{

					//Example
					text = text.replace(/&lt;startexample&gt;/g,'<div class="panel example"> \r\n \
						    <div class="panel-body" ><small class="block text-md tracking-wide font-semibold mb-3">EXAMPLE</small>\r\n<div>').replace(/&lt;endexample&gt;/g, '</div></div>\r\n</div>');

			        //Solution
					text = text.replace(/&lt;startsolution&gt;/g,'</div><div class="panel solution" style="margin-bottom: 0px;"> \r\n \
						    <div class="panel-body"><small class="block text-md tracking-wide font-semibold mb-3">SOLUTION</small>\r\n<div>').replace(/&lt;endsolution&gt;/g, '</div></div>\r\n</div>');



					// Defintion
			        text = text.replace(/&lt;startdefinition&gt;/g,'<div class="panel definition"> \r\n \
						    <div class="panel-body"><small class="block text-md tracking-wide font-semibold mb-3">DEFINITION</small>\r\n<div>').replace(/&lt;enddefinition&gt;/g, '</div></div>\r\n</div>');



			        // Proof
			        text = text.replace(/&lt;startproof&gt;/g,'</div><div class="panel proof" style="margin-bottom: 0px;"> \r\n \
						    <div class="panel-body"><small class="block text-md tracking-wide font-semibold mb-3">PROOF</small>\r\n<div>').replace(/&lt;endproof&gt;/g, '</div></div>\r\n</div>');



			         // Question
			        text = text.replace(/&lt;startquestion-(\d+)&gt;/g,'<div class="slickQuiz" id="slickQuiz-$1" data-id="$1">\r\n \
								    <h1 class="quizName"></h1>\r\n \
								    <div class="quizArea">\r\n \
								        <div class="quizHeader"> \
								            <a class="startQuiz" href="">Get Started!</a> \
								        </div> \
								    </div> \
								    <div class="quizResults"> \
								        <h3 class="quizScore">You Scored: <span></span></h3> \
								        <h3 class="quizLevel"><strong>Ranking:</strong> <span></span></h3> \
								        <div class="quizResultsCopy"></div> \
								    </div>').replace(/&lt;\/endquestion&gt;/g, '</div>');



			        // Theory
			        text = text.replace(/&lt;starttheorem&gt;/g,'<div class="panel theorem"> \r\n \
						    <div class="panel-body"><small class="block text-md tracking-wide font-semibold mb-3">THEOREM</small>\r\n<div>').replace(/&lt;endtheorem&gt;/g, '</div></div>\r\n</div>');

			         // Theory
			        text = text.replace(/&lt;startbox&gt;/g,'<div class="panel box"> \r\n \
						    <div class="panel-body">\r\n<div>').replace(/&lt;endbox&gt;/g, '</div></div>\r\n</div>');

			        text = text.replace(/&lt;startcenter&gt;/g,'<p class="text-center">').replace(/&lt;endcenter&gt;/g, '</p>');

			        text = text.replace(/&lt;hr-(\d+)&gt;/g, "<hr style=\"height:$1px;\"");

			        text = text.replace(/&lt;/g, '<').replace(/&gt;/g, '>');


			         return text;

			},


			handleToolbarItem(item) {
				if(item == 'h2')
				{
					this.insertAtCaret('## Heading Comes Here')

				} else if(item == 'b')
				{
					this.insertAtCaret('**boldtext**')

				} else if(item == '[a]')
				{
					this.insertAtCaret('[Name your link](https://www.link.com)')

				} else if(item == '[img]')
				{
					$("#fileInput").click();

					var self = this;

                    $("#fileInput").change(function (){

                      console.log("FORM IS SUBMITTING");

                        var formData = new FormData();

                        formData.append('files', $('input[type=file]#fileInput')[0].files[0]);

                        console.log(formData);



                        axios.post('/image/upload', formData).then(function(response){
                        	self.insertAtCaret('![alt text]('+ response.data.src + ' "Image Title")');
                        });

                    });


				} else if(item == '[a]')
				{
					this.insertAtCaret('[Name your link](https://www.link.com)')

				} else if(item == '[ul]')
				{
					this.insertAtCaret('* Item 1\r\n* Item 2')

				} else if(item == '[eg]')
				{
					this.insertAtCaret("<startexample>\r\n\r\n<endexample>");

				} else if(item == '[sn]')
				{
					this.insertAtCaret("<startsolution>\r\n\r\n<endsolution>");

				} else if(item == '[th]')
				{
					this.insertAtCaret("<starttheorem>\r\n\r\n<endtheorem>");

				} else if(item == '[pr]')
				{
					this.insertAtCaret("<startproof>\r\n\r\n<endproof>");

				} else if(item == '[box]')
				{
					this.insertAtCaret("<startbox>\r\n\r\n<endbox>");

				} else if(item == '[def]')
				{
					this.insertAtCaret("<startdefinition>\r\n\r\n<enddefinition>");

				} else if(item == '[center]')
				{
					this.insertAtCaret("<startcenter>\r\n\r\n<endcenter>");

				}
			},




			insertAtCaret(text) {

					var txtarea = this.$refs.source;
					if (!txtarea) { return; }

					var scrollPos = txtarea.scrollTop;
					var strPos = 0;
					var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
						"ff" : (document.selection ? "ie" : false ) );
					if (br == "ie") {
						txtarea.focus();
						var range = document.selection.createRange();
						range.moveStart ('character', -txtarea.value.length);
						strPos = range.text.length;
					} else if (br == "ff") {
						strPos = txtarea.selectionStart;
					}

					var front = (txtarea.value).substring(0, strPos);
					var back = (txtarea.value).substring(strPos, txtarea.value.length);
					txtarea.value = front + text + back;
					strPos = strPos + text.length;
					if (br == "ie") {
						txtarea.focus();
						var ieRange = document.selection.createRange();
						ieRange.moveStart ('character', -txtarea.value.length);
						ieRange.moveStart ('character', strPos);
						ieRange.moveEnd ('character', 0);
						ieRange.select();
					} else if (br == "ff") {
						txtarea.selectionStart = strPos;
						txtarea.selectionEnd = strPos;
						txtarea.focus();
					}

					txtarea.scrollTop = scrollPos;
			}


        }


    }
</script>
<template>
	
	<div>

		<!-- Article Source Container -->
		<textarea id="source" class="hidden">{{ this.source }}</textarea>

		<!-- Article HTML Body after conversion -->
		<div class="markdown-body" id="buffer" style="display:none;position:absolute;top:0; left: 0"></div>

		<div id="preview"></div>

		

	</div>


</template>


<script>
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

	    	}	
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

        	// Initialise all elements to variables
            init() {
              this.preview = document.getElementById("preview");
		      this.buffer = document.getElementById("buffer");
		      this.textarea = document.getElementById("source");
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
					text = text.replace(/&lt;startexample&gt;/g,'<div class="panel panel-default example"> \r\n \
						    <div class="panel-body" style="padding:0px;padding-top:15px;"><small style="padding-left:15px;" class="text-muted">EXAMPLE</small>\r\n<div style="padding-left:15px;">').replace(/&lt;endexample&gt;/g, '</div></div>\r\n</div>');
			         
			        //Solution	
					text = text.replace(/&lt;startsolution&gt;/g,'</div><div class="panel panel-default solution" style="margin-bottom: 0px;"> \r\n \
						    <div class="panel-body"><small class="text-muted">SOLUTION</small>\r\n<div>').replace(/&lt;endsolution&gt;/g, '</div></div>\r\n</div>');
			         


					// Defintion
			        text = text.replace(/&lt;startdefinition&gt;/g,'<div class="panel panel-default definition"> \r\n \
						    <div class="panel-body"><small class="text-muted">DEFINITION</small>\r\n<div>').replace(/&lt;enddefinition&gt;/g, '</div></div>\r\n</div>');



			        // Proof
			        text = text.replace(/&lt;startproof&gt;/g,'</div><div class="panel panel-default proof" style="margin-bottom: 0px;"> \r\n \
						    <div class="panel-body"><small class="text-muted">PROOF</small>\r\n<div>').replace(/&lt;endproof&gt;/g, '</div></div>\r\n</div>');
			        


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
			        text = text.replace(/&lt;starttheorem&gt;/g,'<div class="panel panel-default theorem"> \r\n \
						    <div class="panel-body" style="padding:0px;padding-top:15px;"><small class="text-muted" style="padding-left:15px;">THEOREM</small>\r\n<div style="padding-left:15px;">').replace(/&lt;endtheorem&gt;/g, '</div></div>\r\n</div>');

			         // Theory
			        text = text.replace(/&lt;startbox&gt;/g,'<div class="panel panel-default box"> \r\n \
						    <div class="panel-body">\r\n<div>').replace(/&lt;endbox&gt;/g, '</div></div>\r\n</div>');

			        text = text.replace(/&lt;startcenter&gt;/g,'<p class="text-center">').replace(/&lt;endcenter&gt;/g, '</p>');

			        text = text.replace(/&lt;hr-(\d+)&gt;/g, "<hr style=\"height:$1px;\"");
			        
			        text = text.replace(/&lt;/g, '<').replace(/&gt;/g, '>');

			       
			         return text;
			         
			}

        }


    }
</script>
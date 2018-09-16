function aegismarked(text)
{

		//Example
		text = text.replace(/&lt;startexample&gt;/g,'<div class="panel example"> \r\n \
			    <div class="panel-body" ><small class="text-muted">EXAMPLE</small>\r\n<div style="">').replace(/&lt;endexample&gt;/g, '</div></div>\r\n</div>');

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
        text = text.replace(/&lt;startquestion-(\d+)&gt;/g,'<practice-problems>')
              .replace(/&lt;\/endquestion&gt;/g, '</practice-problems>');



        // Theory
        text = text.replace(/&lt;starttheorem&gt;/g,'<div class="panel panel-default theorem"> \r\n \
			    <div class="panel-body" ><small class="text-muted" style="padding-left:15px;">THEOREM</small>\r\n<div style="padding-left:15px;">').replace(/&lt;endtheorem&gt;/g, '</div></div>\r\n</div>');

         // Theory
        text = text.replace(/&lt;startbox&gt;/g,'<div class="panel panel-default box"> \r\n \
			    <div class="panel-body">\r\n<div>').replace(/&lt;endbox&gt;/g, '</div></div>\r\n</div>');

        text = text.replace(/&lt;startcenter&gt;/g,'<p class="text-center">').replace(/&lt;endcenter&gt;/g, '</p>');

        text = text.replace(/&lt;hr-(\d+)&gt;/g, "<hr style=\"height:$1px;\"");

        text = text.replace(/&lt;/g, '<').replace(/&gt;/g, '>');


         return text;

}
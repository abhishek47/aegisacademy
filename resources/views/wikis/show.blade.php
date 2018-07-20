@extends('layouts.app')

@section('title')
  
  {{ $wiki->title }} | Aegis Academy

@endsection


@section('css')

	@include('partials.wiki._latex')

@endsection


@section('content')

<div class="container">
<div class="page-header">
  <h2>{{ $wiki->title }}</h2>

  <i class="hidden" id="wid">{{ $wiki->id }}</i>

	<a href="#" id="edit" style="color: #313131;" onclick="toggleEditor()"><i class="fa fa-edit"></i> Edit this wiki</a> 
 
</div>  
   <form method="POST" action="/wiki/update/{{ $wiki->id }}">
   {{ csrf_field() }}
   <div id="editor--container" class="hidden">


     <div>
       <div class="pull-right"> 
       	  <a href="#" class="btn btn-default btn-flat" onclick="toggleEditor()">Cancel</a> &nbsp;
       	  <a href="#" class="btn btn-colored btn-theme-colored2 btn-flat" onclick="inEdit=true;Preview.Update()">Preview</a> &nbsp;
          <button type="submit" class="btn btn-colored btn-success btn-flat" >Update</button> &nbsp;
       </div>
     </div>


     <div class="clearfix"></div>

   
   <div id="editor" class="editor--toolbar" style="margin-top: 20px;">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"> 
        <div class="btn-group" role="group" aria-label="First group"> 
            <button type="button" title="Add Heading" data-toggle="tooltip" class="btn btn-default" onclick="addHeader();return false;"><i class="fa fa-header"></i></button>
            <button type="button" title="Add Link" data-toggle="tooltip" class="btn btn-default" onclick="addLink();return false;"><i class="fa fa-link"></i></button>  
            <button type="button" title="Add List" data-toggle="tooltip" class="btn btn-default" onclick="addList();return false;"><i class="fa fa-list-ul"></i></button> 
            <button type="button" title="Add Numbered List" data-toggle="tooltip" class="btn btn-default" onclick="addNList();return false;"><i class="fa fa-list-ol"></i></button> 
            <button type="button" title="Add Table" data-toggle="tooltip" class="btn btn-default" onclick="addTable();return false;"><i class="fa fa-table"></i></button> 
            <button type="button" title="Add Image" data-toggle="tooltip" class="btn btn-default" onclick="addImage();return false;"><i class="fa fa-photo"></i></button> 
            <vue-core-image-upload
            class="btn btn-default"
            :crop="false"
            @imageuploaded="imageuploaded"
            :max-file-size="5242880"
            url="/image/upload" >
          </vue-core-image-upload>
         </div> 
         <div class="btn-group" role="group" aria-label="Second group"> 
            <button type="button" title="Add Example" data-toggle="tooltip" class="btn btn-default" onclick="addExample();return false;">E.g.</button>
            <button type="button" title="Add Solution" data-toggle="tooltip" class="btn btn-default" onclick="addSoln();return false;">Soln.</button>
            <button type="button" title="Add Theorem" data-toggle="tooltip" class="btn btn-default" onclick="addTheorem();return false;">Theorem</button>  
            <button type="button" title="Add Proof" data-toggle="tooltip" class="btn btn-default" onclick="addProof();return false;">Proof</button>
             <button type="button" title="Add Problems Section" class="btn btn-default" data-toggle="modal" data-target="#myModal" ><i class="fa fa-question-circle"></i></button> 
         </div> 
         <div class="btn-group" role="group" aria-label="Third group"> 
            <button type="button" title="Add Definition" data-toggle="tooltip" class="btn btn-default" onclick="addDef();return false;">Df.</button> 
             <button type="button" title="Add Table of Contents" data-toggle="tooltip" class="btn btn-default" onclick="addToc();return false;"><i class="fa fa-list-alt"></i></button> 
            <button type="button" title="Align to Center" data-toggle="tooltip" class="btn btn-default" onclick="addCenterAlign();return false;"><i class="fa fa-align-center"></i></button> 
            <button type="button" title="Add Box" data-toggle="tooltip" class="btn btn-default" onclick="addBox();return false;">Box</button> 
         </div> 
          <div class="btn-group" role="group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Line
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="addLine(1);return false;">
             <svg width="100" height="1">
                <rect width="100" height="1" 
                style="fill:#989898;stroke-width:0" />
              Sorry, your browser does not support inline SVG.
              </svg>
              </a>
             </li>
             <li><a href="#" onclick="addLine(2);return false;"><svg width="100" height="2">
                <rect width="100" height="2" 
                style="fill:#989898;stroke-width:0" />
              Sorry, your browser does not support inline SVG.
              </svg></a></li>
              <li><a href="#" onclick="addLine(3);return false;"><svg width="100" height="3">
                <rect width="100" height="3" 
                style="fill:#989898;stroke-width:0" />
              Sorry, your browser does not support inline SVG.
              </svg></a></li>
          </ul>
        </div>
      </div>
	    <textarea id="marked-mathjax-input" style="height: 1700px;" name="comment" class="form-control">{{ $wiki->body }}
	    </textarea>

    </div>

    </div>






  <div id="main--output" style="width: 100%;" class="markdown-body hidden">
  <div class="preview" id="marked-mathjax-preview"></div>
  <div class="preview" id="marked-mathjax-preview-buffer" 
       style="display:none;
              position:absolute; 
              top:0; left: 0"></div>
</div>


</form>




  </div>         	



          



@endsection

@section('js')


  
  <script>
Preview.Init();
Preview.Update();


$(':radio').change(function() {
  console.log('New star rating: ' + this.value);
});

</script>

<script type="text/javascript">
  $('#likeBtn').click(function(e)
  {
      e.preventDefault();

      $.get('/wiki/{{$wiki->id}}/like', function(data, status){
       

         if(data.msg == 'liked')
         {
            $('#likeBtn').html('<i class="fa fa-thumbs-up"></i> ' + data.likes + ' Likes');
         } else {
            $('#likeBtn').html('<i class="fa fa-thumbs-o-up"></i> ' + data.likes + ' Likes');
         }

      });
  });
</script>



 <script type="text/javascript" src="/js/functions.js"></script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>



@endsection


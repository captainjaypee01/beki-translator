@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
 
<section class="jumbotron text-center" style="background-image: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);">
    <div class="container">
        <h1 class="jumbotron-heading text-white">Beki Translator</h1>
        <p class="lead text-muted">There are  oducts available</p>  
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header"> 
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="language" id="language_english" value="english" checked>
                            <label class="form-check-label" for="inlineRadio1">English</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="language" id="language_tagalog" value="tagalog">
                            <label class="form-check-label" for="inlineRadio2">Tagalog</label>
                        </div>  
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                            <button type="button" class="btn btn-secondary btn-sm ml-1 btn-clear-text" id="btn-clear-text" data-toggle="tooltip" title="Clear Text"><i class="fas fa-times"></i></button>
                        </div><!--btn-toolbar--> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                
                            </div>    
                        </div> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <textarea name="from" class="form-control"  id="from" cols="30" rows="10"></textarea>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">

                <div class="card">
                    <div class="card-header">
                        Beki Language
                    </div>
                    <div class="card-body"> 
                        <div id="section-word-list" style="display:none;"></div>
                        <div class="form-group" id="section-text-to">
                            <textarea name="to" class="form-control" id="to" cols="30" rows="10" readonly></textarea> 
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</section>
@endsection

@push('after-scripts')
 
<script>
    $(document).ready(function(){
        function clearFields(){
            $("#from").val("");
            $("#to").val("");
            $("#to").show();
            $("#section-word-list").hide();
        }
        function fromValue(){
            var radioValue = $("input[name='language']:checked").val(); 
            var val = $("#from").val();
            console.log(val);
            if(val != ""){
                $.ajax({
                    url: '{{ route("frontend.translate") }}' + '?q=' + val + '&language=' + radioValue,
                    type : "GET",
                    dataType : 'json',
                    success : function(response){ 
                        if(response.words){
                            if(response.words.length > 1){
                                $("#to").hide();
                                html = '<div class="list-group">';
                                var words = response.words;
                                for (let index = 0; index < response.words.length; index++) {
                                    
                                    html += '<div class="list-group-item list-group-item-action " data-id="'+ words[index].id +'" data-name="'+ words[index].name +'">'
                                        +       '<div class="d-flex w-100 justify-content-between">'
                                        +           '<h5 class="mb-1">'+ words[index].name +'</h5>'
                                        +       '</div>'
                                        +       '<details class="text-left mb-2">'
                                        +           '<summary>Description</summary>'
                                        +           '<p><small>'+ words[index].description +'</small></p>'
                                        +       '</details>'
                                        +       '<a href="#" class="btn btn-outline-info btn-sm list-word" data-id="'+ words[index].id +'" data-name="'+ words[index].name +'">Select</a>'
                                        + '</div>';
                                        
                                }
                                words += '</div>';
                                $("#section-word-list").html(html);
                                $("#section-word-list").show();
                            }
                            
                            else{
                                $("#section-word-list").hide();
                                $("#to").show();
                                $("#to").val(response.words.name);
                            }
                        }
                        else{
                            $("#to").val("No available beki words");
                        }
                        console.log(response);
                    },
                    error : function(response){
                        console.log(response);
                    }
                });
            }
            else{
                clearFields();
            }
        }        
 
        $('#from').keyup(function(){
            fromValue();
        });
        
        $('input[type=radio][name=language]').change(function() { 
            fromValue();
        });
        $("#btn-clear-text").click(function(){
                clearFields();
        });
        $(document).on('click', '.list-word', function(){
            var d = $(this).data('name');
            $("#to").val(d);
            $("#to").show();
            $("#section-word-list").hide();
            console.log(d);
        }); 
    }); 
        
</script>
@endpush


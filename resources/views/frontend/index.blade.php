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
                        <div class="form-group">
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
        function fromValue(){
            var input = $("#from").val();
            // $("#txtHere").text(input);
            console.log(input);
        }       
        fromValue();
 
        $('#from').keyup(function(){
            fromValue();
        });
 
    });
    console.log('test');
     $("#from").change(function(e){
        var radioValue = $("input[name='language']:checked").val();
        if(radioValue){ 

        }
        var val = $("#from").val();
        $.ajax({
            url: '{{ route("frontend.translate") }}' + '?q=' + val + '&language=' + radioValue,
            type : "GET",
            dataType : 'json',
            success : function(response){ 
                if(response.words){
                    $("#to").val(response.words.name);
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
        console.log(val);
     });
</script>
@endpush


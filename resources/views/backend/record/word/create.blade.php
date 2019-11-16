@extends('backend.layouts.app')

@section('title', 'Word Management' . ' | ' . 'Create Word')

@section('content')
{{ html()->form('POST', route('admin.record.word.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Word Management
                        <small class="text-muted">Create Word</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
             
            <div class="row">
                <div class="col col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Name")->for('name') }}
                        {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder('Name')
                                ->attribute('maxlength', 191)
                                ->required() }} 
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Description")->for('name') }}
                        {{ html()->textarea('description')
                                ->class('form-control')  
                                ->required() }} 
                    </div>
                </div> 
            </div>
             

        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.record.word.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection


@push('after-scripts')
 
<script>
    var html = '';
    var ctr = 1;
    $("#btn-add-word").click(function(){
        html = '<div class="col col-sm-4">'
                    + '<div class="form-group">'
                    + '<label> Word ' + ctr + '</label>' 
                    +  '<input type="text" class="form-control" name="translates[]">'
                    + '</div></div>';
        $("#section-translates").append(html);
        ctr++;
    });
</script>
@endpush


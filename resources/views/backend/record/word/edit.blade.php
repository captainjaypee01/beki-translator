@extends('backend.layouts.app')

@section('title', 'Word Management' . ' | ' . 'Edit Word')

@section('content') 
{{ html()->modelForm($word, 'PATCH', route('admin.record.word.update', $word))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Word
                        <small class="text-muted">Edit Word</small>
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
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection

 


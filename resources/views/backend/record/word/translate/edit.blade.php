@extends('backend.layouts.app')

@section('title', 'Word Management' . ' | ' . 'Edit Word')

@section('content') 
{{ html()->modelForm($translate, 'PATCH', route('admin.record.word.translate.update', [$word, $translate]))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0 text-capitalize">
                        {{ $word->name }}
                        <small class="text-muted">Edit Translation</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
             
            <div class="row"> 
                <div class="col">
                    <div class="form-group"> 
                        {{ html()->label("Name")->for('name') }}

                        {{ html()->text('name')
                            ->class('form-control')
                            ->placeholder('Name') }}
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ html()->label("Root word")->for('root_word') }}

                        {{ html()->text('root_word')
                            ->class('form-control')
                            ->placeholder('Root word') }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="">Language</label>
                        <select name="language" id="language" class="form-control">
                            <option selected readonly>Select language</option>
                            <option value="english" {{ $translate->language == 'english' ? 'selected' : '' }} >English</option>
                            <option value="tagalog" {{ $translate->language == 'tagalog' ? 'selected' : '' }}>Tagalog</option>
                        </select>
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

 


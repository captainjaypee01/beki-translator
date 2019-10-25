

<div class="modal fade login-modal" id="add-translation-modal" tabindex="-1" role="dialog" aria-labelledby="add-translation-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Add Translation
            </div>
            
            {{ html()->form('POST', route('admin.record.word.translation.add', $word))->attribute("enctype","multipart/form-data")->class('form-horizontal')->open() }}
            <div class="modal-body">
                <div class="container-fluid login-wrapper"> 
                    <input type="hidden" name="word" value="{{ $word->id }}">
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
            
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning">Submit</button>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>

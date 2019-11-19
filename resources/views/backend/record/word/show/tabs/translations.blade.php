

    <div class="row mb-4">
            <div class="col">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-translation-modal">
                    Add Translation
                </button>   
            </div>
            @include('backend.record.word.show.modals.add-translation')
        </div>
    @if(count($wordTranslations) > 0)
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover"> 
                <thead>
                    <tr>
                        <th>Name</th>  
                        <th>Root Word</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($wordTranslations as $translation)
                    <tr>
                        <td>{{ $translation->name }}</td>
                        <td>{{ $translation->root_word }}</td>
                        <td>{{ $translation->language }}</td>
                        <td>{!! $translation->status_label !!}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.record.word.translate.edit', [$word, $translation]) }}">Edit </a>
                            <a href="{{ route('admin.record.word.translation.remove', [$word, $translation]) }}" class="btn btn-warning btn-sm">Remove </a>
                        </td>
                    </tr>
                    @endforeach   
    
                </tbody>
     
            </table>
        </div>
    </div><!--table-responsive-->
    @else
        <div class="row align-items-center justify-content-md-center">
            <div class="col-lg-3 col-xl-2 text-center">
                <img src="{{ asset('img/frontend/no_data.png') }}" height="200" class="mt-4">
            </div>
            <div class="col-lg-3 text-center">
                <h1 class="display-4">Oops..</h1>
                <p class="lead"><strong>There are no translations assigned to this word. Please asssign atleast 1 translation in this word</strong></p>
            </div>
        </div>
    @endif
    
    
    
    
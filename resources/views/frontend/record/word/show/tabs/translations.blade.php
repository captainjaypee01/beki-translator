
    <div class="row mb-4 mt-4">
        <div class="col">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-translation-modal">
                    Add Translation
                </button>   
        </div>
        @include('frontend.record.word.show.modals.add-translation')
    </div>
    @if(count($wordTranslations) > 0)
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover"> 
                    <thead>
                        <tr>
                            <th>Name</th>  
                            <th>Language</th>
                            <th>Date Added</th>
                            <th></th>
                        </tr>
                    </thead> 
                    <tbody>
                        @foreach($wordTranslations as $translation)
                        <tr>
                            <td>{{ $translation->name }}</td>
                            <td>{{ $translation->language }}</td>
                            <td>{!! timezone()->convertToLocal($translation->created_at) !!}</td>
                            <td> 
                                @if(auth()->user()->id == $translation->user_id)
                                <a href="{{ route('frontend.record.word.translation.remove', [$word, $translation]) }}" class="btn btn-warning btn-sm">Remove </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach   
        
                    </tbody>
        
                </table>
            </div>
        </div><!--table-responsive-->
    </div>
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
    
    
    
    
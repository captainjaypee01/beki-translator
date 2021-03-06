@extends('backend.layouts.app')

@section('title', 'Word Management' . ' | ' . 'Show Word')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Word Management
                    <small class="text-muted">View Word</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.overview')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-translations" data-toggle="tab" href="#translations" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i>Translations</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        @include('backend.record.word.show.tabs.overview')
                    </div><!--tab-->
                    <div class="tab-pane " id="translations" role="tabpanel" aria-expanded="true">
                        @include('backend.record.word.show.tabs.translations')
                    </div><!--tab-->
                </div><!--tab-content-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($word->created_at) }} ({{ $word->created_at->diffForHumans() }}),
                    <strong>@lang('labels.backend.access.users.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($word->updated_at) }} ({{ $word->updated_at->diffForHumans() }})
                    @if($word->trashed())
                        <strong>@lang('labels.backend.access.users.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($word->deleted_at) }} ({{ $word->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection


@push('after-scripts')
<script>
// Javascript to enable link to tab
        var url = document.location.toString();
        console.log(url);
        if (url.match('#') && url.split('#')[1].length>0) {
             $('#tab-' + url.split('#')[1]).tab('show');
        } else {
            
            $("#tab-overview").tab('show');  
        }

        // Change hash for page-reload then scroll to top
        window.location.hash = '';
        window.scrollTo(0, 0);
</script>
@endpush
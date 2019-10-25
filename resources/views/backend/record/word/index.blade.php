@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Word Management <small class="text-muted">Active Words</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.record.word.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col-sm-5">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="{!! $search !!}" name="search"  aria-label="Search">
                      
                    <button class="btn btn-outline-success my-2 my-sm-0 mr-2"  type="submit">Search</button>
                    <button class="btn btn-outline-info my-2 my-sm-0" type="">Clear</button>
                </form>
            </div><!--col-->

        </div><!--row-->
        @if(count($words) > 0)
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="word-table" class="table">
                        <thead>
                        <tr>
                            <th>No.</th> 
                            <th>Name</th> 
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($words as $index => $word) 
                            <tr>
                                <td>{{  ($words->perPage() * $words->currentPage() - $words->perPage()) + ($loop->iteration) }}</td> 
                                <td>{{ $word->name }}</td> 
                                <td>{!! $word->status_label !!}</td>
                                <td>{!! $word->action_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $words->total() !!} {{ "Words Total" }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right"> 
                    {!! $words->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
        
        @else
            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-3 col-xl-2 text-center">
                    <img src="{{ asset('img/frontend/no_data.png') }}" height="200" class="mt-4">
                </div>
                <div class="col-lg-3 text-center">
                    <h1 class="display-4">Oops..</h1>
                    <p class="lead"><strong>No data in here. Try to modify filters to search records.</strong></p>
                </div>
            </div>
        @endif
    </div><!--card-body-->
</div><!--card-->
@endsection

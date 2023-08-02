@extends('layouts.main')

@section('title', 'Contact App | All Companies')

@section('content')

<!-- content -->
<main class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header card-title">
                    <div class="d-flex align-items-center">
                    <h2 class="mb-0">
                        All Companies
                        @if (request()->query('trash'))
                            <small>(In Trash)</small>
                        @endif
                    </h2>
                    <div class="ml-auto">
                        <a href="{{ route('companies.create')  }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                    </div>
                </div>
                <div class="card-body">

                {{--Child View Render --}}
                {{-- @include('companies._filters') --}}

                {{--Session Message Flash Get--}}
                {{-- @if ($message = session('message'))
                    <div class="alert alert-success">
                        {{ $message }}
                        @if ($undoRoute = session('undoRoute'))
                        <form action="{{ $undoRoute }}" method="POST" style="display: inline">
                            @csrf
                            @method('delete')
                            <button class="btn alert-link">Undo</button>
                        </form>
                        @endif
                    </div>
                @endif --}}

                @include('shared.filters')

                @include('shared.flash')

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">
                            {!! sortable("Name") !!}
                            </th>
                            <th scope="col">
                            {!! sortable("Website") !!}
                            </th>
                            <th scope="col">
                            {!! sortable("Email") !!}
                            </th>
                        
                        <th scope="col">Contacts</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php
                        $showTrashButtons = request()->query('trash') ? true : false
                    @endphp

                    @if (count($companies) > 0)

                        @foreach ($companies as $index => $company)

                            {{-- Render Parent Variables on Child Views --}}
                            @include('companies._company', ['company' => $company, 'index' => $index])

                        @endforeach

                    @else

                        @include('shared.empty', ['numCol' => 7])
                        
                    @endif
                    
                    </tbody>
                </table> 
                
                {{-- If needed parameters appended in pagination --}}
                {{$companies->withQueryString()->links()}}

            </div>
        </div>
        </div>
    </div>
    </div>
</main>

@endsection


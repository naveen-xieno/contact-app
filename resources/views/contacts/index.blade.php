@extends('layouts.main')

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body> --}}

        @section('title', 'Contact App | All Contacts')

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
                            All Contacts
                            @if (request()->query('trash'))
                                <small>(In Trash)</small>
                            @endif
                        </h2>
                        <div class="ml-auto">
                            <a href="{{ route('contacts.create')  }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">

                    {{--Child View Render --}}
                    {{-- @include('contacts._filters') --}}

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

                    @include('shared.filters', [
                        'filterDropdown' => 'contacts._companies-selection'
                    ])

                    @include('shared.flash')

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">First Name</th> 
                            <th scope="col">Last Name</th>
                            <th scope="col">Phone</th> --}}
                            <th scope="col">
                                {!! sortable("First Name") !!}
                              </th>
                              <th scope="col">
                                {!! sortable("Last Name") !!}
                              </th>
                              <th scope="col">Phone</th>
                              <th scope="col">
                                {!! sortable("Email") !!}
                              </th>
                            
                            <th scope="col">Company</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $showTrashButtons = request()->query('trash') ? true : false
                        @endphp

                        @if (count($contacts) > 0)

                            @foreach ($contacts as $index => $contact)

                            {{--@continue($id == 2);
                            @break($id == 3); --}}

                            {{-- Child Element Automatically Render Parent Variables
                            @include('contacts._contact') --}}

                                {{-- Render Parent Variables on Child Views --}}
                                @include('contacts._contact', ['contact' => $contact, 'index' => $index])

                            @endforeach

                        @else

                            @include('shared.empty', ['numCol' => 7])
                            
                        @endif
                        
                        </tbody>
                    </table> 

                    {{-- {{$contacts->links()}} --}}
                    
                    {{-- If needed parameters appended in pagination --}}
                    {{$contacts->withQueryString()->links()}}
    
                    {{-- <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav> --}}
                </div>
            </div>
            </div>
        </div>
        </div>
    </main>

        {{-- <h1>All Contacts</h1>

       <div>
            <a href='{{ route('contacts.create')  }}'>Create Contact</a>

            <?php //foreach ($contacts as $id => $contact): ?>
            <p>{{$contact['name'] }} | {{$contact['phone'] }} | <a href='{{ route('contacts.show', $id)  }}'>Show</a>
               
            <?php //endforeach; ?>
            
        </div> --}}

        @endsection
    
    {{-- </body>
</html> --}}

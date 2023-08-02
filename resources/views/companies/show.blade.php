@extends('layouts.main')

@section('title', 'Contact App | Company ' . $company['name']);

@section('content')

  <!-- content -->
  <main class="py-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-title">
              <strong>Company Details</strong>
            </div>           
            {{-- <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="first_name" class="col-md-3 col-form-label">Name</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">{{$contact['name']}}</p>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="last_name" class="col-md-3 col-form-label">Last Name</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">Kuhlman</p>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label">Email</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">alfred@test.com</p>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="phone" class="col-md-3 col-form-label">Phone</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">{{$contact['phone']}}</p>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Address</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">Lorem ipsum dolor</p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="company_id" class="col-md-3 col-form-label">Company</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">Company One</p>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <a href="#" class="btn btn-info">Edit</a>
                        <a href="#" class="btn btn-outline-danger">Delete</a>
                        <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Name</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">{{ $company->name }}</p>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="website" class="col-md-3 col-form-label">Website</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">{{ $company->website }}</p>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label">Email</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">{{ $company->email }}</p>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Address</label>
                    <div class="col-md-9">
                      <p class="form-control-plaintext text-muted">{{ $company->address }}</p>
                    </div>
                  </div>
                
                  <hr>
                  <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info">Edit</a>
                        {{-- <form action="{{ route('companies.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline"> --}}
                        {{-- <form action="{{ route('companies.destroy', $contact->id) }}" method="POST" style="display: inline"> --}}
                        {{-- <form action="{{ route('companies.destroy', ['company' => $company->id, 'redirect' => 'companies.index']) }}" method="POST" style="display: inline">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-outline-danger" title="Delete">Delete</button>
                      </form> --}}

                        @include('shared.buttons.destroy', [
                          'action' => route('companies.destroy', ['company' => $company->id, 'redirect' => 'companies.index']),
                          'buttonStyle' => 'default'
                        ])
                      
                        <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  @endsection
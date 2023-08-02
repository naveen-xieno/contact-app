{{-- <select class="custom-select">
    <option value="" selected>All Companies</option>
  
    @foreach($companies as $id => $company)
        <option value="{{ $id }}">{{ $company['name'] }}</option>
    @endforeach 

</select> --}}

{{-- <form>  --}}
{{-- <select class="custom-select" onchange="this.form.submit()" name="company_id" id="search-select"> --}}
    <select class="custom-select search-select" name="company_id" onchange="this.form.submit()">
    <option value="" selected>All Companies</option>

    {{-- @php
        echo '<pre>';
        print_r($companies);
        echo '</pre>';
        die;
    @endphp --}}
  
    @foreach($companies as $id => $company)
        {{-- <option value="{{ $id }}">{{ $company->name }}</option> --}}
         <option value="{{ $id }}" @if ($id == request()->query('company_id')) selected @endif >{{ $company }}</option> 
    @endforeach 

</select>
{{-- </form> --}}
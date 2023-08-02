<div class="row">
    <div class="col-md-6">
        <div class="row">
          <div class="col">
            <a href="{{ request()->fullUrlWithQuery(['trash' => false]) }}" class="btn {{ !request()->query('trash') ? 'text-primary' : 'text-secondary' }}">All</a> | 
            <a href="{{ request()->fullUrlWithQuery(['trash' => true]) }}" class="btn {{ request()->query('trash') ? 'text-primary' : 'text-secondary' }}">Trash</a>
          </div>
        </div>
      </div>
    <div class="col-md-6">
        <form>
            <input type="hidden" name="trash" value="{{ request()->query('trash') }}">
            <div class="row">
                <div class="col">
                {{--Child View Child View Render 
                @include('contacts._companies-selection')

                @includeIf('contacts._companies-selection')

                @includeUnless(empty($companies), 'contacts._companies-selection')
                --}}

                {{-- @includeWhen(!empty($companies), 'contacts._companies-selection') --}}

                @isset($filterDropdown)
                    @includeIf($filterDropdown)
                @endisset

                </div>
                <div class="col">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" value="{{ request()->query('search') }}" id="search-input" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
                    <div class="input-group-append">
                        {{-- @if(request()->filled('search') || request()->filled('company_id'))
                            <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('search-input').value = '', document.getElementById('search-select').selectedIndex = 0, this.form.submit()">
                                <i class="fa fa-refresh"></i>
                            </button>
                        @endif --}}

                        <button class="btn btn-outline-secondary" id="reset-filter-btn" type="button">
                            <i class="fa fa-refresh"></i>
                        </button>

                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                    </div>
                </div>
            </div>
        </form>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('reset-filter-btn').addEventListener('click', () => {
            let input = document.getElementById('search-input'); 
            let selects = document.querySelectorAll('.search-select');
            if (input) {
                input.value = "";
            }
            selects.forEach(select => {
                select.selectedIndex = 0;
            });

            window.location.href = window.location.href.split('?')[0]
        })

        const toggleClearButton = () => {
            let query = location.search;
            let pattern = /[?&]search=/; // ?search= or ?company_id&search=
            let button = document.getElementById('reset-filter-btn');
            if (pattern.test(query)) {
                button.style.display = "block";
            } else {
                button.style.display = "none";
            }
        }
        toggleClearButton();
    </script>
@endpush
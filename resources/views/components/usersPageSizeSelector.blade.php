<div class="row p-1">
    <div class="col-sm-1">
        <label for="pageSize" class="col-form-label">{{ __('locale.page_size') }}</label>
        <select name="pageSize" aria-controls="" class="form-control" id="pageSizeSelect">
            <option value="10" @if($pageSize === 10) selected @endif>10</option>
            <option value="25" @if($pageSize === 25) selected @endif>25</option>
            <option value="50" @if($pageSize === 50) selected @endif>50</option>
            <option value="100" @if($pageSize === 100) selected @endif>100</option>
        </select>
    </div>
    <div class="col-sm-2">
        <label for="roleFilter" class="col-form-label">{{ __('locale.role') }}</label>
        <select name="roleFilter" aria-controls="" class="form-control" id="roleFilterSelect">
            <option value="" @if($role === '') selected @endif>{{ __('locale.any') }}</option>
            @foreach($roles as $value)
                <option value="{{ $value->name }}" @if($value->name === $role) selected @endif>{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-auto ml-auto form-group row">
        <label for="search" class="col-form-label">{{ __('locale.Search') }}</label>
        <div class="input-group">
            <input type="search" name="pageSize" class="form-control" id="search" value="{{ $search }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="applySearch">{{ __('locale.Search') }}</button>
            </div>
        </div>
    </div>
</div>

@section('page-scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('pageSizeSelect');
            const search = document.getElementById('search');
            const role = document.getElementById('roleFilterSelect');
            const searchBtn = document.getElementById('applySearch');

            const getQueryString = function () {
                let params = {
                    'page_size': select.value
                };
                search.value.length > 0 ? params.search = search.value : null;
                role.value.length > 0 ? params.role = role.value : null;

                let queryString = Object.keys(params).reduce(function (accu, key) {
                    return accu + key + '=' + encodeURIComponent(params[key]) + '&';
                }, '?');
                return queryString.lastIndexOf('&') === queryString.length - 1 ? queryString.substr(0, queryString.length - 1) : queryString;
            };

            const refreshPage = function () {
                const currentUrl = '{{ url()->current() }}';
                // console.log(getQueryString());
                window.location.href = currentUrl + getQueryString();
            };

            select.addEventListener('change', refreshPage);
            role.addEventListener('change', refreshPage);
            searchBtn.addEventListener('click', refreshPage);
            search.addEventListener('keydown', function (event) {
                if (event.keyCode === 13) {
                    refreshPage();
                }
            });
        });

    </script>
@endsection

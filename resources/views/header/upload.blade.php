<div class="sub-navbar">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-4">
                <div class="filter-bar">
                    @if(Auth::check())
                        @include('layouts.filter')
                    @endif
                </div>
            </div>
            <div class="col-8">
                <div class="search-items">
                    @if(Auth::check())
                        @include('layouts.file-form')
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
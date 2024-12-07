@include('layouts.adminheader')
{{--start reactjs or vuejs--}}
<div id="app">
    {{--start site settng--}}
    <div id="sitesettings" class="sitesettings">
        <div class="sitesettings-item"><a href="javascript:void(0);" id="sitetoggle" class="sitetoggle"><i
                    class="fas fa-cog ani-rotates"></i></a></div>
    </div>
    {{--end site settng--}}


    {{--        start left side bar--}}
    @include('layouts.adminwrapper')
    {{--        end left side bar--}}

    {{--        page wrapper--}}
    <section>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-9 pt-md-5 mt-md-3 ms-auto">
                        <div class="row">
                            {{--            start breadcrumb--}}
                            <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-home"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="javascript:void(0)">
                                                Previous
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="javascript:void(0)">
                                                Current
                                            </a>
                                        </li>
                                    </ol>

                            </nav>
                            {{--            end breadcrumb--}}
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
    {{--        page wrapper--}}

</div>
{{--end reactjs or vuejs--}}

@include('layouts.adminfooter')

@include('admin.layouts.header')
@include('admin.layouts.navbar')

<section id="main-container">
    @include('admin.layouts.rightSidebar')
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
    </section>
    @include('admin.layouts.leftSidebar')
</section>
@include('admin.layouts.footer')
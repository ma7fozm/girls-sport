@yield('scripts')

<script type="text/javascript">
    function markRead(url) {
        // window.location.href = url;
        $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                $("#not_count").slideUp();
                // $("#not_count").css('visibility', 'hidden');
            },
            error: function() {
                console.log(data);
            }
        });
    }

    function notClk(url,url_clicked) {
        $.ajax({
            type: 'GET',
            url: url_clicked,
            success: function (data) {
                window.location.href = url;
            },
            error: function() {
                console.log(data);
            }
        });
    }

</script>

<!--Layout Script start -->
<script type="text/javascript" src="{{asset('design/admin')}}/assets/js/color.js"></script>
<script type="text/javascript" src="{{asset('design/admin')}}/assets/js/lib/jquery-1.11.min.js"></script>
@yield('boot');
<script type="text/javascript" src="{{asset('design/admin')}}/assets/js/multipleAccordion.js"></script>


<!-- summernote Editor Script For Layout start-->
<script src="{{asset('design/admin')}}/assets/js/summernote.min.js"></script>
<!-- summernote Editor Script For Layout End-->


<!-- Demo Ck Editor Script For Layout Start-->
<script src="{{asset('design/admin')}}/assets/js/pages/editor.js"></script>
<!-- Demo Ck Editor Script For Layout ENd-->
<!--easing Library Script Start -->
<script src="{{asset('design/admin')}}/assets/js/lib/jquery.easing.js"></script>
<!--easing Library Script End -->

<!--Nano Scroll Script Start -->
<script src="{{asset('design/admin')}}/assets/js/jquery.nanoscroller.min.js"></script>
<!--Nano Scroll Script End -->

<!--switchery Script Start -->
<script src="{{asset('design/admin')}}/assets/js/switchery.min.js"></script>
<!--switchery Script End -->

<!--bootstrap switch Button Script Start-->
<script src="{{asset('design/admin')}}/assets/js/bootstrap-switch.js"></script>
<!--bootstrap switch Button Script End-->

<!--easypie Library Script Start -->
<script src="{{asset('design/admin')}}/assets/js/jquery.easypiechart.min.js"></script>
<!--easypie Library Script Start -->

<!--bootstrap-progressbar Library script Start-->
<script src="{{asset('design/admin')}}/assets/js/bootstrap-progressbar.min.js"></script>
<!--bootstrap-progressbar Library script End-->

<!--FLoat library Script Start -->
<script type="text/javascript" src="{{asset('design/admin')}}/assets/js/chart/flot/jquery.flot.js"></script>
<script type="text/javascript" src="{{asset('design/admin')}}/assets/js/chart/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="{{asset('design/admin')}}/assets/js/chart/flot/jquery.flot.resize.js"></script>
<!--FLoat library Script End -->

<script type="text/javascript" src="{{asset('design/admin')}}/assets/js/pages/layout.js"></script>
<!--Layout Script End -->


<script src="{{asset('design/admin')}}/assets/js/countUp.min.js"></script>

<!-- skycons script start -->
<script src="{{asset('design/admin')}}/assets/js/skycons.js"></script>
<!-- skycons script end   -->

<!--Vector map library start-->
<script src="{{asset('design/admin')}}/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{asset('design/admin')}}/assets/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!--Vector map library end-->

<!--AmaranJS library script Start -->
<script src="{{asset('design/admin')}}/assets/js/jquery.amaran.js"></script>
<!--AmaranJS library script End   -->
<script src="{{asset('design/admin')}}/assets/js/pages/dashboard.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@yield('js')

<script type="text/javascript">
    function markRead(url) {
        // window.location.href = url;
        $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                $("#not_count").slideUp();
                // $("#not_count").css('visibility', 'hidden');
            },
            error: function() {
                console.log(data);
            }
        });
    }

    function notClk(url,url_clicked) {
        $.ajax({
            type: 'GET',
            url: url_clicked,
            success: function (data) {
                window.location.href = url;
            },
            error: function() {
                console.log(data);
            }
        });
    }

</script>
</body>
</html>

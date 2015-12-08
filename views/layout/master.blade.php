<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ParshCMS</title>

    <link href="/yeoji/parsh-cms/css/bootstrap.min.css" rel="stylesheet">
    <link href="/yeoji/parsh-cms/css/datepicker3.css" rel="stylesheet">
    <link href="/yeoji/parsh-cms/css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="/yeoji/parsh-cms/js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="/yeoji/parsh-cms/js/html5shiv.js"></script>
    <script src="/yeoji/parsh-cms/js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
@include('parshcms::partials.topnav')

@include('parshcms::partials.sidebar')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    @yield('content')
</div>	<!--/.main-->

<script src="/yeoji/parsh-cms/js/jquery-1.11.1.min.js"></script>
<script src="/yeoji/parsh-cms/js/bootstrap.min.js"></script>
<script src="/yeoji/parsh-cms/js/chart.min.js"></script>
<script src="/yeoji/parsh-cms/js/chart-data.js"></script>
<script src="/yeoji/parsh-cms/js/easypiechart.js"></script>
<script src="/yeoji/parsh-cms/js/easypiechart-data.js"></script>
<script src="/yeoji/parsh-cms/js/bootstrap-datepicker.js"></script>
<script>
    $('#calendar').datepicker({});

    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    });
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    });
</script>
</body>

</html>

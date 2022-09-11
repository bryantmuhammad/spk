<footer class="main-footer">
    <strong>Copyright &copy; 2021-2022<a href="http://adminlte.io"> SPK Keluarga</a>.</strong>
    All rights reserved.
    <!-- <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.2
    </div> -->
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->






<script>
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
    let page = getParameterByName("page");
    if (page == null) {
        $(".index").addClass("active")
    } else {
        let active = $(`.${page}`);

        let parent = active.parent().parent().parent();
        active.addClass("active");
        parent.addClass("menu-open")
    }
</script>
</body>

</html>
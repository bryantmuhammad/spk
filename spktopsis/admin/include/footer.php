<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2022 <div class="bullet"></div> Design By <a href="https://nauval.in/">40% Cofee</a>
    </div>
    <div class="footer-right">
        2.3.0
    </div>
</footer>
</div>
</div>


</body>
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
    console.log(page);
    if (page == null) {
        $(".index").addClass("active")
    } else {
        let active = $(`.${page}`);
        console.log(active);

        let parent = active.parent().parent();
        console.log(parent);
        active.addClass("active");
        parent.addClass("active")
    }
</script>


</html>
<!-- Main Footer -->
<footer class="main-footer">
  <strong>Copyright &copy; 2023 <a href="#">Sendriya Farming</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->



<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
 <script src="script.js"></script> <!-- form script -->

<!-- PAGE PLUGINS -->

<script>
  (function(){

    var path = window.location.href;
    $(".nav-link").each(function(){
      var href = $(this).attr('href');

      if (path === decodeURIComponent(href)){
        $(this).addClass('active');
        var parent = $(this).closest('.has-treeview');
        parent.addClass('menu-open');
        $(parent).find('.nav-link').first().addClass('active');
      }

    })

  }())
</script>

</body>

</html>
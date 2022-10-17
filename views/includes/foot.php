<!-- footer content -->
<footer>
  <div class="pull-right">
    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="<?php echo URL; ?>public/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo URL; ?>public/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="<?php echo URL; ?>public/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo URL; ?>public/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?php echo URL; ?>public/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?php echo URL; ?>public/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo URL; ?>public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo URL; ?>public/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?php echo URL; ?>public/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?php echo URL; ?>public/vendors/Flot/jquery.flot.js"></script>
<script src="<?php echo URL; ?>public/vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?php echo URL; ?>public/vendors/Flot/jquery.flot.time.js"></script>
<script src="<?php echo URL; ?>public/vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?php echo URL; ?>public/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?php echo URL; ?>public/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo URL; ?>public/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?php echo URL; ?>public/vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?php echo URL; ?>public/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?php echo URL; ?>public/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo URL; ?>public/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo URL; ?>public/vendors/moment/min/moment.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Datatables -->
<script src="<?php echo URL; ?>public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo URL; ?>public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo URL; ?>public/vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo URL; ?>public/build/js/custom.min.js"></script>

<!-- Css propre au module-->
<?php
if (isset($this->js)) {
  foreach ($this->js as $js) {
    echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
  }
}
?>
<!-- inclue uniquement pour la page : dossier_resultat_patient_id-->
<?php
//inclue uniquement pour la page : dossier_resultat_patient_id
if (isset($this->dossier_resultat_patient_id_own_js)) {
  if ($this->dossier_resultat_patient_id_own_js) {
    echo '<script type="text/javascript" src="' . URL . 'views/dossier/js/dossier_resultat_patient_id.js"></script>';
  }
}
?>
<!-- inclue uniquement pour la page : resultat_patients_d_un_dossier-->
<?php
//inclue uniquement pour la page : resultat_patients_d_un_dossier
if (isset($this->resultat_patient_d_un_dossier_own_js)) {
  if ($this->resultat_patient_d_un_dossier_own_js) {
    echo '<script type="text/javascript" src="' . URL . 'views/dossier/js/resultat_patients_d_un_dossier.js"></script>';
  }
}
?>

</body>

</html>
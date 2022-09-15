<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2022 <a href="https://#">B. Tech</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>

<script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap3-typeahead.min.js"></script>
<script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>   
<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.dataTables.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/dataTables.bootstrap.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-editable-select.min.js" charset="UTF-8"></script> 

<script src="<?php echo URL; ?>public/design/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo URL; ?>public/design/vendors/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL; ?>public/design/vendors/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo URL; ?>public/design/vendors/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo URL; ?>public/design/vendors/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo URL; ?>public/design/vendors/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?php echo URL; ?>public/design/vendors/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo URL; ?>public/design/vendors/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo URL; ?>public/design/vendors/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo URL; ?>public/design/vendors/dist/js/demo.js"></script>

<script src="<?php echo URL; ?>public/librairies/sweetalert/Resources/Public/Assets/sweetalert2.min.js" type="text/javascript"></script>
<!-- Toastr JS -->
<script src="<?php echo URL; ?>public/librairies/toastr/toastr.js"></script>
<!-- Tinymce -->
<script src="<?php echo URL; ?>public/librairies/tinymce/jquery.tinymce.min.js"></script>
<script src="<?php echo URL; ?>public/librairies/tinymce/tinymce.min.js"></script>
<!-- PrintThis -->
<script src="<?php echo URL; ?>public/librairies/printthis/printThis.js"></script>
<!-- JqueryBarcode -->
<script src="<?php echo URL; ?>public/librairies/jquerybarcode/jquery/jquery-barcode.js"></script>
<!-- Barcode -->
<script src="<?php echo URL; ?>public/js/barcode.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo URL; ?>public/js/main.js"></script>

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

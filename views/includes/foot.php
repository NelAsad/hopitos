

    <!-- jQuery -->
    <script src="<?php echo URL; ?>public/js/jquery.js"></script>

    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatable.net-semantic/js/dataTables.semanticui.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo URL; ?>public/frameworks/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Semantic JS -->
    <script src="<?php echo URL; ?>public/frameworks/semantic/semantic.min.js"></script>
    <!-- sweetalert.js-->
    <script src="<?php echo URL; ?>public/librairies/sweetalert/Resources/Public/Assets/sweetalert2.min.js" type="text/javascript"></script>
    <!-- Toastr JS -->
    <script src="<?php echo URL; ?>public/librairies/toastr/toastr.js"></script>
    <!-- Tinymce -->
    <script src="<?php echo URL; ?>public/librairies/tinymce/jquery.tinymce.min.js"></script>
    <script src="<?php echo URL; ?>public/librairies/tinymce/tinymce.min.js"></script>
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

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Dossier Medical
          </h1>
          <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">UI</a></li>
        <li class="active">General</li>
      </ol> -->
      </section>

<section class="content">
      <div class="callout callout-info">
        <h4>Reminder!</h4>
        Instructions for how to use modals are available on the
        <a href="http://getbootstrap.com/javascript/#modals">Bootstrap documentation</a>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Modal Examples</h3>
            </div>
            <div class="box-body">
            <form action="<?php echo URL; ?>dossier/get_all_fiches_patient/" method="GET" class="ui mini form">
                <div class="row">
                    <div class="col-xs-4">
                        <input class="form-control" type="text" name="search_text" placeholder="Identifiant du patient"/>
                    </div>
                    <div class="col-xs-4">
                        <select class="form-control" name="search_type">
                            <option value="patient_id">Identifiant du patient</option>
                            <option value="fiche_id">Numero de la fiche</option>
                            <option value="dossier_id">Numero du dossier</option>
                        </select>
                    </div>
                    <div class="col-xs-4">
                    <input type="submit" class="btn btn-primary btn-block" id="search_submit_button" value="Rechercher"/>
                    </div>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
</section>

 </div>

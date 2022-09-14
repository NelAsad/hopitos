<?php

$file_content = "

<div style='width: 100%; margin: auto;' > 

<div>
	<div style='display: inline-block;' >
		<div style='margin-top: 35px; margin-left: 10px;'>
			<img src='".$_SERVER['DOCUMENT_ROOT']."/hopitos/public/images/logo3.jpg' style='max-width: 100px;' />
		</div>
		<div style='margin-top: 10px; margin-botton: 10px; margin-left: 10px;'>
			<span style='font-weight: bold;'>HOSPITALIA</span>
		</div>  
	</div>
	<div style='display: inline-block; float: right; margin:0px'>
		<p style='font-weight: bold;'>CONSULTATION</p>
		<p>Num#: ".$this->fiche['fiche_id']."</p>
		<p>Date: ".$this->fiche['fiche_cloture_date']."</p>

	</div>
</div>

<div>
	<hr>
	<div>
		<p style='font-weight: bold;'>Identite du patient</p>
		<span>Prenom: ".$this->fiche['patient_prenom']."</span> <br>
		<span>Nom: ".$this->fiche['patient_nom']."</span> <br>
		<span>Post-nom: ".$this->fiche['patient_postnom']."</span> <br>
		<span>Poids: ".$this->fiche['poids']." Kg</span>
	</div>
	
		<p style='font-weight: bold;'>Anamnèse</p>
		<p>
			".$this->fiche['symptomes']."
		</p>
	
		<p style='font-weight: bold;'>Diagnostic</p>
		<p>
			".$this->fiche['diagnostic']."
		</p>

		<p style='font-weight: bold;'>Resultat Labo</p>
		<p>
			".$this->fiche['resultat_labo']."
		</p>

		<p style='font-weight: bold;'>Traitement</p>
		<p>
			".$this->fiche['traitement']."
		</p>
	
		<p style='font-weight: bold;'>Prescription</p>
		<p>
			".$this->fiche['pres_medicale']."
		</p>
	
</div>   
<hr>
<div style='float: right;'>
	<span> Kinshasa le ".date('d').'/'.date('m').'/'.date('Y')." </span> <br>
	<span> ".Session::get('prenom')." ".Session::get('nom')."</span>
</div>


";


    use Dompdf\Dompdf;

	$dompdf = new Dompdf();
	$dompdf->loadHtml($file_content);

	$dompdf->SetPaper('A4','portrait');

	$dompdf->render();

	$dompdf->stream("fiche de consultation num : ".$this->fiche['fiche_id'], array("Attachment" => false));
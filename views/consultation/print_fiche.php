<?php

$file_content = "

<div style='width: 100%; margin: auto;' > 

<div style=>
	<div style='display: inline-block;' >
		<div style='margin-top: 35px; margin-left: 35px;'>
			<img src='".$_SERVER['DOCUMENT_ROOT']."/hopitos/public/images/logo4.png' style='max-width: 100px;' />
		</div>
		<div style='margin-top: 10px; margin-botton: 10px; margin-left: 10px;'>
			<span style='font-weight: bold;'>MEDICAL CITY ADH</span>
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
		<!--<p style='font-weight: bold;'></p>-->
		<table style='border: 1px solid black;' width='100%'>
			<tr>
				<td width='400px'>
					<span style='font-weight: bold;'>Identité du patient</span> <br>
				</td>
				<td >
					<span style='font-weight: bold;'>Signes vitaux</span> <br>
				</td>
			</tr>
			<tr>
				<td width='400px'>
					<span>Prenom: ".$this->fiche['patient_prenom']."</span> <br>
					<span>Nom: ".$this->fiche['patient_nom']."</span> <br>
					<span>Post-nom: ".$this->fiche['patient_postnom']."</span> <br>
					<span>Sexe: ".$this->fiche['patient_sexe']."</span> <br>
					<span>Naissance: ".$this->fiche['patient_date_naissance']."</span> <br>
				</td>
				<td >
					<span>Poids: ".$this->fiche['poids']." Kg</span> <br>
					<span>Tension: ".$this->fiche['tension']."</span> <br>
					<span>Temperature: ".$this->fiche['temperature']." </span>
				</td>
			</tr>
		</table>
		
	</div>
	<br>
	<br>
	<br>
	<div>
		<table style='border-collapse: collapse;' width='100%'>
			<tr bgcolor='#ddd' style='border: 1px solid black; line-height: 34px;'>
				<th style='border: 1px solid black; padding: 10px 10px 10px 10px;' width='400px'>
					Désignation
				</th>
				<th style='border: 1px solid black; padding: 10px 10px 10px 10px;'>
					Observation
				</th>
			</tr>
			<tr style='border: 1px solid black;'>
				<td style='border: 1px solid black; padding: 10px 10px 10px 10px;'>
					Consultation : <br> <br>
					".$this->fiche['symptomes']."
				</td>
				<td style='border: 1px solid black; padding: 10px 10px 10px 10px;' rowspan='2'>
					Résultats examens : <br>
					".$this->fiche['resultat_labo']." <br><br>

					Traitement : <br>
					".$this->fiche['traitement']." <br><br>

					Prescriptions : <br>
					".$this->fiche['pres_medicale']."

				</td>
			</tr>
			<tr style='border: 1px solid black;'>
				<td style='border: 1px solid black; padding: 10px 10px 10px 10px;' width='400px'>
					Diagnostic  : <br> <br>
					".$this->fiche['diagnostic']."
				</td>
			</tr>
		</table>
	</div>
	
</div>   
<br>
<br>
<br>

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
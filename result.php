<?php
session_start();
if (!empty($_SESSION["username"])) {
    $name = $_SESSION["username"];
} else {
    session_unset();
    $url = "./index.php";
    header("Location: $url");
}

session_write_close();
include __DIR__ . "/config.php";
include __DIR__ . "/lib/Api.php";

$Api = new API();
$Api->link 	= $link;
$Api->url_soap  = $url_soap;
$Api->login     = $login;
$Api->password  = $password;
$Api->codeLang  = $codeLang;
$Api->poolAlias = $poolAlias;

$data = $ref = $des = $fam = $cb = $num_f = $int_f = $ref_f = $prix_v = $s1 = $s2 = $s3 = $s4 = $nomencl = "";

if( isset($_POST["recherche"]) && !empty($_POST["recherche"]) ){
	$recherche 	= $_POST["recherche"];
	$donnee 	= $Api->getDetailArticle($recherche);
	$nomencl 	= $Api->getNomenclatureArticle($recherche);

	if( (is_countable($donnee) && count($donnee) == 1) || $nomencl == 1){
		if (is_array($donnee) || is_object($donnee)) {
			foreach ($donnee as $value) {
				$stock	= "";
				$ref 	= $value["REF"];
				//$des 	= $value["DESS"];
				$fam 	= $value["FAM"];
				$cb  	= $value["CB"];
				$num_f 	= $value["FOURN"];
				$int_f 	= $value["FOURNN"];
				$ref_f 	= $value["REF_F"];

				$stock	 	= $Api->soap_API($ref);
				foreach ($stock as $s_) {
					$des 	= $s_[0];
					$s1 	= $s_[1];
					$s2 	= $s_[2];
					$s3 	= $s_[3];
					$s4 	= $s_[4];
					$prix_v	= $s_[5];
				}

				$data   .= '<tr class="ligne_">
							    <td>'.$ref.'</td>
							    <td>'.$des.'</td>
							    <td>'.$fam.'</td>
							    <td>'.$ref_f.'</td>
							    <td align="right" class="pv">'.number_format((float)$prix_v, 2 , ',' ,' ').'</td>
							    <td align="right" class="qte"><input type="number" name="qte_"  class="form-control"placeholder="1" value=""><span id="qte"></span></td>
							    <td align="right" class="total">'.number_format((float)$prix_v, 2 , ',' ,' ').'</td>
							    <td align="right" class="S1">'.number_format((float)($s1*$value["QTE"]), 2 , ',' ,' ').'</td>
							    <td align="right" class="S2">'.number_format((float)($s2*$value["QTE"]), 2 , ',' ,' ').'</td>
							    <td align="right" class="S3">'.number_format((float)($s3*$value["QTE"]), 2 , ',' ,' ').'</td>
							    <td align="right" class="S4">'.number_format((float)($s4*$value["QTE"]), 2 , ',' ,' ').'</td>
							    <td align="right">'.number_format((float)($value["CMDE"]), 2 , ',' ,' ').'</td>
							    <td align="right">'.$value["DATE_D_CMDE"].'</td>
							    <td><a class="delete" aria-label="Ne pas visualiser" title="Ne pas visualiser"><i class="fa fa-trash-o supp" aria-hidden="true"></i></a></td>
							</tr>';
			}
		}
	}
	else{
		if (is_array($donnee) || is_object($donnee)) {
			foreach ($donnee as $value) {
				$ref 	= $value["REF"];
				$des 	= $value["DESS"];
				$fam 	= $value["FAM"];
				$cb  	= $value["CB"];
				$num_f 	= $value["FOURN"];
				$int_f 	= $value["FOURNN"];
				$ref_f 	= $value["REF_F"];
				$prix_v	= $value["PV_TTC"];

				$data   .= '<tr>
							    <td><a class="r_" href="#" id="'.$ref.'">'.$ref.'</a></td>
							    <td><a class="r_" href="#" id="'.$ref.'">'.$des.'</a></td>
							    <td><a class="r_" href="#" id="'.$ref.'">'.$fam.'</a></td>
							    <td><a class="r_" href="#" id="'.$ref.'">'.$ref_f.'</a></td>
							</tr>';
			}
		}
	}
	echo $data;
}
else if( isset($_POST["id"]) && !empty($_POST["id"]) ){
	$id 		= $_POST["id"];
	$donnee 	= $Api->getDetailArticle($id);

	foreach ($donnee as $value) {
		$stock	= "";
		$ref 	= $value["REF"];
		$fam 	= $value["FAM"];
		$cb  	= $value["CB"];
		$num_f 	= $value["FOURN"];
		$int_f 	= $value["FOURNN"];
		$ref_f 	= $value["REF_F"];

		$stock	 	= $Api->soap_API($ref);
		foreach ($stock as $s_) {
			$des 	= $s_[0];
			$s1 	= $s_[1];
			$s2 	= $s_[2];
			$s3 	= $s_[3];
			$s4 	= $s_[4];
			$prix_v	= $s_[5];
		}

		$data   .= '<tr class="ligne_">
					    <td>'.$ref.'</td>
					    <td>'.$des.'</td>
					    <td>'.$fam.'</td>
					    <td>'.$ref_f.'</td>
					    <td align="right">'.number_format((float)$prix_v, 2 , ',' ,' ').'</td>
					    <td align="right" class="qte"><input type="number" name="qte_" class="form-control"placeholder="1" value=""><span id="qte"></span></td>
						<td align="right" class="total">'.number_format((float)$prix_v, 2 , ',' ,' ').'</td>
					    <td align="right" class="S1">'.number_format((float)($s1*$value["QTE"]), 2 , ',' ,' ').'</td>
						<td align="right" class="S2">'.number_format((float)($s2*$value["QTE"]), 2 , ',' ,' ').'</td>
						<td align="right" class="S3">'.number_format((float)($s3*$value["QTE"]), 2 , ',' ,' ').'</td>
						<td align="right" class="S4">'.number_format((float)($s4*$value["QTE"]), 2 , ',' ,' ').'</td>
						<td align="right">'.number_format((float)($value["CMDE"]), 2 , ',' ,' ').'</td>
						<td align="right">'.$value["DATE_D_CMDE"].'</td>
					    <td><a class="delete" aria-label="Ne pas visualiser" title="Ne pas visualiser"><i class="fa fa-trash-o supp" aria-hidden="true"></i></a></td>
					</tr>';
	}
	echo $data;
}
else if( isset($_POST["react"]) && !empty($_POST["react"]) ){
	$id 		= $_POST["react"];

	if (is_array($id) || is_object($id)) {
			foreach ($id as $key=>$value_) {
				$donnee 	= $Api->getDetailArticle($key);

				foreach ($donnee as $value) {
					$stock	= "";
					$ref 	= $value["REF"];
					$fam 	= $value["FAM"];
					$cb  	= $value["CB"];
					$num_f 	= $value["FOURN"];
					$int_f 	= $value["FOURNN"];
					$ref_f 	= $value["REF_F"];

					$stock	 	= $Api->soap_API($ref);
					foreach ($stock as $s_) {
						$des 	= $s_[0];
						$s1 	= $s_[1];
						$s2 	= $s_[2];
						$s3 	= $s_[3];
						$s4 	= $s_[4];
						$prix_v	= $s_[5];
					}

					$data   .= '<tr class="ligne_">
								    <td>'.$ref.'</td>
								    <td>'.$des.'</td>
								    <td>'.$fam.'</td>
								    <td>'.$ref_f.'</td>
								    <td align="right">'.number_format((float)$prix_v, 2 , ',' ,' ').'</td>
								    <td align="right" class="qte"><input type="number" name="qte_" class="form-control"placeholder="1" value="'.$value_.'"><span id="qte">'.$value_.'</span></td>
									<td align="right" class="total">'.number_format((float)$prix_v, 2 , ',' ,' ').'</td>
								    <td align="right" class="S1">'.number_format((float)($s1*$value["QTE"]), 2 , ',' ,' ').'</td>
									<td align="right" class="S2">'.number_format((float)($s2*$value["QTE"]), 2 , ',' ,' ').'</td>
									<td align="right" class="S3">'.number_format((float)($s3*$value["QTE"]), 2 , ',' ,' ').'</td>
									<td align="right" class="S4">'.number_format((float)($s4*$value["QTE"]), 2 , ',' ,' ').'</td>
									<td align="right">'.number_format((float)($value["CMDE"]), 2 , ',' ,' ').'</td>
									<td align="right">'.$value["DATE_D_CMDE"].'</td>
								    <td><a class="delete" aria-label="Ne pas visualiser" title="Ne pas visualiser"><i class="fa fa-trash-o supp" aria-hidden="true"></i></a></td>
								</tr>';
				}
			}
	}
	echo $data;
}
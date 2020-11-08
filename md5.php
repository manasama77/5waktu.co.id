<?php
$data = [
	'mgsmr_cilegon123',
	'mgsmg_mataram_lombok123',
	'cv_hartono_mitra_audio123',
	'cv_indo_niaga123',
	'cv_lampung_spot_music123',
	'cv_indoteknik123',
	'diana_prima_prospekta123',
	'era_musika123',
	'forte_multi_fortuna123',
	'mgsmg_duta_mall123',
	'mgsmg_makassar123',
	'mgsmg_mantos123',
	'mgsmg_aceh123',
	'mgsmg_ternate123',
	'mgsmg_kendari123',
	'pt_timika_makmur_jaya_sentosa123',
	'pt_royal_crown123',
];

for ($i=0; $i < count($data); $i++) { 
	echo md5($data[$i])."<br>";
}
?>
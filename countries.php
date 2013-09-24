<?php

function array_slice_assoc(&$array, $key) {
	$return = @$array[$key];

	unset($array[$key]);

	return $return;
}

$COUNTRY_LIST = json_decode(file_get_contents('countries.json'));
$RETURN_LIST  = isset($_GET['return']) && is_array($_GET['return']) ? $_GET['return'] : array_keys((array) $COUNTRY_LIST[0]); unset($_GET['return']);
$RETURN_DATA  = array();

$IS_ARRAY    = false;
$IS_KEYLESS  = isset($_GET['keyless']); unset($_GET['keyless']);
$IS_READABLE = isset($_GET['readable']); unset($_GET['readable']);

$CALLBACK = isset($_GET['callback']) ? $_GET['callback'] : false; unset($_GET['callback']);

if (count($_GET) < 1) $_GET['return'] = array();

foreach ($_GET as $KEY => $value) {
	if (is_array($value)) $IS_ARRAY = true;
	else $value = array($value);

	foreach ($COUNTRY_LIST as $index => $country) {
		if ($KEY === 'return' || (isset($country->{$KEY}) && in_array($country->{$KEY}, $value))) {
			$RETURN_EACH = array();

			foreach ($RETURN_LIST as $include) {
				if ($IS_KEYLESS) {
				 	$RETURN_EACH[] = $country->$include;
				} else {
				 	$RETURN_EACH[$include] = $country->$include;
				}
			}

			$RETURN_DATA[] = $RETURN_EACH;
		}
	}
}

header('Content-Type: '.($CALLBACK ? 'application/json' : 'application/javascript'));

print(
	($CALLBACK ? $CALLBACK.'(' : '').
	json_encode(
		$IS_ARRAY ? $RETURN_DATA : @$RETURN_DATA[0],
		$IS_READABLE ? JSON_PRETTY_PRINT : null
	).
	($CALLBACK ? $CALLBACK.');' : '')
);
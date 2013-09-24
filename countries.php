<?php

namespace Countries;

const JSON_PATH = 'countries.json';

function GetData($SETTING = array()) {
	$INPUT_LIST = json_decode(file_get_contents(JSON_PATH));
	$INPUT_KEYS = array_keys((array) $INPUT_LIST[0]);

	$KEY_LIST = array_intersect_key($SETTING, array_flip($INPUT_KEYS));
	$PROPERTY_LIST = is_array(@$SETTING['return']) ? array_flip(array_intersect_key(array_flip($SETTING['return']), array_flip($INPUT_KEYS))) : $INPUT_KEYS;

	$IS_ARRAY = empty($KEY_LIST);
	$IS_KEYLESS  = isset($SETTING['keyless']);

	$RETURN_LIST = array();

	foreach ($INPUT_LIST as $INPUT) {
		foreach ($KEY_LIST as $KEY => $VALUE) {
			if (is_array($VALUE)) $IS_ARRAY = true;
			elseif (!empty($VALUE)) $VALUE = array($VALUE);

			if (!empty($VALUE) && isset($INPUT->{$KEY}) && !in_array($INPUT->{$KEY}, $VALUE)) {
				continue 2;
			}
		}

		$RETURN_EACH = array();

		foreach ($PROPERTY_LIST as $PROPERTY) {
			if ($IS_KEYLESS) $RETURN_EACH[] = $INPUT->$PROPERTY;
			else $RETURN_EACH[$PROPERTY] = $INPUT->$PROPERTY;
		}

		$RETURN_LIST[] = $RETURN_EACH;
	}

	return $IS_ARRAY ? $RETURN_LIST : @$RETURN_LIST[0];
}

function GetJSON($SETTING = array()) {
	$IS_READABLE = isset($SETTING['readable']);

	$CALLBACK = isset($SETTING['callback']) ? $SETTING['callback'] : false;
	$MIMETYPE = $CALLBACK ? 'application/json' : 'application/javascript';

	$JSON = GetData($SETTING);

	header('Content-Type: '.$MIMETYPE);

	if ($CALLBACK) print($CALLBACK.'(');

	print(json_encode($JSON, $IS_READABLE ?  JSON_PRETTY_PRINT : null));

	if ($CALLBACK) print(');');
}
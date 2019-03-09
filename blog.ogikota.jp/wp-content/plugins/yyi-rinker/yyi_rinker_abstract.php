<?php
/**
 * User: yayoi
 * Date: 2018/04/30
 * Time: 22:22
 */

abstract class Yyi_Rinker_Abstract_Base {
	public function array_get($array, $key, $default = null)
	{
		if ( is_null( $key ) ) return $array;

		if ( isset( $array[$key] ) ) return $array[ $key ];

		foreach ( explode( '.', $key ) as $segment )
		{
			if ( ! is_array($array) || ! array_key_exists( $segment, $array ) )
			{
				return $default;
			}
			$array = $array[ $segment ];
		}

		return $array;
	}

	public function now() {
		return date('Y-m-d H:i:s');
	}
}

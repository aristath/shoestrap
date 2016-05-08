<?php

class Shoestrap_Init {

	/**
	 * The constructor.
	 */
	public function __construct() {

		// Instantiates the Kirki_Enqueue object.
		new Shoestrap_Enqueue();

	}
}

<?php

/*
 * Lity Lightbox Tool
 * Base functionality created by Jan Sorgalla 
 * View the standalone project here: http://sorgalla.com/lity/
 */

if ( defined( 'ABSPATH' ) && ! class_exists( 'PK_Tool_Lity' ) ) {

	class PK_Tool_Lity {		

		private function pll_folder(){
			return __PKSAK_TOOLS__.'/'.$this->PARENT_FOLDER;
		}

		public function pll_enqueue_script(){
			wp_enqueue_script( 'pll-js', plugins_url($this->pll_folder().'/js/lity.min.js'), 'jQuery','1',true );		
		}

		public function pll_enqueue_style(){
			wp_enqueue_style( 'pll-styles', plugins_url($this->pll_folder().'/css/lity.min.css'), false ); 
		}

		public function __construct() {
			$this->PARENT_FOLDER = basename(dirname(__FILE__));
			add_action( 'wp_enqueue_scripts', array( $this, 'pll_enqueue_script' ) );
			add_action( 'get_footer', array( $this, 'pll_enqueue_style' ) );

		}

	}

	new PK_Tool_Lity;
}

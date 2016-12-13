<?php
namespace Cuisine\Front;

use Cuisine\Utilities\Url;

class Sass {


	/**
	 * Array of registered sass-files
	 * 
	 * @var array
	 */
	var $registered = array();

	/**
	 * String containing the name of the script being saved
	 * 
	 * @var string
	 */
	var $script = '';

	/**
	 * String containing the path of the script being copied
	 * 
	 * @var string
	 */
	var $path = '';



	/**
	 * Init events & vars
	 */
	function __construct(){

		global $Cuisine;

		//all registered scripts are stored a wp option,
		//this gets autoloaded and cached, so we don't query it constantly
		$this->registered = get_option( 'registered_sass_files', array() );

	}

	/**
	 * Register a single sass file
	 * 
	 * @param  string $script script-name
	 * @param  string $path relative path
	 * @return bool succes
	 */
	public function register( $script, $rel_path, $force = false ){


		//check to see if it exists:
		if( !isset( $this->registered[ $script ] ) || $force ){

			$this->script = $script;
			$this->path = $this->sanitizePath( $rel_path );

			if( $this->copy() ){

				$this->registered[ $script ] = $rel_path;
				update_option( 'registered_sass_files', $this->registered, true );

				return true;

			}else{

				//something went wrong...
				return false;

			}
	
		}

		return true;	// it's already active.
	}


	/**
	 * Copy the script to the active theme.
	 *
	 * @param string $script
	 * @param string $rel_path Relative path
	 * @return bool succes
	 */
	private function copy(){

		$fullPath = Url::path( 'plugin', $this->path );

		//get the file
		$file = @file_get_contents( $fullPath );

		//if the file is found:
		if( $file ){

			//move to the default sass folder
			$folder = apply_filters( 'cuisine_sass_folder', 'css/sass/plugins/' );
			$newPath = Url::path( 'theme', $folder, $this->script );
			$newPath .= '_'.$this->script.'.scss';

			return @file_put_contents( $newPath, $file );
		}
		
		return false;
	}


	/**
	 * Return the scripts as an Array
	 * 
	 * @return array
	 */
	public function get(){

		return $this->registered;

	}


	/**
	 * Make the path of a sass file load-ready.
	 * 
	 * @param  string $path
	 * @return string
	 */
	private function sanitizePath( $path ){

		//add .scss extension if it's not there
		if( substr( $path, -5 ) !== '.scss' )
			$path .= '.scss';

		return $path;
	}


	/**
	 * Reset Sass files
	 * 
	 * @return void
	 */
	public function resetFiles(){

		foreach( $this->registered as $script => $file ){

			$this->script = $script;
			$this->path = $this->sanitizePath( $file );

			$this->copy();
		}

	}


}



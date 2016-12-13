<?php
namespace Cuisine\Front;

use Cuisine\Utilities\Sort;
use Cuisine\Utilities\Url;

class Scripts {

	/**
	 * Array of registered scripts
	 * 
	 * @var array
	 */
	var $registered = array();

	/**
	 * Array of registered JS vars
	 * 
	 * @var array
	 */
	var $jsVars = array();



	/**
	 * Init events & vars
	 */
	function __construct(){

		global $Cuisine;

		//all registered scripts are stored in the Cuisine global
		$this->registered = $Cuisine->scripts;

		$this->jsVars = $Cuisine->jsVars;

	}

	/**
	 * Register a single script
	 * 
	 * @param  string $script script-name
	 * @param  string $url    url
	 * @return [type]         [description]
	 */
	public function register( $script, $url, $autoload = false ){

		global $Cuisine;

		//clean up the url
		$url = $this->sanitizeUrl( $url );

		$this->registered[ $script ] = array( 

			'name'		=> 		$script,
			'url'		=>		$url,
			'autoload'	=>		$autoload

		);

		$Cuisine->scripts = $this->registered;
	}



	/**
	 * Add a variable to the JS Cuisine global
	 * 
	 * @param string
	 * @param array
	 */
	public function variable( $id, $array ){

		global $Cuisine;

		$this->jsVars[ $id ] = $array;

		$Cuisine->jsVars = $this->jsVars;
	}



	/**
	 * Return the scripts as a JSON object
	 * 
	 * @return string (html, echoed)
	 */
	public function set(){

		//set the variables first:
		$this->setVars();

		$url = Url::plugin( 'cuisine', true ).'Assets/js';
		$config = $url.'/Front';
		$require = $url.'/libs/require.js';

		//load all JS with RequireJS
		echo '<script data-main="'.$config.'" src="'.$require.'"></script>';
	}


	/**
	 * Echoe the scripts as JSON objects
	 *
	 * @return string (html, echoed)
	 */
	private function setVars(){

		//allow registers to be overwritten:
		do_action( 'cuisine_js_override' );

		$scripts = $this->get();
		$autoload = $this->getAutoload();
		$site_url = get_site_url();
		$site_url = str_replace( array( 'http://localhost:8888', 'http://localhost' ), '', $site_url );

		$jsVars = array(
			'siteUrl'	=> esc_url_raw( get_site_url() ),
			'baseUrl'	=> $site_url,
			'ajax'		=> admin_url('admin-ajax.php'),
			'scripts' 	=> $scripts,
			'load'		=> $autoload
		);

		//make it filterable
		$jsVars = apply_filters( 'cuisine_js_vars', $jsVars );

		echo '<script>';
			//setup the Cuisine JS Object
			echo 'var Cuisine = '.json_encode( $jsVars ).';';

			//setup the vars:
			foreach( $this->jsVars as $id => $val ){
				echo 'var '.ucwords( $id ).' = '.json_encode( $val ).';';
			}

		echo '</script>';
	}


	/**
	 * Make a URL of a script file load-ready.
	 * 
	 * @param  string $url
	 * @return string
	 */
	private function sanitizeUrl( $url ){

		//remove .js extension for RequireJS
		if( substr( $url, -3 ) === '.js' )
			$url = substr( $url, 0, -3 );

		//remove the site_url if present, so we don't get into conflict with browsersync:
		$site_url = trailingslashit( get_site_url() );
		$url = str_replace( $site_url, '', $url );

		return $url;
	}


	/**
	 * Return the scripts as an Array
	 * 
	 * @return array
	 */
	public function get(){

		$scripts = apply_filters( 'cuisine_scripts', $this->registered );
		return Sort::pluck( $scripts, 'url', true );

	}


	/**
	 * Return the names of autoload scripts
	 * 
	 * @return array
	 */
	public function getAutoload(){

		$array = array();
		$scripts = apply_filters( 'cuisine_scripts', $this->registered );

		foreach( $scripts as $key => $script ){

			if( isset( $script['autoload'] ) && $script['autoload'] )
				$array[] = $key;

		}

		return $array;

	}


	/**
	 * Default analytics shtick:
	 * 
	 * @return string (html, echoed)
	 */
	public function analytics( $code ){

		$string = "\n<script>
		 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		 ga('create', '".$code."', 'auto');
		 ga('send', 'pageview');
		
		</script>";

		echo preg_replace('/[ \t]+/', ' ', preg_replace('/[\r\n]+/', "\n", $string));
	}


	
}



<?php
namespace Cuisine\Fields;

use Cuisine\Utilities\Url;

class ImageField extends DefaultField{


    /**
     * Method to override to define the input type
     * that handles the value.
     *
     * @return void
     */
    protected function fieldType(){
        $this->type = 'image';

    }


    /**
     * Build the html
     *
     * @return String;
     */
    public function build(){

        $img = $this->getValue();
        $org_img = $img;


        //set defaults
        $img = $this->sanatizeValue( $img );

        $pre = $this->name;

        $html = '<div class="image-field">';

        	$html .= '<div class="img-wrapper">';
        		$html .= '<img src="'.$img['preview'].'" id="preview"/>';
        	$html .= '</div>';

        	$html .= '<div class="btn-wrapper">';

        		$btnText = ( $org_img ? __( 'Afbeelding aanpassen', 'cuisine' ) : __( 'Selecteer een afbeelding', 'cuisine' ) );

                
        		$html .= '<button id="select-img">'.$btnText.'</button>';
                $html .= '<span class="remove-img-source"><em>'.__( 'of', 'cuisine' ).'</em> <span id="remove-img">'.__( 'verwijderen', 'cuisine' ).'</span></span>';

        	$html .= '</div>';

        	$html .= '<input type="hidden" class="multi" name="'.$pre.'[img-id]" id="img-id" value="'.$img['img-id'].'"/>';
        	$html .= '<input type="hidden" class="multi" name="'.$pre.'[thumb]" id="thumb" value="'.$img['thumb'].'"/>';
        	$html .= '<input type="hidden" class="multi" name="'.$pre.'[medium]" id="medium" value="'.$img['medium'].'"/>';
        	$html .= '<input type="hidden" class="multi" name="'.$pre.'[large]" id="large" value="'.$img['large'].'"/>';
        	$html .= '<input type="hidden" class="multi" name="'.$pre.'[full]" id="full" value="'.$img['full'].'"/>';
        	$html .= '<input type="hidden" class="multi" name="'.$pre.'[orientation]" id="orientation" value="'.$img['orientation'].'"/>';

        $html .= '</div>';

        return $html;

    }

    function sanatizeValue( $original ){

    	//add the preview, if set:
    	if( is_array( $original ) && 
    		!isset( $original['preview'] ) && 
    		isset( $original['thumb'] ) ){

    			$original['preview'] = $original['thumb'];

    	}


    	$defaults = array( 
    		'img-id' => '',
    		'thumb' => '',
    		'medium' => '',
    		'large' => '',
    		'full' => '',
    		'orientation' => 'landscape',
    		'preview' => Url::plugin( 'cuisine/Assets/images/img-placeholder.png' )
    	);

        if( !is_array( $original ) )
            $original = array();


    	return array_merge( $defaults, $original );
    }

}
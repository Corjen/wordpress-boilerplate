/**
 * Main Validate JS Class
 *
 * Validate fields
 *
 * @since Cuisine 1.4
 */


    var Validate = {


    	empty: function( _string ){

    		if( _string !== undefined && _string !== null && _string !== '' )
    			return true;

    		return false;

    	},

    	email: function( _string ){

    		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    		return reg.test( _string );

    	},

    	number: function( _string ){

    		if( isNaN( _string ) )
    			return false;

            return true;
    	},


        equalHigherZero: function( _string ){

            if( Validate.number( _string ) ){

                if( _string >= 0 )
                    return true;

            }

            return false;
        },

        equalLowerZero: function( _string ){

            if( Validate.number( _string ) ){

                if( _string <= 0 )
                    return true;

            }

            return false;

        },


        higherZero: function( _string ){

            if( Validate.number( _string ) ){

                if( _string > 0 )
                    return true;

            }

            return false;

        },


        lowerZero: function( _string ){

            if( Validate.number( _string ) ){

                if( _string < 0 )
                    return true;

            }

            return false;

        },

    	has_number: function( _string ){

    		var req = /\d/;
    		return req.test( _string );

    	},

    	zipcode: function( _string, _country ){

            if( typeof( _country ) == 'undefined' ){

                console.log( 'undefined' );
                if( _string.length > 7 )
                    return false;
    
                var reg = /^[1-9][0-9]{3} ?[a-z]{2}$/i;
                    return reg.test( _string );


            }else{
                //we have a country-code:
                
                var _uniqueZip = {
                    ad: /^(([a-zA-Z]{2}\d{3})|(\d{4}))$/,
                    ar: /^((\d{4})|([a-zA-Z]{1}\d{4}[a-zA-Z]{3}))$/,
                    bm: /^[a-zA-Z]{2}\s\d{2}$/,
                    bn: /^[a-zA-Z]{2}\d{4}$/,
                    br: /^(\d{5})(-\d{3})?$/,
                    ca: /^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/,
                    fo: /^([a-zA-Z]{2}-)?(\d{3})?$/,
                    fr: /^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/,
                    gb: /^GIR?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]|[A-HK-Y][0-9]([0-9]|[ABEHMNPRV-Y]))|[0-9][A-HJKS-UW])?[0-9][ABD-HJLNP-UW-Z]{2}$/,
                    uk: /^GIR?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]|[A-HK-Y][0-9]([0-9]|[ABEHMNPRV-Y]))|[0-9][A-HJKS-UW])?[0-9][ABD-HJLNP-UW-Z]{2}$/,
                    ge: /^((\d{4})|(\d{6}))$/,
                    ie: /^(([a-zA-Z]{2}(\s(([a-zA-Z0-9]{1})|(\d{2})))?)|([a-zA-Z]{3}))$/,
                    jp: /^\d{3}(-\d{4})?$/,
                    kr: /^\d{3}-\d{3}$/,
                    lv: /^([a-zA-Z]{2}-)?(\d{4})$/,
                    mv: /^\d{4,5}$/,
                    mt: /^[a-zA-Z]{3}\s\d{2,4}$/,
                    nl: /^(\d{4})\s?[a-zA-Z]{2}$/,
                    pl: /^\d{2}(-)?\d{3}$/,
                    pt: /^\d{4}(-)?\d{3}$/,
                    sz: /^[a-zA-Z]{1}\d{3}$/,
                    tw: /^\d{3}(\d{2})?$/,
                    us: /^\d{5}(-\d{4})?$/
                };

                var _countryCode = [
                    'is|mg'.split('|'),
                    'at|au|bd|be|bg|ch|cx|cy|dk|gl|gw|hu|li|lu|md|mk|mz|no|nz|ph|sd|si|tn|ve|xk|za'.split('|'),
                    'as|ba|cs|cu|de|dz|ee|es|fi|fm|gf|gp|gt|gu|hr|ic|id|il|it|ke|kw|lt|ma|me|mh|mm|mp|mq|mx|my|pk|pm|pr|ps|pw|re|sa|sm|th|tr|ua|uy|vi|vn|yu|zm'.split('|'),
                    'am|az|bj|by|cn|in|kg|kz|mn|ro|rs|ru|sg|tj|tm|uz'.split('|'),
                    'cz|gr|se|sk'.split('|')
                ];

                var _pattern = [
                    /^[0-9]{3}$/,
                    /^[0-9]{4}$/,
                    /^[0-9]{5}$/,
                    /^[0-9]{6}$/,
                    /^[0-9]{3}\s?[0-9]{2}$/
                ];

                if ( _uniqueZip[ _country ] !== undefined) {

                    // If `countryCode` parameter is detected as a unique key
                    zipCodeRegex =  _uniqueZip[ _country ];
                } else {
                    // Else `countryCode` parameter is detected as a common key
                    for (i = 0; _countryCode.length > i; i++) {
                        // Looping through each shared regex countries array
                        if ( _countryCode[i].indexOf( _country ) > -1) {
                            // If a match is found, set the associated regex
                            zipCodeRegex = _pattern[i];
                            break;
                        }
                    }
                }


                // Test if it's a valid zipCode
                if (zipCodeRegex !== undefined) {
                    return zipCodeRegex.test( _string );
            
                } else {
                    throw 'No Regex corresponds to this country code';
                    return true;
                }      

            }

    	},


        json: function( _string ){

            try {
                JSON.parse( _string );

            } catch (e) {
                return false;
            
            }
            
            return true;

        },

        slug: function( _string ){

            var reg = /^[a-z0-9-]+$/;
            return reg.test( _string );

        }
    };
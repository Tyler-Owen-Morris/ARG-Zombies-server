/*

    JS String Library is free software: you can redistribute it and/or modify

    it under the terms of the GNU General Public License as published by

    the Free Software Foundation, either version 2 of the License.



    This program is distributed in the hope that it will be useful,

    but WITHOUT ANY WARRANTY; without even the implied warranty of

    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

    GNU General Public License for more details.



    You should have received a copy of the GNU General Public License

    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/



//////////////////////////////////////////////////////////////////////

// this page requires to be coded and saved in ANSI format

//////////////////////////////////////////////////////////////////////

function urlencode()

{

    // The Javascript escape and unescape functions do not correspond

    // with what browsers actually do...

    var SAFECHARS = "0123456789" + // Numeric

    "ABCDEFGHIJKLMNOPQRSTUVWXYZ" + // Alphabetic

    "abcdefghijklmnopqrstuvwxyz" +

    "-_.!~*'()"; // RFC2396 Mark characters



    var HEX = "0123456789ABCDEF"; 



    var plaintext = this ;

    var encoded = "";

    

    for (var i = 0; i < plaintext.length; i++ )

    {

        var ch = plaintext.charAt(i);



        if ( ch == " " )       { encoded += "+" ; /* x-www-urlencoded, rather than %20 */ }

        else if ( ch == "€" )  { encoded += "%80" ; }

        else if (SAFECHARS.indexOf(ch) != -1)

        {

            encoded += ch;

        }

        else

        {

            var charCode = ch.charCodeAt(0);

            if ( charCode > 255 )

            {

                alert( "Unicode Character '" 

                + ch 

                + "' cannot be encoded using standard URL encoding.\n" +

                "(URL encoding only supports 8-bit characters.)\n" +

                "A space (+) will be substituted." ) ;

                

                encoded += "+" ;

            }

            else

            {

                encoded += "%";

                encoded += HEX.charAt((charCode >> 4) & 0xF);

                encoded += HEX.charAt(charCode & 0xF);

            }

        }

    } 



    return encoded;

}



function urldecode()

{

      // Replace + with ' '

      // Replace %xx with equivalent character

      // Put [ERROR] in output if %xx is invalid.

      var HEXCHARS = "0123456789ABCDEFabcdef" ;

      var encoded = this ;

      var plaintext = "" ;

      var i = 0 ;

      

      while ( i < encoded.length )

      {

          var ch = encoded.charAt( i );

          

          if ( ch == "+" )

          {

              plaintext += " ";

              i++ ;

          }

          else if ( ch == "%" )

          {

              if ( i < ( encoded.length-2 ) 

                   && HEXCHARS.indexOf(encoded.charAt(i+1)) != -1 

                   && HEXCHARS.indexOf(encoded.charAt(i+2)) != -1 )

              {

                   var token = encoded.substr(i,3) ;

                       if ( token == "%80" ) plaintext += "€" ;

                       else

                       {

                           plaintext += unescape( encoded.substr(i,3) );

                       }

                       

                   i += 3;

              }

              else

              {

                   alert( 'Bad escape combination near ...' + encoded.substr(i) ) ;

                   plaintext += "%[ERROR]" ;

                   i++ ;

              }

          }

          else

          {

              plaintext += ch ;

              i++ ;

          }

      } 

      

      return plaintext;

}



function addslashes()

{

    var str = this.replace(/\'/g,'\\\'');

    str = str.replace(/\"/g,'\\"');

    str = str.replace(/\\/g,'\\\\');

    str = str.replace(/\0/g,'\\0');

    

    return str ;

}



function stripslashes()

{

    var str = this.replace(/\\'/g,'\'');

    str = str.replace(/\\"/g,'"');

    str = str.replace(/\\\\/g,'\\');

    str = str.replace(/\\0/g,'\0');

    

    return str ;

}



function replaceAll( s1, s2 ) { return this.split( s1 ).join( s2 ) ; }



/*

function intrude( intruderSTR )

{

    var outputSTR = "" ;

    var l = this.length ;

    

    for( i = 0 ; i < l ; i++ )

    {

        outputSTR += this.charAt( i );

        if ( i < ( l - 1 ) ) outputSTR += intruderSTR ;

    }

    

    return outputSTR ;

}

*/



function stripOutTags()

{

    var str = this ;

    var bracketsSEMAPHORE = 0 ;

    var resultSTR = "" ;

    

    var l = str.length ;

    

    for( i = 0 ; i < l ; i++ )

    {

        var ch = str.charAt( i ) ;

    

        if ( ch == "<" ) ++bracketsSEMAPHORE ;

        else if ( ch == ">" ) --bracketsSEMAPHORE ;

        else if ( bracketsSEMAPHORE == 0 ) resultSTR += ch ;

    }

    

    return resultSTR ;

}



function html_entity_decode()

{ 

    var str = this.replaceAll( "&lsquo;", "“" );

    str = str.replaceAll( "&ldquo;", "”" );

    str = str.replaceAll( "&quot;", "\"" );



    str = str.replaceAll( "&agrave;", "à" );

    str = str.replaceAll( "&aacute;", "á" );

    str = str.replaceAll( "&acirc;", "â" );

    str = str.replaceAll( "&#259;", "ã" );

    str = str.replaceAll( "&auml;", "ä" );

    str = str.replaceAll( "&#314;", "å" );

    str = str.replaceAll( "&#Agrave;", "À" );

    str = str.replaceAll( "&#Aacute;", "Á" );

    str = str.replaceAll( "&#Acirc;", "Â" );

    str = str.replaceAll( "&#258;", "Ã" );

    str = str.replaceAll( "&#Auml;", "Ä" );

    str = str.replaceAll( "&#313;", "Å" );



    str = str.replaceAll( "&#263;", "æ" );

    str = str.replaceAll( "&#262;", "Æ" );



    str = str.replaceAll( "&ccedil;", "ç" );

    str = str.replaceAll( "&Ccedil;", "Ç" );



    str = str.replaceAll( "&#egrave;", "è" );

    str = str.replaceAll( "&eacute;", "é" );

    str = str.replaceAll( "&#281;", "ê" );

    str = str.replaceAll( "&euml;", "ë" );

    str = str.replaceAll( "&Egrave;", "È" );

    str = str.replaceAll( "&Eacute;", "É" );

    str = str.replaceAll( "&#280;", "Ê" );

    str = str.replaceAll( "&Euml;", "Ë" );



    str = str.replaceAll( "&igrave;", "ì" );

    str = str.replaceAll( "&iacute;", "í" );

    str = str.replaceAll( "&icirc;", "î" );

    str = str.replaceAll( "&#271;", "ï" );

    str = str.replaceAll( "&Igrave;", "Ì" );

    str = str.replaceAll( "&Iacute;", "Í" );

    str = str.replaceAll( "&Icirc;", "Î" );

    str = str.replaceAll( "&#270;", "Ï" );



    str = str.replaceAll( "&lt;", "<" );

    str = str.replaceAll( "&gt;", ">" );



    str = str.replaceAll( "&#272;", "Ð" );



    str = str.replaceAll( "&#324;", "ñ" );

    str = str.replaceAll( "&#323;", "Ñ" );



    str = str.replaceAll( "&oelig;", "¶" );



    str = str.replaceAll( "&ograve;", "ò" );

    str = str.replaceAll( "&oacute;", "ó" );

    str = str.replaceAll( "&ocirc;", "ô" );

    str = str.replaceAll( "&#337;", "õ" );

    str = str.replaceAll( "&#ouml;", "ö" );

    str = str.replaceAll( "&Ograve;", "Ò" );

    str = str.replaceAll( "&Oacute;", "Ó" );

    str = str.replaceAll( "&Ocirc;", "Ô" );

    str = str.replaceAll( "&#336;", "Õ" );

    str = str.replaceAll( "&Ouml;", "Ö" );



    str = str.replaceAll( "&ugrave;", "ù" );

    str = str.replaceAll( "&uacute;", "ú" );

    str = str.replaceAll( "&ucirc;", "û" );

    str = str.replaceAll( "&uuml;", "ü" );

    str = str.replaceAll( "&Ugrave;", "Ù" );

    str = str.replaceAll( "&Uacute;", "Ú" );

    str = str.replaceAll( "&Ucirc;", "Û" );

    str = str.replaceAll( "&Uuml;", "Ü" );



    str = str.replaceAll( "&#39;", "'" ) ;



    return str ;

}



function accents_encode()

{

    var str = this.replaceAll( "à", "a'" );

        str = str.replaceAll( "è", "e'" );

        str = str.replaceAll( "é", "e'" );

        str = str.replaceAll( "ì", "i'" );

        str = str.replaceAll( "ò", "o'" );

        str = str.replaceAll( "ù", "u'" );



    return str ;

}



function accents_decode()

{

    var str = this.replaceAll( "a'", "à" );

        str = str.replaceAll( "e'", "è" );

        str = str.replaceAll( "e'", "é" );

        str = str.replaceAll( "i'", "ì" );

        str = str.replaceAll( "o'", "ò" );

        str = str.replaceAll( "u'", "ù" );



    return str ;

}



function html_entity_encode()

{ 

    var str = this.replaceAll( "\"", "&quot;" );

    str = str.replaceAll( "“", "&lsquo;" );

    str = str.replaceAll( "”", "&ldquo;" );



    str = str.replaceAll( "à", "&agrave;" );

    str = str.replaceAll( "á", "&aacute;" );

    str = str.replaceAll( "â", "&acirc;" );

    str = str.replaceAll( "ã", "&#259;" );

    str = str.replaceAll( "ä", "&auml;" );

    str = str.replaceAll( "å", "&#314;" );

    str = str.replaceAll( "À", "&#Agrave;" );

    str = str.replaceAll( "Á", "&#Aacute;" );

    str = str.replaceAll( "Â", "&#Acirc;" );

    str = str.replaceAll( "Ã", "&#258;" );

    str = str.replaceAll( "Ä", "&#Auml;" );

    str = str.replaceAll( "Å", "&#313;" );





    str = str.replaceAll( "æ", "&#263;" );

    str = str.replaceAll( "Æ", "&#262;" );



    str = str.replaceAll( "ç", "&ccedil;" );

    str = str.replaceAll( "Ç", "&Ccedil;" );



    str = str.replaceAll( "è", "&#egrave;" );

    str = str.replaceAll( "é", "&eacute;" );

    str = str.replaceAll( "ê", "&#281;" );

    str = str.replaceAll( "ë", "&euml;" );

    str = str.replaceAll( "È", "&Egrave;" );

    str = str.replaceAll( "É", "&Eacute;" );

    str = str.replaceAll( "Ê", "&#280;" );

    str = str.replaceAll( "Ë", "&Euml;" );



    str = str.replaceAll( "ì", "&igrave;" );

    str = str.replaceAll( "í", "&iacute;" );

    str = str.replaceAll( "î", "&icirc;" );

    str = str.replaceAll( "ï", "&#271;" );

    str = str.replaceAll( "Ì", "&Igrave;" );

    str = str.replaceAll( "Í", "&Iacute;" );

    str = str.replaceAll( "Î", "&Icirc;" );

    str = str.replaceAll( "Ï", "&#270;" );



    str = str.replaceAll( "Ð", "&#272;" );



    str = str.replaceAll( "ñ", "&#324;" );

    str = str.replaceAll( "Ñ", "&#323;" );



    str = str.replaceAll( "¶", "&oelig;" );



    str = str.replaceAll( "ò", "&ograve;" );

    str = str.replaceAll( "ó", "&oacute;" );

    str = str.replaceAll( "ô", "&ocirc;" );

    str = str.replaceAll( "õ", "&#337;" );

    str = str.replaceAll( "ö", "&#ouml;" );

    str = str.replaceAll( "Ò", "&Ograve;" );

    str = str.replaceAll( "Ó", "&Oacute;" );

    str = str.replaceAll( "Ô", "&Ocirc;" );

    str = str.replaceAll( "Õ", "&#336;" );

    str = str.replaceAll( "Ö", "&Ouml;" );



    str = str.replaceAll( "ù", "&ugrave;" );

    str = str.replaceAll( "ú", "&uacute;" );

    str = str.replaceAll( "û", "&ucirc;" );

    str = str.replaceAll( "ü", "&uuml;" );

    str = str.replaceAll( "Ù", "&Ugrave;" );

    str = str.replaceAll( "Ú", "&Uacute;" );

    str = str.replaceAll( "Û", "&Ucirc;" );

    str = str.replaceAll( "Ü", "&Uuml;" );



    str = str.replaceAll( "'", "&#39;" ) ;



    return str ;

}



function reverse()

{

    var retSTR = "" ;

    

    for( i = ( this.length - 1 ) ; i >= 0 ; i-- )

    {

        retSTR += this.charAt( i );

    }

    

    return retSTR ;

}



function embedQuotes()

{

      var str = this.replaceAll( "\"", "\\\"" ) ;

      return str.replaceAll( "'", "\'" ) ;

}



function isNumber()

{

    var regularEXPR = new RegExp( "^[0-9.,\+\-]{1,}$" ) ;

    return regularEXPR.test( this );

}



function onlyDigits()

{

    var regularEXPR = new RegExp( "^[0-9]{1,}$" ) ;

    return regularEXPR.test( this );

}



function isAlpha()

{

    var regularEXPR = new RegExp( "^[a-zA-z]{1,}$" ) ;

    return regularEXPR.test( this );

}



function isAlphaLower()

{

    var regularEXPR = new RegExp( "^[a-z]{1,}$" ) ;

    return regularEXPR.test( this );

}



function isAlphaUpper()

{

    var regularEXPR = new RegExp( "^[A-Z]{1,}$" ) ;

    return regularEXPR.test( this );

}



function isAlphanumeric()

{

    var regularEXPR = new RegExp( "^[a-zA-Z0-9]{1,}$" ) ;

    return regularEXPR.test( this );

}



function testME( regularEXPRESSION )

{

    var regularEXPR = new RegExp( regularEXPRESSION ) ;

    return regularEXPR.test( this );

}



function intME() { return parseInt( this, 10 ); }

function floatME() { return parseFloat( this, 10 ); }



function utf8_encode()

{

        string = this.replace(/\r\n/g,"\n");



        var utftext = "";



        for (var n = 0; n < string.length; n++)

        {

            var c = string.charCodeAt(n);



            if (c < 128) { utftext += String.fromCharCode(c); }

            else if ( ( c > 127 ) && ( c < 2048 ) )

            {

                utftext += String.fromCharCode((c>>6)|192);

                utftext += String.fromCharCode((c&63)|128);

            }

            else

            {

                utftext += String.fromCharCode((c>>12)|224);

                utftext += String.fromCharCode(((c>>6)&63)|128);

                utftext += String.fromCharCode((c&63)|128);

            }

        }



        return utftext ;

}



function utf8_decode()

{

        var string = "";

        var i = 0;

        var c = c1 = c2 = 0;



        var utftext = this ;



        while ( i < utftext.length )

        {

            c = utftext.charCodeAt(i);



            if (c < 128)

            {

                string += String.fromCharCode(c);

                i++;

            }

            else if((c > 191) && (c < 224))

            {

                c2 = utftext.charCodeAt(i+1);

                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));

                i += 2;

            }

            else

            {

                c2 = utftext.charCodeAt(i+1);

                c3 = utftext.charCodeAt(i+2);

                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));

                i += 3;

            }



        }



        return string;

}



function euclideandistancefrom( toSTR )

{

    var fromSTR = this ;



    if ( fromSTR.length != toSTR.length ) return -1 ;

    else

    {

        var sum = 0 ;

        for( i = 0 ; i < fromSTR.length ; i++ )

        {

            var fromCHARval = fromSTR.charCodeAt( i ) ;

            var toCHARval = toSTR.charCodeAt( i ) ;

            

            // compute distance in Euclidean metric

            sum += Math.abs( fromCHARval - toCHARval ) ;

        }

    

        return sum ;

    }

}



function fromURLtoSTRING()

{

    var s = this.replaceAll( "&", "%46" ) ;



    return s ;

}



function fromSTRINGtoURL()

{

    var s = this.replaceAll( "%46", "&" ) ;



    return s ;

}



String.prototype.fromSTRINGtoURL = fromSTRINGtoURL // turn ambiguous chars for URLs into number codes

String.prototype.fromURLtoSTRING = fromURLtoSTRING // ... back



String.prototype.trim = function()  { return this.replace(/^\s+|\s+$/g,""); }

String.prototype.ltrim = function() { return this.replace(/^\s+/,""); }

String.prototype.rtrim = function() { return this.replace(/\s+$/,""); }



// String.prototype.intruder = intruder ;

String.prototype.stripOutTags = stripOutTags ;

String.prototype.embedQuotes = embedQuotes ;

String.prototype.reverse = reverse ;



String.prototype.intME = intME ;

String.prototype.floatME = floatME ;



String.prototype.addslashes = addslashes ;

String.prototype.stripslashes = stripslashes ;

String.prototype.replaceAll = replaceAll ;



String.prototype.euclideandistancefrom = euclideandistancefrom ;



String.prototype.accents_encode = accents_encode ;

String.prototype.accents_decode = accents_decode ;



String.prototype.html_entity_decode = html_entity_decode ;

String.prototype.html_entity_encode = html_entity_encode ;



String.prototype.isNumber = isNumber ;

String.prototype.isAlpha = isAlpha ;

String.prototype.isAlphaLower = isAlphaLower ;

String.prototype.isAlphaUpper = isAlphaUpper ;

String.prototype.isAlphanumeric = isAlphanumeric ;



String.prototype.testME = testME ;



String.prototype.onlyDigits = onlyDigits ;



String.prototype.utf8_encode = utf8_encode ;

String.prototype.utf8_decode = utf8_decode ;



String.prototype.urlencode = urlencode ;

String.prototype.urldecode = urldecode ;


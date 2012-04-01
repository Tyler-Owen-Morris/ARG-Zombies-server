// constructor



Date.prototype.daysInMonth = function() { return new Date( this.getFullYear(), this.getMonth() + 1, 0 ).getDate() ; }



function calendar( startMONTH, startDAY, startYEAR, langCODE, dateFORMAT )

{

    var t = new Date();

    t.setFullYear( startYEAR, startMONTH, startDAY );

    

    // default flags settings

    this.bClassOperative = false ;

    this.bHighlightOverCell = true ;

    this.bMondayStart = true ;

    this.bContainerClose = false ;      

    this.returnCTRLexists = false ;

    this.bUseCombosForYearAndMonth = false ;      

    this.bPaintPastDays = false ;      



    this.endMONTHS = new Array( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ) ;



    this.ContainerGoBackButton = "" ;

    this.ContainerGoForthButton = "" ;



    this.ContainerID = "" ;

    this.ContainerCodeButton = "" ;



    this.dateFORMAT = dateFORMAT ;

    

    this.returnCTRLtype = "" ;

    this.returnCTRLid = "" ;



    // not initialized yet, they will be through the setLANG member function

    this.langCODE = "" ;

    this.nameMONTHS ;

    this.nameWEEKDAYS ;

    

    this.setLANG( langCODE );



    this.startMONTH = ( startMONTH >= 1 && startMONTH <= 12 ) ? startMONTH : 0 ;

    this.startDAY = startDAY % t.daysInMonth() ;

    this.startYEAR = startYEAR ;



    var today = new Date();   var current_year = today.getFullYear();

    

    this.rangeYEARfrom = current_year - 10 ;

    this.rangeYEARto = current_year + 10 ;



    // STYLE attributes

    

    this.masterTABLEbkCOLOR = "white" ;

    this.masterTABLEborderSIZE = "1px" ;

    this.masterTABLEborderSTYLE = "inset" ;

    this.masterTABLEborderCOLOR = "#A9A9A9" ;



    this.calendarTABLEbkCOLOR = "#CCFF99" ;

    this.calendarTABLEborderSIZE = "1px" ;

    this.calendarTABLEborderSTYLE = "solid" ;

    this.calendarTABLEborderCOLOR = "#909090" ;

    

    this.cellWidth = "24px" ;

    this.cellHeight = "18px" ;

    this.cellTextAlignment = "center" ;

    this.cellFontSize = "8pt" ;

    this.cellFontFamily = "tahoma" ;

    this.cellBackgroundColor = "#B3FF66" ;

    this.cellHighlightColor = "#FFFFFF" ;

    this.cellBorderSize = "1px" ;

    this.cellBorderStyle = "solid" ;

    this.cellBorderColor = "#99CC00" ;

    this.cellBackgroundColor_PastDays = "#8CD9B3" ;



    this.weekdayTextAlignment = "center" ;

    this.weekdayFontSize = "8pt" ;

    this.weekdayFontFamily = "tahoma" ;

    this.weekdayFontWeight = "bold" ;

    this.weekdayBackgroundColor = "#99FF33" ;

    this.weekdayBorderSize = "1px" ;

    this.weekdayBorderStyle = "solid" ;

    this.weekdayBorderColor = "#00B0C6" ;

    this.weekdayCellWidth = "24px" ;

    this.weekdayCellHeight = "14px" ;



    this.headerCellWidth = "180px" ;

    this.headerCellHeight = "14px" ;

    this.headerTextAlignment = "center" ;

    this.headerFontWeight = "bold" ;

    this.headerFontFamily = "tahoma" ;

    this.headerFontSize = "9pt" ;

    this.headerBackgroundColor = "#00E0E6" ;

    this.headerCellBorderSize = "1px" ;

    this.headerCellBorderStyle = "solid" ;

    this.headerCellBorderColor = "#909090" ;

    

    this.comboBorderSize = "1px" ;

    this.comboBorderStyle = "solid" ;

    this.comboBorderColor = "#D0D0D0" ;

    this.comboFontSize = "8pt" ;

    this.comboFontWeight = "normal" ;

    this.comboFontFamily = "tahoma" ;

    this.comboPadding = "0px" ;

    this.comboMargin = "0px" ;

    this.comboBackgroundColor = "white" ;

}





// member functions



calendar.prototype.setRangeYearFrom = function( y ) { this.rangeYEARfrom = y ; }

calendar.prototype.setRangeYearTo = function( y )   { this.rangeYEARto = y ;   }



calendar.prototype.setCellFontSize = function( value, unit_of_measurement ) { this.fontSize = value + unit_of_measurement ; }

calendar.prototype.setCellFontFamily = function( value ) { this.fontFamily = value ; }

calendar.prototype.setCellWidth = function( value, unit_of_measurement ) { this.cellWidth = value + unit_of_measurement ; }

calendar.prototype.setCellHeight = function( value, unit_of_measurement ) { this.cellHeight = value + unit_of_measurement ; }

calendar.prototype.setCellTextAlignment = function( value ) { 

    if ( value.indexOf( "left" ) ) this.cellTextAlignment = "left" ;

    if ( value.indexOf( "right" ) ) this.cellTextAlignment = "right" ;

    if ( value.indexOf( "center" ) ) this.cellTextAlignment = "center" ;

    if ( value.indexOf( "justify" ) ) this.cellTextAlignment = "justify" ;

}



calendar.prototype.setPaintPastDays = function( bPPD ) { this.bPaintPastDays = bPPD ; }

calendar.prototype.setHighlightOverCell = function( bH ) { this.HighlightOverCell = bH ; }

calendar.prototype.setDateFormat = function( dF ) { this.dateFORMAT = dF ; }

calendar.prototype.setMondayStart = function( bMondayStart ) { this.bMondayStart = bMondayStart ; }

calendar.prototype.setCombosForYearAndMonth = function ( bCombos ) { this.bUseCombosForYearAndMonth = bCombos ; }



calendar.prototype.getMonthName = function() { return this.nameMONTHS[ this.startMONTH ] ; }



calendar.prototype.setContainerID = function( cID ) { this.ContainerID = cID ; }

calendar.prototype.enableContainerClose = function ( bClose ) { this.bContainerClose = bClose ; }



calendar.prototype.closecalendar = function() { document.getElementById( this.ContainerID ).style.display='none'; }



calendar.prototype.defaultStatus = function()

{

    // default flags settings

    this.bClassOperative = false ;

    this.bHighlightOverCell = true ;

    this.bMondayStart = true ;

    this.bContainerClose = false ;      

    this.returnCTRLexists = false ;

    this.bUseCombosForYearAndMonth = false ;      



    this.endMONTHS = new Array( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ) ;



    this.ContainerGoBackButton = "" ;

    this.ContainerGoForthButton = "" ;



    this.ContainerID = "" ;

    this.ContainerCodeButton = "" ;



    this.returnCTRLtype = "" ;

    this.returnCTRLid = "" ;



    // not initialized yet, they will be through the setLANG member function

    this.langCODE = "" ;

    

    this.startMONTH = ( startMONTH >= 1 && startMONTH <= 12 ) ? startMONTH - 1 : 0 ;

    this.startDAY = startDAY % t.daysInMonth() ;

    this.startYEAR = startYEAR ;



    var today = new Date();   var current_year = today.getFullYear();

    

    this.rangeYEARfrom = current_year - 10 ;

    this.rangeYEARto = current_year + 10 ;



    // STYLE attributes

    

    this.masterTABLEbkCOLOR = "white" ;

    this.masterTABLEborderSIZE = "1px" ;

    this.masterTABLEborderSTYLE = "solid" ;

    this.masterTABLEborderCOLOR = "#909090" ;



    this.calendarTABLEbkCOLOR = "#00E0D6" ;

    this.calendarTABLEborderSIZE = "1px" ;

    this.calendarTABLEborderSTYLE = "solid" ;

    this.calendarTABLEborderCOLOR = "#909090" ;

    

    this.cellWidth = "24px" ;

    this.cellHeight = "14px" ;

    this.cellTextAlignment = "center" ;

    this.cellFontSize = "8pt" ;

    this.cellFontFamily = "tahoma" ;

    this.cellBackgroundColor = "#00C0D6" ;

    this.cellHighlightColor = "#FFFFFF" ;

    this.cellBorderSize = "1px" ;

    this.cellBorderStyle = "solid" ;

    this.cellBorderColor = "#00B0C6" ;



    this.weekdayTextAlignment = "center" ;

    this.weekdayFontSize = "8pt" ;

    this.weekdayFontFamily = "tahoma" ;

    this.weekdayFontWeight = "bold" ;

    this.weekdayBackgroundColor = "#00C0D6" ;

    this.weekdayBorderSize = "1px" ;

    this.weekdayBorderStyle = "solid" ;

    this.weekdayBorderColor = "#00B0C6" ;

    this.weekdayCellWidth = "24px" ;

    this.weekdayCellHeight = "14px" ;



    this.headerCellWidth = "170px" ;

    this.headerCellHeight = "14px" ;

    this.headerTextAlignment = "center" ;

    this.headerFontWeight = "bold" ;

    this.headerFontFamily = "tahoma" ;

    this.headerFontSize = "9pt" ;

    this.headerBackgroundColor = "#00E0E6" ;

    this.headerCellBorderSize = "1px" ;

    this.headerCellBorderStyle = "solid" ;

    this.headerCellBorderColor = "#909090" ;



    this.comboBorderSize = "1px" ;

    this.comboBorderStyle = "solid" ;

    this.comboBorderColor = "#D0D0D=" ;

    this.comboFontSize = "8pt" ;

    this.comboPadding = "0px" ;

    this.comboMargin = "0px" ;

    this.comboFontFamily = "tahoma" ;

    this.comboBackgroundColor = "white" ;

    

    // additional calls

    cal.setCombosForYearAndMonth( false );

    cal.setMondayStart( true );

}



calendar.prototype.HideCalendar = function() {

    var CODE = "" ;



    if ( this.ContainerID.length > 0 && this.bContainerClose &&

         document.getElementById( this.ContainerID ) != null )

    {

        document.getElementById( this.ContainerID ).style.display = 'none' ;

    }

}



calendar.prototype.arrangeComboStyle = function (){

    var STYLE = "" ;



        STYLE += "border:" + this.comboBorderSize + " " + this.comboBorderStyle + " " + this.comboBorderColor + ";" ;

        STYLE += "background-color:" + this.comboBackgroundColor + ";" ;

        STYLE += "font-size:" + this.comboFontSize + ";" ;

        STYLE += "font-weight:" + this.comboFontWeight + ";" ;

        STYLE += "font-family:" + this.comboFontFamily + ";" ;

        STYLE += "text-align:" + this.comboPadding + ";" ;

        STYLE += "text-align:" + this.comboMargin + ";" ;



        STYLE += "" ;

    return STYLE ;

}



calendar.prototype.arrangeCloseCode = function() {

    var CODE = "" ;



    if ( this.ContainerID.length > 0 && this.bContainerClose &&

         document.getElementById( this.ContainerID ) != null )

    {

        CODE += "<td align=\"center\" style=\"font-size:9pt;\"><a href=\"javascript:void(0);\" onclick=\"javascript:document.getElementById('"+this.ContainerID+"').style.display='none';\">" + this.ContainerCodeButton + "</a></td>\r\n" ;

    }



  return CODE ;

}



calendar.prototype.arrangeGoBackCode = function () {

    var CODE = "" ;



    if ( this.ContainerID.length > 0 && document.getElementById( this.ContainerID ) != null )

    {

        if ( this.ContainerGoBackButton.length == 0 ) this.ContainerGoBackButton = "<" ;

        

        CODE += "<td align=\"center\" style=\"font-size:9pt;\"><a href=\"javascript:cal.oneMonthBack();\">" + this.ContainerGoBackButton + "</a></td>\r\n" ;

    }



  return CODE ;

}



calendar.prototype.arrangeGoForthCode = function () {

    var CODE = "" ;



    if ( this.ContainerID.length > 0 && document.getElementById( this.ContainerID ) != null )

    {

        if ( this.ContainerGoForthButton.length == 0 ) this.ContainerGoForthButton = ">" ;

        

        CODE += "<td align=\"center\" style=\"font-size:9pt;\"><a href=\"javascript:cal.oneMonthForth();\">" + this.ContainerGoForthButton + "</a></td>\r\n" ;

    }



  return CODE ;

}



calendar.prototype.setDateFromCombo = function()

{

    var monthCOMBO = document.getElementById( "monthCOMBO" );

    var yearCOMBO = document.getElementById( "yearCOMBO" );



    if ( monthCOMBO != null && yearCOMBO != null )

    {

          var startMONTH = monthCOMBO.options[ monthCOMBO.selectedIndex ].value ;

          var startYEAR = yearCOMBO.options[ yearCOMBO.selectedIndex ].value ;

          

          var t = new Date();

          t.setFullYear( startYEAR, startMONTH, 1 );



          this.startMONTH = ( startMONTH >= 1 && startMONTH <= 12 ) ? startMONTH : 0 ;

          this.startDAY = this.startDAY % t.daysInMonth() ;

          this.startYEAR = startYEAR ;

          

          this.drawCalendar();

    }

}



calendar.prototype.arrangeCombosYearMonth = function()

{

    var today = new Date() ; 

    var current_year = today.getFullYear() ;    var current_month_index = today.getMonth();

    

    var CODE = "" ;

    

    // fill-in months combo

    CODE = "<td id=\"header\">";

    CODE += "<select onchange=\"javascript:cal.setDateFromCombo();\" id=\"monthCOMBO\" STYLE=\""+this.arrangeComboStyle()+"\">" ;



    for( month_index = 0 ; month_index < this.nameMONTHS.length ; month_index++ )

    {

        CODE += "<option value=\""+month_index+"\" "+( ( current_month_index == month_index ) ? "selected=\"selected\"" : "" )+">"+this.nameMONTHS[month_index] ;

    }

    

    CODE += "</select>" ;

    CODE += "</td>" ;



    // fill-in years combo

    CODE += "<td>";

    CODE += "<select onchange=\"javascript:cal.setDateFromCombo();\" id=\"yearCOMBO\" STYLE=\""+this.arrangeComboStyle()+"\">" ;



    for( i = this.rangeYEARfrom ; i <= this.rangeYEARto ; i++ )

    {

        CODE += "<option value=\""+i+"\" "+( ( current_year == i ) ? "selected=\"selected\"" : "" )+">"+i ;

    }



    CODE += "</select>" ;

    CODE += "</td>" ;

    

    return CODE ;

}



calendar.prototype.setReturnCTRL = function( type, id )

{ 

    this.returnCTRLtype = type ;

    this.returnCTRLid = id ;

    

    if ( this.returnCTRLtype.length == 0 || this.returnCTRLid.length == 0 )

        returnCTRLexists = false ;

    else

    {

        var CTRL = document.getElementById( this.returnCTRLid ) ;

        this.returnCTRLexists = ( CTRL == null ) ? false : true ;

    }

}



calendar.prototype.formatDate = function( y, m, d )

{

    var dateARRAY = new Array( 0, 0, 0 );

    

    this.dateFORMAT = this.dateFORMAT.replaceAll( "/", "-" );

    this.dateFORMAT = this.dateFORMAT.toLowerCase() ;

    var tokens = this.dateFORMAT.split( "-" );

    

    var day = 0 ;

    var month = 0 ;

    var year = 0 ;

    

    var bTEXTmode = false ;



    for( i = 0 ; i < tokens.length ; i++ )

    {

        switch( tokens[i] )

        {

            case "d":

                d =  parseInt( d, 10 ) ;

            break;

            case "dd":

                d =  parseInt( d, 10 ) < 10 ? "0" + parseInt( d, 10 ) : parseInt( d, 10 ) ;

            break;

            case "m":

                m =  parseInt( m, 10 ) ;

            break;

            case "mm":

                m =  parseInt( m, 10 ) < 10 ? "0" + parseInt( m, 10 ) :  parseInt( m, 10 ) ;

            break;

            case "mmm":

                bTEXTmode = true ;

            		m =  this.nameMONTHS[ parseInt( m, 10 ) - 1 ] ;

            break;

            case "yy":

                y =  parseInt( y, 10 ) % 100 ;

		            y =  parseInt( y, 10 ) < 10 ? "0" + parseInt( y, 10 ) :  parseInt( y, 10 ) ;

            break;

            case "yyyy":

                y =  parseInt( y, 10 ) ;

            break;

        }

    }

    

    var retDATE = new Array() ;

    

    for( i = 0 ; i < tokens.length ; i++ )

    {

          if ( tokens[ i ] == "dd" || tokens[ i ] == "d" ) retDATE.push ( d ) ;

          else if ( tokens[ i ] == "m" || tokens[ i ] == "mm" || tokens[ i ] == "mmm" ) retDATE.push( m ) ;

          else if ( tokens[ i ] == "yyyy" || tokens[ i ] == "yy" ) retDATE.push( y ) ;

    }

    

    return ( bTEXTmode ) ? retDATE.join( " " ) : retDATE.join( "-" ) ;

}



calendar.prototype.arrangeDateLinkIN = function( dayNUMBER ) {

      if ( this.returnCTRLexists )

      {

          var JScode = "" ;

          var CTRL = document.getElementById( this.returnCTRLid ) ;

          var returnDATEformat = "" ;

      

          var returnDATEformat = this.formatDate( this.startYEAR, parseInt( this.startMONTH, 10 ) + 1, dayNUMBER );

      

          if ( CTRL.tagName == "INPUT" )

              JScode = "document.getElementById( '" + this.returnCTRLid + "' ).value='" + returnDATEformat + "';" ;

          else

              JScode = "document.getElementById( '" + this.returnCTRLid + "' ).innerHTML='" + returnDATEformat + "';" ;

			  

			 var JScode2 = "" ;

			JScode2 = "document.getElementById( 'calendarDIV' ).style.display='none'" ;

			

          var HTMLcode = "<a STYLE=\"text-decoration:none;\" href=\"javascript:void(0);\" onclick=\"javascript:"+JScode+";"+JScode2+"\" >" ;

      

          return HTMLcode ;

      }

      else return "" ;

}



calendar.prototype.arrangeDateLinkOUT = function( dayNUMBER ) { return ( this.returnCTRLexists ) ? "</a>" : "" ; }



calendar.prototype.setLANG = function( langCODE ) {

    if ( langCODE.length != 2 ) this.langCODE = "en" ;

    else this.langCODE = langCODE.toLowerCase() ;

    

    var bFOUND = false ;

    

    // scan array for months name array

    for( i = 0 ; i < nameMONTHS.length; i += 2 )

    {

        if ( langCODE == nameMONTHS[ i ].toLowerCase() )

        {

            bFOUND = true ;

            this.nameMONTHS = nameMONTHS[ i + 1 ] ;

            break;

        }

    }



    if ( !bFOUND ) this.bClassOperative = false ;

    else

    {

        bFOUND = false ;

        // scan array for weekdays name array

        for( i = 0 ; i < nameWEEKDAYS.length; i += 2 )

        {

            if ( langCODE == nameWEEKDAYS[ i ].toLowerCase() )

            {

                bFOUND = true ;

                this.nameWEEKDAYS = nameWEEKDAYS[ i + 1 ] ;

                break;

            }

        }

        

        if ( !bFOUND ) this.bClassOperative = false ;

        else this.bClassOperative = true ;

    }

}



calendar.prototype.arrangeGeneralTableStyle = function (){

    var STYLE = "" ;



        STYLE += "padding:0px;" ;

        STYLE += "margin:0px;" ;

        STYLE += "width:190px;" ;

        STYLE += "border-collapse:collapse;" ;



        STYLE += "" ;

    return STYLE ;

}



calendar.prototype.arrangeMasterTableStyle = function (){

    var STYLE = "" ;



        STYLE += "padding:0px;" ;

        STYLE += "margin:0px;" ;

        STYLE += "background-color:" + this.masterTABLEbkCOLOR + ";" ;

        STYLE += "border:" + this.masterTABLEborderSIZE + " " + this.masterTABLEborderSTYLE + " " + this.masterTABLEborderCOLOR + ";" ;



        STYLE += "" ;

    return STYLE ;

}



calendar.prototype.arrangeCalendarTableStyle = function (){

    var STYLE = "" ;



        STYLE += "border-collapse:collapse;" ;

        STYLE += "background-color:" + this.calendarTABLEbkCOLOR + ";" ;

        STYLE += "border:" + this.calendarTABLEborderSIZE + " " + this.calendarTABLEborderSTYLE + " " + this.calendarTABLEborderCOLOR + ";" ;



        STYLE += "" ;

    return STYLE ;

}



calendar.prototype.arrangeWeekdayStyle = function (){

    var STYLE = "" ;



        STYLE += "border:" + this.weekdayCellBorderSize + " " + this.weekdayCellBorderStyle + " " + this.weekdayCellBorderColor + ";" ;

        STYLE += "background-color:" + this.weekdayBackgroundColor + ";" ;

        STYLE += "font-family:" + this.weekdayFontFamily + ";" ;

        STYLE += "font-weight:" + this.weekdayFontWeight + ";" ;

        STYLE += "font-size:" + this.weekdayFontSize + ";" ;

        STYLE += "width:" + this.weekdayCellWidth + ";" ;

        STYLE += "height:" + this.weekdayCellHeight + ";" ;

        STYLE += "text-align:" + this.weekdayTextAlignment + ";" ;



        STYLE += "" ;

    return STYLE ;

}



calendar.prototype.arrangeHeaderStyle = function (){

    var STYLE = "" ;



        STYLE += "border:" + this.headerCellBorderSize + " " + this.headerCellBorderStyle + " " + this.headerCellBorderColor + ";" ;

        STYLE += "background-color:" + this.headerBackgroundColor + ";" ;

        STYLE += "font-family:" + this.headerFontFamily + ";" ;

        STYLE += "font-weight:" + this.headerFontWeight + ";" ;

        STYLE += "font-size:" + this.headerFontSize + ";" ;

        STYLE += "width:" + this.headerCellWidth + ";" ;

        STYLE += "height:" + this.headerCellHeight + ";" ;

        STYLE += "text-align:" + this.headerTextAlignment + ";" ;



        STYLE += "" ;

    return STYLE ;

}



calendar.prototype.arrangeCellStyle = function ( dayNUM ){

    var STYLE = "" ;



        STYLE += "border:" + this.cellBorderSize + " " + this.cellBorderStyle + " " + this.cellBorderColor + ";" ;

        STYLE += "background-color:" + ( ( this.bPaintPastDays && dayNUM < this.startDAY ) ? this.cellBackgroundColor_PastDays : this.cellBackgroundColor ) + ";" ;

        STYLE += "font-family:" + this.cellFontFamily + ";" ;

        STYLE += "font-size:" + this.cellFontSize + ";" ;

        STYLE += "width:" + this.cellWidth + ";" ;

        STYLE += "height:" + this.cellHeight + ";" ;

        STYLE += "text-align:" + this.cellTextAlignment + ";" ;



        STYLE += "" ;

    return STYLE ;

}



calendar.prototype.oneMonthBack = function () {

    var t = new Date();

    t.setFullYear( this.startYEAR, this.startMONTH, this.startDAY );

    

    var candidateMONTH = parseInt( this.startMONTH, 10 ) - 1 ;



    this.startMONTH = ( candidateMONTH < 0 ) ? parseInt( this.endMONTHS.length, 10 ) - 1 : candidateMONTH ;

    var candidateYEAR = ( candidateMONTH < 0 ) ? parseInt( this.startYEAR, 10 ) - 1 : this.startYEAR ;

    

    if ( this.bUseCombosForYearAndMonth )

    {

        var monthCOMBO = document.getElementById( "monthCOMBO" );

        var yearCOMBO = document.getElementById( "yearCOMBO" );

        

        if ( monthCOMBO != null && yearCOMBO != null )

        {

            monthCOMBO.selectedIndex = this.startMONTH ;



            for( i = 0 ; i < yearCOMBO.options.length ; i++ )

            {

                if ( yearCOMBO.options[ i ].value == candidateYEAR )

                {

                    yearCOMBO.selectedIndex = i ;

                    this.startYEAR = candidateYEAR ;

                    break;

                }

            }

        }

    }

    else this.startYEAR = candidateYEAR ;

    

    this.drawCalendar() ;

}



calendar.prototype.oneMonthForth = function () {

    var t = new Date();

    t.setFullYear( this.startYEAR, this.startMONTH, this.startDAY );

    

    var candidateMONTH = this.startMONTH + 1 ;



    this.startMONTH = ( candidateMONTH > ( this.endMONTHS.length - 1 ) ) ? 0 : parseInt( this.startMONTH, 10 ) + 1 ;

    var candidateYEAR = ( candidateMONTH > ( this.endMONTHS.length - 1 ) ) ? parseInt( this.startYEAR, 10 ) + 1 : parseInt( this.startYEAR, 10 ) ;



    if ( this.bUseCombosForYearAndMonth )

    {

        var monthCOMBO = document.getElementById( "monthCOMBO" );

        var yearCOMBO = document.getElementById( "yearCOMBO" );

        

        if ( monthCOMBO != null && yearCOMBO != null )

        {

            monthCOMBO.selectedIndex = this.startMONTH ;



            for( i = 0 ; i < yearCOMBO.options.length ; i++ )

            {

                if ( yearCOMBO.options[ i ].value == candidateYEAR )

                {

                    yearCOMBO.selectedIndex = i ;

                    this.startYEAR = candidateYEAR ;

                    break;

                }

            }

        }

    }

    else this.startYEAR = candidateYEAR ;



    this.drawCalendar() ;

}



calendar.prototype.drawCalendar = function () {

    var t = new Date();



    this.startDAY = 1 ;

    t.setFullYear( this.startYEAR, this.startMONTH, this.startDAY );

    t.setDate( 1 );

    

    var dayWeek = t.getDay();

    if ( this.bMondayStart && dayWeek == 0 ) dayWeek = 1 ;

    

    var MASTERtableSTYLE = this.arrangeMasterTableStyle() ;

    var GENERALtableSTYLE = this.arrangeGeneralTableStyle() ;

    var CALENDARtableSTYLE = this.arrangeCalendarTableStyle() ;

    var headerSTYLE = this.arrangeHeaderStyle() ;

    var weekdaySTYLE = this.arrangeWeekdayStyle() ;

    

    var HTMLcode = "" ;

    var aIN = "" ;

    var aOUT = "" ;    



    if ( document.getElementById( "header" ) == null )

    {

         HTMLcode = "<table cellpadding=0 cellspacing=0  valign=\"top\" id=\"calendar\" style=\"" + MASTERtableSTYLE + "\">\r\n" ;

         HTMLcode += "<tr><td HEIGHT=\"5\"></td></tr>" ;

          

         HTMLcode += "<tr>\r\n" ;

         HTMLcode += "<td valign=\"top\">\r\n" ;

         HTMLcode += "<table ID=\"generaltable\" cellpadding=0 cellspacing=0  border=0 valign=\"top\" style=\"" + GENERALtableSTYLE + "\">\r\n" ;

         HTMLcode += "<tr>\r\n" ;

         HTMLcode += "<td style=\"width:2px;\"></td>" ;

         HTMLcode += "<td style=\"text-align:center;\">"+this.arrangeGoBackCode()+"</td>\r\n" ;

         HTMLcode += "<td style=\"text-align:center;\">"+this.arrangeGoForthCode()+"</td>\r\n" ;

         HTMLcode += "<td style=\"width:2px;\"></td>" ;

         

         if ( this.bUseCombosForYearAndMonth ) HTMLcode += this.arrangeCombosYearMonth() ;

         else HTMLcode += "<td id=\"header\" style=\"" + headerSTYLE + "\">" + this.getMonthName() + " " + this.startYEAR + "</td>\r\n" ;

         

         HTMLcode += "<td style=\"width:2px;\"></td>" ;

         HTMLcode += this.arrangeCloseCode() ;

         HTMLcode += "<td style=\"width:2px;\"></td>" ;

         HTMLcode += "</tr>\r\n" ;

         HTMLcode += "</table>\r\n" ;

         HTMLcode += "</td>\r\n" ;

         HTMLcode += "</tr>\r\n" ;



         HTMLcode += "<tr><td HEIGHT=\"5\"></td></tr>" ;



         HTMLcode += "<tr>\r\n" ;

         HTMLcode += "<td valign=\"top\" align=\"center\">\r\n" ;

         HTMLcode += "<div valign=\"top\" id=\"days\" style=\"height:auto;width:auto;\">" ;

         HTMLcode += "<table cellpadding=0 cellspacing=0  style=\"" + CALENDARtableSTYLE + "\" valign=\"top\">\r\n" ;



         HTMLcode += "<tr>" ;

         for( i = 0 ; i < this.nameWEEKDAYS.length ; i++  )

            HTMLcode += "<td style=\"" + weekdaySTYLE + "\">"+this.nameWEEKDAYS[i]+"</td>" ;

         HTMLcode += "</tr>" ;



         HTMLcode += "<tr>\r\n" ;

         // blank cell before the first day of the month

         for( i = ( this.bMondayStart ? 1 : 0 ) ; i < dayWeek; i++ ) HTMLcode += "<td></td>" ;

         

      	 var i = dayWeek ;

         for( d = 1 ; d <= t.daysInMonth(); d++ )

         {

             if ( i % 7 == ( this.bMondayStart ? 1 : 0 ) )

      	     {

            		HTMLcode += "</tr>\r\n<tr>" ;

      	     }

             

             var cellSTYLE = this.arrangeCellStyle( d ) ;

             var overCELLcode = ( this.bHighlightOverCell ) ? "onmouseout=\"javascript:this.style.backgroundColor='"+( ( this.bPaintPastDays && d < this.startDAY ) ? this.cellBackgroundColor_PastDays : this.cellBackgroundColor )+"';\" onmouseover=\"javascript:this.style.backgroundColor='"+this.cellHighlightColor+"';\"" : "" ;



             aIN = this.arrangeDateLinkIN( d );

             aOUT = this.arrangeDateLinkOUT( d );

             

             HTMLcode += "<td " + overCELLcode + " style=\"" + cellSTYLE + "\" >" + aIN + d + aOUT + "</td>" ;

             

             i++ ;

         }

         

         if ( i != 0 ) HTMLcode += "<td colspan=\""+( 7 - i )+"\"></td>";

         HTMLcode += "</tr>\r\n" ;



         HTMLcode += "</table>\r\n" ;

         HTMLcode += "</div>" ;



         HTMLcode += "</td>\r\n" ;

         HTMLcode += "</tr>\r\n" ;



         HTMLcode += "<tr><td HEIGHT=\"5\"></td></tr>" ;



         HTMLcode += "</table>" ;



         document.write( HTMLcode );

    }

    else

    {

        if ( this.bUseCombosForYearAndMonth ) HTMLcode += this.arrangeCombosYearMonth() ;

        else document.getElementById( "header" ).innerHTML = this.getMonthName() + " " + this.startYEAR ;

        

        HTMLcode = "<table cellpadding=0 cellspacing=0  valign=\"top\" id=\"calendar\" style=\"" + CALENDARtableSTYLE + "\">\r\n" ;



        HTMLcode += "<tr>" ;

        for( i = 0 ; i < this.nameWEEKDAYS.length ; i++ )

            HTMLcode += "<td style=\"" + weekdaySTYLE + "\">"+this.nameWEEKDAYS[i]+"</td>" ;

        

        HTMLcode += "</tr>" ;

        HTMLcode += "<tr><td style=\"height:2px;\"></td></tr>\r\n" ;

        HTMLcode += "<tr>\r\n" ;

 

          // blank cell before the first day of the month

          for( i = 1 ; i < dayWeek; i++ ) HTMLcode += "<td></td>" ;

          

      	  var i = dayWeek ;

          for( d = 1 ; d <= t.daysInMonth(); d++ )

          {

              if ( i % 7 == 1 ) HTMLcode += "</tr>\r\n<tr>" ;

              

              aIN = this.arrangeDateLinkIN( d );

              aOUT = this.arrangeDateLinkOUT( d );



              var cellSTYLE = this.arrangeCellStyle( d ) ;

              var overCELLcode = ( this.bHighlightOverCell ) ? "onmouseout=\"javascript:this.style.backgroundColor='"+( ( this.bPaintPastDays && d < this.startDAY ) ? this.cellBackgroundColor_PastDays : this.cellBackgroundColor )+"';\" onmouseover=\"javascript:this.style.backgroundColor='"+this.cellHighlightColor+"';\"" : "" ;

              

              HTMLcode += "<td " + overCELLcode + " style=\"" + cellSTYLE + "\" >" + aIN + d + aOUT + "</td>" ;

      	      i++ ;

          }

        

        if ( i != 0 ) HTMLcode += "<td colspan=\""+( 7 - i )+"\"></td>";

        HTMLcode += "</tr>\r\n" ;

        HTMLcode += "</table>\r\n" ;

        document.getElementById( "days" ).innerHTML = HTMLcode ;

    }

}


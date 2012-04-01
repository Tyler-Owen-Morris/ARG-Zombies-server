function getViewportSize()

{

    var intH = 0, intW = 0;

    if(self.innerHeight)

    {

       intH = window.innerHeight;

       intW = window.innerWidth;

    } 

    else

    {

        if(document.documentElement && document.documentElement.clientHeight)

        {

            intH = document.documentElement.clientHeight;

            intW = document.documentElement.clientWidth;

        }

        else

        {

            if( document.body )

            {

                intH = document.body.clientHeight;

                intW = document.body.clientWidth;

            }

        }

    }



    return new Array( intW, intH );

}



function displayCALENDAR( inputID, top, left )

{

      cal.setReturnCTRL( "edit", inputID );

      cal.drawCalendar();

      var calendarDIV = document.getElementById( "calendarDIV" ) ;

      

      if ( calendarDIV != null )

      {

          var viewportDIMS = getViewportSize() ;

      

          var sW = viewportDIMS[0] ;  var l = parseInt( left );

          var sH = viewportDIMS[1] ;  var t = parseInt( top );

          

          var calendarWIDTH = parseInt( calendarDIV.style.width ) + 25 ;

          var calendarHEIGHT = parseInt( calendarDIV.style.height ) ;



          var newLEFT = ( ( l + calendarWIDTH ) > sW ) ? ( sW - calendarWIDTH ) : l ;

      

          var newTOP = t % sH ; // it maps Y coordinate to the viewport as if left/top corner is 0,0

          newTOP = ( ( newTOP + calendarHEIGHT ) > sH ) ? ( sH - calendarHEIGHT ) : t ;  

      

          calendarDIV.style.display = "block" ;

          calendarDIV.style.top = newTOP + "px" ;

          calendarDIV.style.left = newLEFT + "px" ;

      }

}



function hideCALENDAR()

{

      cal.HideCalendar() ;



      var calendarDIV = document.getElementById( "calendarDIV" ) ;

      if ( calendarDIV != null )

      {

          calendarDIV.style.display = "none" ;

      }

}


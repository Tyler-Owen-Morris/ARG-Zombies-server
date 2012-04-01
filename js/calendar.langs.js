var nameMONTHS = new Array(

                'it', new Array( "Gennaio", "Febbraio", "Marzo", 

                        "Aprile", "Maggio", "Giugno", 

                        "Luglio", "Agosto", "Settembre", 

                        "Ottobre", "Novembre", "Dicembre" ),

                'en', new Array( "January", "February", "March", 

                                 "April", "May", "June",

                                 "July", "August", "September", 

                                 "October", "November", "December" ),

                'fr', new Array( "Janvier", "February", "March", 

                        "Avril", "Mai", "Juin", 

                        "Juillet", "Août", "Septembre", 

                        "Octobre", "Novembre", "Décembre" ),

                'sp', new Array( "Enero", "Febrero", "Marzo", 

                        "Abril", "Mayo", "Junio", 

                        "Julio", "Agosto", "Septiembre", 

                        "Octubre", "Noviembre", "Diciembre" )

                 );



var nameWEEKDAYS = new Array(

                'it', new Array( "Lun", "Mar", "Mer", "Gio", "Ven", "Sab", "Dom" ),

                'en', new Array( "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun" ),

                'fr', new Array( "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim" ),

                'sp', new Array( "Lun", "Mar", "Mié", "Jue", "Vie", "Sab", "Dom" )

                   );

function redirect( pageName, extension ){

 	window.open(pageName+'.'+extension, pageName,'width=500,height=350,resizable=yes,scrollbars=yes,left=100,top=10,screenX=100,screenY=10');

 	return;

 }
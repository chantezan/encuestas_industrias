 var formatos = [];
 var calibres = [];

 function inicio(calibre,formato){
    for (var i = 0; i < formato.length; i++) {

    formatos.push({
      id: formato[i]['id'],
      nombre: formato[i]['nombre'],
    });
  }

    for (var i = 0; i < calibre.length; i++) {

    calibres.push({
      id: calibre[i]['id'],
      nombre: calibre[i]['nombre'],
    });
  }
 };

 $("#embarque").change(function(){
                                        var value = $(this).val();
                                        var e = document.getElementsByName("embarque")[0];
                                        var embarque = e.options[e.selectedIndex].text;
                                        value=JSON.parse(value);

                                        var detalles = document.getElementById("detalles");
                                        var escondido = document.getElementById("escondido");
                                        escondido.value=value['id'];
                                        var peso_bruto = 0;
                                        var peso_neto = 0;
                                        var carga_detalle = JSON.parse(value['detalle_carga']);

                                        $("#Table tbody").empty();

                                        //alert(value);
                                        if(value!=null){
                                        for (var i = 0; i < value['formato'].length; i++) {

                                            for (var j = 0; j < value['calibrexformato'][value['formato'][i]].length; j++) {


                                                if(value['valores'][value['formato'][i]][value['calibrexformato'][value['formato'][i]][j]]==null){
                                                    value['valores'][value['formato'][i]][value['calibrexformato'][value['formato'][i]][j]]=0;
                                                }
                                                peso_neto = peso_neto + value['pesoneto'][value['formato'][i]]*1*value['folioxcaja'][value['formato'][i]][value['calibrexformato'][value['formato'][i]][j]];
                                                peso_bruto = peso_bruto + value['pesobruto'][value['formato'][i]]*1*value['folioxcaja'][value['formato'][i]][value['calibrexformato'][value['formato'][i]][j]];

                                                $("#Table tbody").append(
                                                    "<tr><td >"+value['formato'][i]+ " "+value['calibrexformato'][value['formato'][i]][j]+"<input name='formatos[]' value='"+value['formato'][i]+"|"+value['calibrexformato'][value['formato'][i]][j]+"' type='hidden'></td>"+
                                                    "<td >"+value['folioxcaja'][value['formato'][i]][value['calibrexformato'][value['formato'][i]][j]]+"</td>"+
                                                    "<td >"+"<input name='valor[]' class='valor_ingresado' type='text' placeholder="
                                                    +value['valores'][value['formato'][i]][value['calibrexformato'][value['formato'][i]][j]]+">"+"</td>"+
                                                    "<td name='totaltr[]'></td></tr>");
                                                $(".valor_ingresado").on("keyup", actualizar);
                                            }
                                        }
                                        if (value['formato'].length==0) {//si no hay packing list asociado
                                            var pasadas = 0;
                                            for (var j = 0; j <carga_detalle['formato'].length; j++) {

                                            
                                            for (var i = 0; i < carga_detalle['CXF'][j]; i++) {
                                                if(carga_detalle['valor'][pasadas]==null){
                                                    carga_detalle['valor'][pasadas]=0;
                                                }
                                                peso_neto = peso_neto + carga_detalle['netos'][j]*1;
                                                peso_bruto = peso_bruto + carga_detalle['brutos'][j]*1;

                                                $("#Table tbody").append(
                                                    "<tr><td >"+_.findWhere(formatos, {id: parseInt(carga_detalle['formato'][j])}).nombre+" "+_.findWhere(calibres, {id: parseInt(carga_detalle['C'][pasadas])}).nombre+"<input name='formatos[]' value='"+carga_detalle['formato'][j]+"' type='hidden'></td>"+
                                                    "<td >"+carga_detalle['CXC'][pasadas]+"</td>"+
                                                    "<td >"+"<input name='valor[]' class='valor_ingresado' type='text' placeholder="
                                                    +carga_detalle['valor'][pasadas]+">"+"</td>"+
                                                    "<td name='totaltr[]'></td></tr>");
                                                $(".valor_ingresado").on("keyup", actualizar);
                                                pasadas++;
                                            }  
                                            } 
                                        }
                                        $("#Table tbody").append("<tr><td ></td><td ></td><td >Subtotal</td><td id='subtotal'><input name='subtotal' class='valor_ingresado' type='hidden'></td></tr>"+
                                                "<tr><td ></td><td ></td><td >Descuento </td><td id='descuento'><input name='descuento[]' placeholder='"+value['descuento']+"'  onkeyup='actualizartotal()' type='text'></td></tr>"+
                                                "<tr><td ></td><td ></td><td >Total</td><td id='total'><input name='total' class='valor_ingresado' type='hidden'></td></tr>"); 

                                    }
                                    //ignorar este if
                                    if(peso_bruto==0){
                                        var carga_detalle = JSON.parse(value['detalle_carga']);
                                        alert('no tiene packing list asociado');
                                        peso_bruto = carga_detalle['brutos'].reduce(function(a, b) { return a*1 + b*1; }, 0);
                                        peso_neto = carga_detalle['netos'].reduce(function(a, b) { return a*1 + b*1; }, 0);
                                        
                                        //$('#enviar1').hide();
                                    }
                                    else{
                                        $('#enviar1').show();
                                    }
                                    if( value['consignatario']==null){
                                        consignatario = 'no ingresado';
                                    }
                                    else{
                                        consignatario = value['consignatario']['nombre'];
                                    }
                                    if( value['modalidad_venta']==null){
                                        modalidad_venta = 'no ingresado';
                                    }
                                    else{
                                        modalidad_venta = value['modalidad_venta'];
                                    }
                                    if( value['modalidad_flete']==null){
                                        modalidad_flete = 'no ingresado';
                                    }
                                    else{
                                        modalidad_flete = value['modalidad_flete'];
                                    }
                                    if( value['clausula_venta']==null){
                                        clausula_venta = 'no ingresado';
                                    }
                                    else{
                                        clausula_venta = value['clausula_venta'];
                                    }
                                    
                                    detalles.value = 'Embarque N°: '+embarque+' \nModalidad de venta: '+modalidad_venta
        +' \nClausula de venta '+clausula_venta+' \nFlete: '+modalidad_flete+' \nConsignatario: '
        +consignatario+"\nPeso bruto del embarque: "+peso_bruto+" KG\n"
                                        +"Peso neto del embarque: "+peso_neto+" KG";
                         
                                    }); 

                                   function actualizar(){

                                    var par = $(this).parent().parent();
                                    var numero_cajas = par.children("td:nth-child(2)");
                                    var valor = par.children("td:nth-child(3)");
                                    var totaltr = par.children("td:nth-child(4)");
                                    var subtotaltr = valor.children().val()*1 * numero_cajas.html()*1;
                                    totaltr.html(subtotaltr);
                                    var totales =  document.getElementsByName('totaltr[]');
                                    var subtotal = 0;
                                    for (var i = 0; i < totales.length; i++) {
                                        subtotal = subtotal + totales[i].innerHTML*1;
                                    }

                                    $("#subtotal").html(subtotal);

            


                                    actualizartotal();
                                }
                                    function actualizartotal(){


                                    var subtotal = $("#subtotal").html();

                                    var descuento =  document.getElementsByName('descuento[]');
                
                                    var total = subtotal - descuento[0].value*1 ;

                                    if (descuento[0].value==''){
                                        total = subtotal;
                                    }

                                    $("#total").html(total);


                                   }

                                   function soloNumeros(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
var id_formato = [];
var id_variedad = [];
var nombres_formatos = [];
var nombres_variedad = [];
var pesos_brutos = [];
var pesos_netos = [];
var bins_nombre = [];
var bins_peso = [];
var productores_nombre = [];
var productores_id = [];

var variedades = [];
var formatos = [];
var bins = [];
var productores = [];
var bodegas = [];
var calibres = [];

var tarja;
var tarja_embalada = 0;
var tarjainicial;
var direccionTarja;
var direccionBorrarTarja;
var direccionFolio;
var direccionBorrarFolio;


function inicio(a, b, d, e, f,calibre,direccionT,direccionBT,direccionF,direccionBF,direccionM,direccionBM) {
  direccionTarja = direccionT;
  direccionBorrarTarja = direccionBT;
  direccionFolio = direccionF;
  direccionBorrarFolio = direccionBF;
  direccionMaterial = direccionM;
  direccionBorrarMaterial = direccionBM;
  for (var i = 0; i < a.length; i++) {
    nombres_variedad.push(a[i]['variedad']);
    id_variedad.push(a[i]['id']);
    variedades.push({
      id: a[i]['id'],
      nombre: a[i]['variedad']
    });
  }

  for (var i = 0; i < b.length; i++) {
    id_formato.push(b[i]['id']);
    nombres_formatos.push(b[i]['nombre']);
    pesos_netos.push(b[i]['peso_neto']);
    pesos_brutos.push(b[i]['peso_bruto']);
    formatos.push({
      id: b[i]['id'],
      nombre: b[i]['nombre'],
      peso_neto: b[i]['peso_neto'],
      peso_bruto: b[i]['peso_bruto']
    });
  }

  for (var i = 0; i < d.length; i++) {
    bins_nombre.push(d[i]['nombre']);
    bins_peso.push(d[i]['peso_kg']);
    bins.push({
      nombre: d[i]['nombre'],
      peso: d[i]['peso_kg']
    });
  }

  for (var i = 0; i < e.length; i++) {
    productores_nombre.push(e[i]['nombre']);
    productores_id.push(e[i]['id']);
    productores.push({
      id: e[i]['id'],
      nombre: e[i]['nombre'],
      csg: e[i]['csg'],
      csp: e[i]['csp'],
    })
  }
  
  for(i=0; i< f.length; i++){
    bodegas.push({
      id: f[i].id,
      nombre: f[i].nombre
    });
  }

  for(i=0; i< calibre.length; i++){
    calibres.push({
      id: calibre[i].id,
      nombre: calibre[i].nombre
    });
  }

};

var cantidad_tarjas_i = 0;
var cantidad_embaladas_i = 0;
var cantidad_tarjas_f = 0;
var cantidad_embaladas_f = 0;

verificarCamposEnBlanco = function(campos, documento, prefix) {
  var campo, hayCamposEnBlanco, i, len, ref;
  hayCamposEnBlanco = false;
  prefix = prefix||"";
  $('.has-error').each(function(index, element) {
    return $(element).removeClass('has-error');
  });
  for (i = 0, len = campos.length; i < len; i++) {
    campo = campos[i];
    if (!((ref = documento[campo]) != null ? ref.length : void 0) || documento[campo] === "NaN") {
      $(prefix+" [name='" + campo+"']").parent().addClass('has-error');
      hayCamposEnBlanco = true;
    }
  }
  return hayCamposEnBlanco;
};

function soloNumeros(evt) {
  $(this).val(parseFloat($(this).val().replace(",",".")));
}

$(function() {
  //Add, Save, Edit and Delete functions code
  $("#btn_granel").bind("click", Add_granel);
  $("#btn_embalado").bind("click", Add_embalado);
  $("#btn_material").bind("click", Add_material);
  $(".update_neto").change(function(){
    num = parseFloat($(this).val().replace(",","."));
    if(isNaN(num)){
      num = 0;
    }
    $(this).val(num);
  });
  
  $("#guardar_granel_imprimir").click(function(e){
    _tarja = guardar_granel(e);
    if(_tarja){
      imprimir_tarja_granel(_tarja);
    }
  });
  $("#guardar_granel").click(guardar_granel);
  
  function guardar_granel(e){
    granel = {
      variedad:        $("#modal_fruta_granel [name='variedad']").val(),
      cuartel:         $("#modal_fruta_granel [name='cuartel']").val(),
      kilos_brutos:    $("#modal_fruta_granel [name='kilos_brutos']").val(),
      kilos_netos:     $("#modal_fruta_granel [name='kilos_netos']").val().replace(/\./g, "").replace(",","."),
      peso_pallet:     $("#modal_fruta_granel [name='peso_pallet']").val(),
      numero_bandejas: $("#modal_fruta_granel [name='numero_bandejas']").val(),
      bins:            $("#modal_fruta_granel [name='bins']").val()
    };
    
    if(parseFloat(granel.kilos_netos) < 0){
      swal("Kilos netos negativos", "Por favor revisa que los kilos netos no sean negativos.", "error");
      return false;
    }
    
    if(verificarCamposEnBlanco(_.keys(granel), granel, "#modal_fruta_granel")){
      swal("Faltan Campos", "Por favor completa los campos en rojo para continuar.", "error");
      return false;
    }

    granel.id_guia =       $("#id_guia").val();
    granel.id_bodega=       $("#bodega").val();
    
    tarja_row = function(n_tarja){

      return "<tr>"+
      " <td name='tablas[]'>" + n_tarja + "<input name='Tarjas[]' value="+n_tarja+" type='hidden'/></td>"+
      " <td>"+_.findWhere(variedades, {id: parseInt(granel.variedad)}).nombre + "<input name='Variedad_granel[]' type='hidden' value='" + granel.variedad + "'></td>"+
      " <td>"+granel.cuartel + "<input name='Cuartel_granel[]' type='hidden' value='" + granel.cuartel + "'></td>"+
      " <td>"+granel.kilos_brutos + "<input name='KilosB[]' type='hidden' value='" + granel.kilos_brutos + "'></td>"+
      " <td>"+granel.kilos_netos + "<input name='KilosN[]' type='hidden' value='" + granel.kilos_netos + "'></td>"+
      " <td>"+granel.peso_pallet + "<input name='PesoP[]' type='hidden' value='" + granel.peso_pallet + "'></td>"+
      " <td>"+granel.numero_bandejas + "<input name='NBins[]' type='hidden' value='" + granel.numero_bandejas + "'></td>"+
      " <td>"+granel.bins+ "<input name='bins_nombre[]' type='hidden' value='" + granel.bins + "'></td>"+
          " <td><span class='btnEdit_granel' role='button'><i class='fa fa-lg fa-pencil' ></i></span> <span class='btnPrint_granel' role='button'><i class='fa fa-lg fa-print' ></i></span> <span class='btnDelete_granel' role='button'><i class='fa fa-lg fa-times'></i></span></td>"+
    "</tr>";
    };
    
    _tarja = $("#numero_tarja").html();
    if(_tarja=="") _tarja=0;
    editar = false;
    granel.tarja = _tarja;
    if($("[name='Tarjas[]'][value="+_tarja+"]").length){
      // estamos editando
      editar = true;
      $.ajax({

        type:"POST",
        url:direccionTarja,
        data:granel,
        dataType: 'json',
        success: function(data){
          $("[name='Tarjas[]'][value="+_tarja+"]").parent().parent().replaceWith(tarja_row(_tarja));
          text();
          $('#modal_fruta_granel').modal('hide');
          $(".btnDelete_granel").bind("click", Delete_granel);
          $(".btnEdit_granel").bind("click", Edit_granel);
          $(".btnPrint_granel").bind("click", imprimir_tarja_granel);
          if(!editar){
            // si no editamos, devolvemos la tarja para imprimirla
            tarja_temporal = {
              numero_tarja: _tarja,
              kilos_brutos:  granel.kilos_brutos,
              kilos_netos:   granel.kilos_netos,
              bins:         granel.numero_bandejas,
              variedad:     _.findWhere(variedades, {id: parseInt(granel.variedad)}).nombre
            };
            return tarja_temporal;
          }
        },
        error: function(data){

        }

      });

    } else {
      // estamos ingresando uno nuevo
      $.ajax({
        type:"POST",
        url:direccionTarja,
        data:granel,
          dataType: 'json',
          success: function(data){
            $("#Table_granel tbody").append(tarja_row(data));
            text();
            $('#modal_fruta_granel').modal('hide');
            $(".btnDelete_granel").bind("click", Delete_granel);
            $(".btnEdit_granel").bind("click", Edit_granel);
            $(".btnPrint_granel").bind("click", imprimir_tarja_granel);
            if(!editar){
              // si no editamos, devolvemos la tarja para imprimirla
              tarja_temporal = {
                numero_tarja: _tarja,
                kilos_brutos:  granel.kilos_brutos,
                kilos_netos:   granel.kilos_netos,
                bins:         granel.numero_bandejas,
                cuartel: granel.cuartel,
                variedad:     _.findWhere(variedades, {id: parseInt(granel.variedad)}).nombre
              };
              return tarja_temporal;
            }
      },
      error: function(data){
            alert('error');
      }
    });


    }

  };

  $("#guardar_embalado_imprimir").click(function(e){
    folio = guardar_embalado(e);
    if(folio){
      imprimir_embalado(folio);
    }
  });
  $("#guardar_embalado").click(guardar_embalado);
  
  function guardar_embalado(e){
    embalado = {
      id_guia:        $("#id_guia").val(),
      productor_original: document.getElementsByName("proveedor")[0].value,
      embalado:        $("#modal_fruta_embalada [name='embalado']").val(),
      packing:        $("#modal_fruta_embalada [name='packing']").val(),
      productor:         $("#modal_fruta_embalada [name='productor']").val(),
      folio:    $("#modal_fruta_embalada [name='folio']").val(),
      fecha:    $("#modal_fruta_embalada [name='fecha_f']").val(),
      variedad:     $("#modal_fruta_embalada [name='variedad']").val().replace(/\./g, "").replace(",","."),
      calibre:     $("#modal_fruta_embalada [name='calibre']").val(),
      cuartel:     $("#modal_fruta_embalada [name='cuartel']").val(),
      formato: $("#modal_fruta_embalada [name='formato']").val(),
      dh:            $("#modal_fruta_embalada [name='dh']").val(),
      cajas:          $("#modal_fruta_embalada [name='cajas']").val(),
    };

    
    console.log(embalado);
    if(verificarCamposEnBlanco(_.keys(embalado), embalado, "#modal_fruta_embalada")){
      swal("Faltan Campos", "Por favor completa los campos en rojo para continuar.", "error");
      return false;
    }
    
    embalado_row = function(n_folio){
      return "<tr>"+
      " <td >" + _.findWhere(productores, {id: parseInt(embalado.packing)}).nombre + "<input name='embalado[]' value="+n_folio+" type='hidden'/>" + "<input name='Packing[]' value="+embalado.packing+" type='hidden'/></td>"+
      " <td >" + _.findWhere(productores, {id: parseInt(embalado.productor)}).nombre + "<input name='Productor[]' value="+embalado.productor+" type='hidden'/></td>"+
      " <td>"+embalado.folio + "<input name='Folios[]' type='hidden' value='" + embalado.folio + "'></td>"+
      " <td>"+embalado.fecha + "<input name='Fechas[]' type='hidden' value='" + embalado.fecha + "'></td>"+
      " <td>"+_.findWhere(variedades, {id: parseInt(embalado.variedad)}).nombre + "<input name='Variedad_embalado[]' type='hidden' value='" + embalado.variedad + "'></td>"+
      " <td>"+_.findWhere(calibres, {id: parseInt(embalado.calibre)}).nombre + "<input name='Calibre[]' type='hidden' value='" + embalado.calibre + "'></td>"+
      " <td>"+embalado.cuartel + "<input name='Cuartel_embalado[]' type='hidden' value='" + embalado.cuartel + "'></td>"+
      " <td>"+_.findWhere(formatos, {id: parseInt(embalado.formato)}).nombre + "<input name='Formato[]' type='hidden' value='" + embalado.formato + "'></td>"+
      " <td>"+embalado.dh + "<input name='DH[]' type='hidden' value='" + embalado.dh + "'></td>"+
      " <td>"+embalado.cajas + "<input name='Cajas[]' type='hidden' value='" + embalado.cajas + "'></td>"+
      " <td><span class='btnEdit_embalado' role='button'><i class='fa fa-lg fa-pencil' ></i></span> <span class='btnPrint_embalado' role='button'><i class='fa fa-lg fa-print' ></i></span> <span class='btnDelete_embalado' role='button'><i class='fa fa-lg fa-times'></i></span></td>"+
    "</tr>";
    };
    
    editar = false;
    if($("[name='embalado[]'][value="+embalado.embalado+"]").length){
      // estamos editando
      editar = true;
      $.ajax({
        type:"POST",
        url:direccionFolio,
        data:embalado,
        dataType: 'json',
        success: function(data){
          $("[name='embalado[]'][value="+embalado.embalado+"]").parent().parent().replaceWith(embalado_row(embalado.embalado));
          $('#modal_fruta_embalada').modal('hide');
          $(".btnDelete_embalado").bind("click", Delete_embalado);
          $(".btnEdit_embalado").bind("click", Edit_embalado);
          $(".btnPrint_embalado").bind("click", imprimir_embalado);
          text();


          if(!editar){
            folio_temporal = {
              numero:  embalado.folio,
              variedad: _.findWhere(variedades, {id: parseInt(embalado.variedad)}).nombre,
              csg: _.findWhere(productores, {id: parseInt(embalado.productor)}).csg,
              csp: _.findWhere(productores, {id: parseInt(embalado.productor)}).csp,
              formato: _.findWhere(formatos, {id: parseInt(embalado.formato)}).nombre,
              calibre: _.findWhere(calibres, {id: parseInt(embalado.calibre)}).nombre,
              fecha: embalado.fecha,
              cuartel: embalado.cuartel,
              cajas: embalado.cajas
            };
            return folio_temporal;
          }
        },
        error: function(data){
          swal("No se pudo Editar", "Folio "+embalado.folio+" ya existe", "error");
        }
      });


    } else {
      // estamos ingresando uno nuevo
      $.ajax({
        type:"POST",
        url:direccionFolio,
        data:embalado,
        dataType: 'json',
        success: function(data){
          $("#Table_embalado tbody").append(embalado_row(data));
          $('#modal_fruta_embalada').modal('hide');
          $(".btnDelete_embalado").bind("click", Delete_embalado);
          $(".btnEdit_embalado").bind("click", Edit_embalado);
          $(".btnPrint_embalado").bind("click", imprimir_embalado);
          text();


          if(!editar){
            folio_temporal = {
              numero:  embalado.folio,
              variedad: _.findWhere(variedades, {id: parseInt(embalado.variedad)}).nombre,
              csg: _.findWhere(productores, {id: parseInt(embalado.productor)}).csg,
              csp: _.findWhere(productores, {id: parseInt(embalado.productor)}).csp,
              nombre_productor: _.findWhere(productores, {id: parseInt(embalado.productor)}).nombre,
              formato: _.findWhere(formatos, {id: parseInt(embalado.formato)}).nombre,
              calibre: _.findWhere(calibres, {id: parseInt(embalado.calibre)}).nombre,
              fecha: embalado.fecha,
              cuartel: embalado.cuartel,
              cajas: embalado.cajas
            };
            return folio_temporal;
          }
        },
        error: function(data){
          swal("No se pudo guardar", "Folio "+embalado.folio+" ya existe", "error");
        }
      });

      tarja_embalada++;
    }

    


  };

    $("#guardar_material").click(guardar_material);

    function guardar_material(e){
        material = {
            detalle:        $("#modal_material [name='detalle']").val(),
            material:        $("#modal_material [name='material']").val(),
            nombre_material:        $("#modal_material [name='material'] option:selected").html(),
            unidad:        $("#modal_material [name='unidad']").val(),
            nombre_unidad:        $("#modal_material [name='unidad'] option:selected").html(),
            cantidad:         $("#modal_material [name='cantidad']").val(),
            lote:         $("#modal_material [name='lote']").val(),
            bodega:    $("#modal_material [name='bodega']").val()
        };

        if(verificarCamposEnBlanco(_.keys(material), material, "#modal_material")){
            swal("Faltan Campos", "Por favor completa los campos en rojo para continuar.", "error");
            return false;
        }

        material.id_guia =       $("#id_guia").val();

        material_row = function(n_material){

            return "<tr>"+
                " <td>" + n_material.unidad.material.nombre + "<input name='Detalle[]' type='hidden' value="+n_material.id+"><input name='nombre_material[]' type='hidden' value="+n_material.unidad.id_material+"></td>"+
                " <td>" + n_material.unidad.nombre + "<input name='nombre_unidad[]' type='hidden' value="+n_material.id_unidad+"></td>"+
                " <td>"+n_material.cantidad + "<input name='cantidad_material[]' type='hidden' value='" + n_material.cantidad + "'></td>"+
                " <td>"+n_material.lote + "<input name='lote[]' type='hidden' value='" + n_material.lote + "'></td>"+
                " <td>"+_.findWhere(bodegas, {id: parseInt(n_material.id_bodega_destino)}).nombre+ "<input name='bodega_material[]' type='hidden' value='"+n_material.id_bodega_destino+"'></td>"+
                " <td><span class='btnEdit_material' role='button'><i class='fa fa-lg fa-pencil' ></i></span> <span class='btnDelete_material' role='button'><i class='fa fa-lg fa-times'></i></span></td>"+
                "</tr>";
        };


        if($("[name='Detalle[]'][value="+material.detalle+"]").length){
            // estamos editando
            editar = true;
            $.ajax({

                type:"POST",
                url:direccionMaterial,
                data:material,
                dataType: 'json',
                success: function(data){
                    $("[name='Detalle[]'][value="+data.id+"]").parent().parent().replaceWith(material_row(data));
                    text();
                    $('#modal_material').modal('hide');
                    $(".btnDelete_material").bind("click", Delete_material);
                    $(".btnEdit_material").bind("click", Edit_material);

                },
                error: function(data){

                }

            });

        } else {
            // estamos ingresando uno nuevo
            $.ajax({
                type:"POST",
                url:direccionMaterial,
                data:material,
                dataType: 'json',
                success: function(data){
                    $("#Table_material tbody").append(material_row(data));
                    text();
                    $('#modal_material').modal('hide');
                    $(".btnDelete_material").bind("click", Delete_material);
                    $(".btnEdit_material").bind("click", Edit_material);
                },
                error: function(data){
                    alert('error');
                }
            });
        }
    };

});

function setproveedor(selected,modo) {
  selected = selected - 1;
  var productor = "<select class='select2 form-control input-sm' name='"+modo+"'><option value=''>Seleccione</option>";
  for (var i = 0; i < productores_nombre.length; i++) {
    if (i == selected)
      productor = productor + "<option value='" + productores_id[i] + "' selected>" + productores_nombre[i] + "</option>";
    else {
      productor = productor + "<option value='" + productores_id[i] + "'>" + productores_nombre[i] + "</option>";
    }
  }
  return productor + "</select>";
}

function setvariedad(selected) {

  selected = selected - 1;
  var variedad = "<select class='select2 form-control input-sm' name='variedad'><option value=''>Selecciona una variedad</option>";
  for (var i = 0; i < nombres_variedad.length; i++) {
    if (i == selected)
      variedad = variedad + "<option value='" + id_variedad[i] + "' selected>" + nombres_variedad[i] + "</option>";
    else {
      variedad = variedad + "<option value='" + id_variedad[i] + "'>" + nombres_variedad[i] + "</option>";
    }
  }
  return variedad + "</select>";
}



function setvariedadembalado(selected) {

  selected = selected - 1;
  var variedad = "<select class='select2' name='Variedad_embalado_i[]'>";
  for (var i = 0; i < nombres_variedad.length; i++) {
    if (i == selected)
      variedad = variedad + "<option value='" + id_variedad[i] + "' selected>" + nombres_variedad[i] + "</option>";
    else {
      variedad = variedad + "<option value='" + id_variedad[i] + "'>" + nombres_variedad[i] + "</option>";
    }
  }
  return variedad + "</select>";
}

function setcalibre(selected) {

  selected = selected - 1;
  var variedad = "<select class='select2 form-control input-sm' name='calibre'><option value=''>Selecciona un Calibre</option>";
  for (var i = 0; i < calibres.length; i++) {
    if (i == selected)
      variedad = variedad + "<option value='" + calibres[i].id + "' selected>" + calibres[i].nombre + "</option>";
    else {
      variedad = variedad + "<option value='" + calibres[i].id + "'>" + calibres[i].nombre + "</option>";
    }
  }
  return variedad + "</select>";
}

function setbins(selected) {

  var nombre = "<select class='select2 form-control input-sm on_change_update_neto' name='bins'><option value=''>Selecciona una bandeja</option>";
  for (var i = 0; i < bins_nombre.length; i++) {
    if (bins_nombre[i] == selected)
      nombre = nombre + "<option value='" + bins_nombre[i] + "' selected>" + bins_nombre[i] + "</option>";
    else {
      nombre = nombre + "<option value='" + bins_nombre[i] + "'>" + bins_nombre[i] + "</option>";
    }
  }
  return nombre + "</select>";
}

function setformato(selected) {
  selected = selected - 1;
  var formato = "<select class='select2 form-control input-sm' name='formato'><option value=''>Selecciona un Formato</option>";
  for (var i = 0; i < nombres_formatos.length; i++) {
    if (i == selected)
      formato = formato + "<option value='" + id_formato[i] + "' selected>" + nombres_formatos[i] + "</option>";
    else {
      formato = formato + "<option value='" + id_formato[i] + "'>" + nombres_formatos[i] + "</option>";
    }
  }
  return formato + "</select>";
}

function text() {

  var detalles = document.getElementById("detalles");
  var KilosNetos = document.getElementsByName("KilosN[]");
  var KilosBrutos = document.getElementsByName("KilosB[]");
  var Bins = document.getElementsByName("NBins[]");
  var KB = 0;
  var KN = 0;
  var B = 0;

  var Formato = document.getElementsByName("Formato[]");
  var Cajas = document.getElementsByName("Cajas[]");

  var i;
  for (i = 0; i < KilosNetos.length; i++) {
    KN = KN + KilosNetos[i].value * 1;
  }

  for (i = 0; i < KilosBrutos.length; i++) {
    KB = KB + KilosBrutos[i].value * 1;
  }
  if (!(Cajas.length == 0)) {
    for (i = 0; i < Formato.length; i++) {
      KN = KN + pesos_netos[Formato[i].value - 1] * 1 * Cajas[i].value;
    }

    for (i = 0; i < Formato.length; i++) {
      KB = KB + pesos_brutos[Formato[i].value - 1] * 1 * Cajas[i].value;
    }
  }

  for (i = 0; i < Bins.length; i++) {
    B = B + Bins[i].value * 1;
  }

  var string = 'Kilos Brutos: ' + KB + ' Kg\nKilos Netos Estimados: ' + KN + ' Kg\nBins: ' + B;
  detalles.value = string;

}

function update_kilos_netos() {
  kilos_brutos = $("#modal_fruta_granel [name='kilos_brutos']").val() || 0;
  peso_pallet = $("#modal_fruta_granel [name='peso_pallet']").val() || 0;
  if($("#modal_fruta_granel [name='bins']").val()){
    peso_bins = _.findWhere(bins,{nombre: $("#modal_fruta_granel [name='bins']").val()}).peso; 
  } else {
    peso_bins = 0;
  }
  numero_bins = $("#modal_fruta_granel [name='numero_bandejas']").val() || 0;
  kilo_neto = kilos_brutos*1 - peso_pallet*1 - peso_bins * numero_bins;
  kilo_neto = number_format(kilo_neto, 2);
  $("#modal_fruta_granel [name='kilos_netos']").val(kilo_neto);
}

function Add_granel() {
  $("#numero_tarja").html("");
  $("#modal_fruta_granel form")[0].reset();
  $("#modal_fruta_granel .modal-title").html("Ingresar fruta a granel");
  $("#modal_fruta_granel #numero_tarja").html(tarja);
  $("#modal_fruta_granel #variedad_container").html(setvariedad());
  $("#modal_fruta_granel #bins_container").html(setbins());
  
  $("#guardar_granel").html("Guardar sin imprimir");
  $("#guardar_granel_imprimir").show();
  
  $(".update_neto").keyup(update_kilos_netos);
  $(".on_change_update_neto").change(update_kilos_netos);

  $("select").select2();

  return true;
};


function Edit_granel() {
  var par       = $(this).parent().parent(); //tr
  var Folio     = par.find("td [name='Tarjas[]']");
  var Variedad  = par.find("td [name='Variedad_granel[]']");
  var Cuartel   = par.find("td [name='Cuartel_granel[]']");
  var KilosB    = par.find("td [name='KilosB[]']");
  var KilosN    = par.find("td [name='KilosN[]']");
  var PesoP     = par.find("td [name='PesoP[]']");
  var NBins     = par.find("td [name='NBins[]']");
  var TotalBins = par.find("td [name='bins_nombre[]']");




  $("#modal_fruta_granel form")[0].reset();
  $("#modal_fruta_granel .modal-title").html("Editar fruta a granel");
  
  $("#modal_fruta_granel #numero_tarja").html(Folio.val());
  $("#modal_fruta_granel #variedad_container").html(setvariedad(Variedad.val()));
  $("#modal_fruta_granel #bins_container").html(setbins(TotalBins.val()));
  $("#modal_fruta_granel [name='cuartel']").val(Cuartel.val());
  $("#modal_fruta_granel [name='kilos_brutos']").val(KilosB.val());
  $("#modal_fruta_granel [name='kilos_netos']").val(KilosN.val());
  $("#modal_fruta_granel [name='peso_pallet']").val(PesoP.val());
  $("#modal_fruta_granel [name='numero_bandejas']").val(NBins.val());

  $(".update_neto").keyup(update_kilos_netos);
  $(".on_change_update_neto").change(update_kilos_netos);
  //update_kilos_netos();

  $("select").select2();
  $("#guardar_granel").html("Editar");
  $("#guardar_granel_imprimir").hide();
  $('#modal_fruta_granel').modal('show');
  text();
};

function Delete_granel() {
  var par = $(this).parent().parent();
  var id_tarja = par.find("td [name='Tarjas[]']").val();

  swal({
    title: "¿Estas seguro?",
    text: "no podras recuperar esta tarja",
    type: "warning",

    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Si,quiero borrarla",
    closeOnConfirm: false,
    showCancelButton: true,
    html: false

  }).then( function(){

    $.ajax({
      type:"POST",
      url:direccionBorrarTarja,
      data:{"id":id_tarja},
      dataType: 'json',
      success: function(data){
        //tr
        par.remove();
        text();
        swal("Borrado", "Tarja Borrada con exito", "success");
      },
      error: function(data){
        swal("Borrado", "Tarja no pudo ser borrada", "error");
      }
    });
  });

};

function Add_material() {

    $("#modal_material form")[0].reset();
    $("#modal_material .modal-title").html("Ingresar material");
    $("#modal_material [name='material']").val("");
    $("#modal_material [name='unidad']").val("");
    $("#modal_material [name='lote']").val("");
    $("#modal_material [name='bodega']").val("");
    $("#modal_material [name='detalle']").val(0);
    $("select").select2();
    return true;
};


function Edit_material() {
    var par       = $(this).parent().parent(); //tr
    var detalle  = par.find("td [name='Detalle[]']");
    var material  = par.find("td [name='nombre_material[]']");
    var unidad  = par.find("td [name='nombre_unidad[]']");
    var cantidad  = par.find("td [name='cantidad_material[]']");
    var lote  = par.find("td [name='lote[]']");
    var bodega    = par.find("td [name='bodega_material[]']");

    $("#modal_material form")[0].reset();
    $("#modal_material .modal-title").html("Editar detalle");
    $("#modal_material [name='detalle']").val(detalle.val());
    $("#modal_material [name='material'] ").val(material.val());
    $("#modal_material [name='material'] ").trigger('change');
    $("#modal_material [name='unidad'] ").val(unidad.val());
    $("#modal_material [name='cantidad']").val(cantidad.val());
    $("#modal_material [name='lote']").val(lote.val());
    $("#modal_material [name='bodega']").val(bodega.val());

    $("select").select2();
    $('#modal_material').modal('show');
    text();
};

function Delete_material() {
    var par = $(this).parent().parent();
    var id_tarja = par.find("td [name='Detalle[]']").val();

    swal({
        title: "¿Estas seguro?",
        text: "no podras recuperar esta tarja",
        type: "warning",

        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si,quiero borrarla",
        closeOnConfirm: false,
        showCancelButton: true,
        html: false

    }).then( function(){

        $.ajax({
            type:"POST",
            url:direccionBorrarMaterial,
            data:{"id":id_tarja},
            dataType: 'json',
            success: function(data){
                //tr
                par.remove();
                text();
                swal("Borrado", "Tarja Borrada con exito", "success");
            },
            error: function(data){
                swal("Borrado", "Tarja no pudo ser borrada", "error");
            }
        });
    });

};


function Add_embalado() {
  cantidad_embaladas_i++;
  var productor_seleccionado = document.getElementsByName("proveedor")[0];

  $("#modal_fruta_embalada form")[0].reset();
  $("#modal_fruta_embalada .modal-title").html("Ingresar fruta embalada");
  $("#modal_fruta_embalada [name='embalado']").val(0);
  
  $("#modal_fruta_embalada #packing_container").html(setproveedor(productor_seleccionado.value,'packing'));
  $("#modal_fruta_embalada #productor_container").html(setproveedor(productor_seleccionado.value,'productor'));
  $("#modal_fruta_embalada #variedad_container").html(setvariedad(0));
  $("#modal_fruta_embalada #calibre_container").html(setcalibre(0));
  $("#modal_fruta_embalada #formato_container").html(setformato(0));
  $("#guardar_embalado").html("Guardar");

  $("select").select2();

  return true;

};



function Edit_embalado() {

  var par = $(this).parent().parent(); //tr
  var embalado = par.find("td [name='embalado[]']");
  var Packing = par.find("td [name='Packing[]']");
  var Productor = par.find("td [name='Productor[]']");
  var Folio     = par.find("td [name='Folios[]']");
  var Fecha     = par.find("td [name='Fechas[]']");
  var Variedad  = par.find("td [name='Variedad_embalado[]']");
  var Cuartel   = par.find("td [name='Cuartel_embalado[]']");
  var Formato    = par.find("td [name='Formato[]']");
  var DH    = par.find("td [name='DH[]']");
  var Cajas     = par.find("td [name='Cajas[]']");
  var Calibre   = par.find("td [name='Calibre[]']");

  $("#modal_fruta_embalada form")[0].reset();
  $("#modal_fruta_embalada .modal-title").html("Editar fruta embalada");
  $("#modal_fruta_embalada #packing_container").html(setproveedor(Packing.val(),'packing'));
  $("#modal_fruta_embalada #productor_container").html(setproveedor(Productor.val(),'productor'));
  $("#modal_fruta_embalada [name='folio']").val((Folio.val()));
  $("#modal_fruta_embalada [name='embalado']").val((embalado.val()));
  $("#modal_fruta_embalada [name='fecha_f']").val((Fecha.val()));
  $("#modal_fruta_embalada #variedad_container").html(setvariedad(Variedad.val()));
  $("#modal_fruta_embalada #formato_container").html(setformato(Formato.val()));
  $("#modal_fruta_embalada [name='cuartel']").val(Cuartel.val());
  $("#modal_fruta_embalada [name='dh']").val(DH.val());
  $("#modal_fruta_embalada [name='cajas']").val(Cajas.val());
 // $("#modal_fruta_embalada [name='calibre']").val(Calibre.val());
  $("#modal_fruta_embalada #calibre_container").html(setcalibre(Calibre.val()));
  

  $("select").select2();
  $("#guardar_embalado").html("Editar");
  $("#guardar_embalado_imprimir").hide();
  $('#modal_fruta_embalada').modal('show');
  text();
};


function Delete_embalado() {
  var par = $(this).parent().parent(); //tr
  var id_folio = par.find("td [name='embalado[]']").val();
  swal({
    title: "¿Estas seguro?",
    text: "no podras recuperar este folio",
    type: "warning",

    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Si,quiero borrarla",
    closeOnConfirm: false,
    showCancelButton: true,
    html: false

  }).then( function(){
    $.ajax({
      type:"POST",
      url:direccionBorrarFolio,
      data:{"id":id_folio},
      dataType: 'json',
      success: function(data){
        //tr
        par.remove();
        text();
        swal("Borrado", "Folio con exito", "success");
      },
      error: function(data){
        swal("Borrado", "Folio no pudo ser borrado", "error");
      }
    });
  });
};

function number_format(number, decimals, decPoint, thousandsSep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
  var n = !isFinite(+number) ? 0 : +number
  var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
  var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep
  var dec = (typeof decPoint === 'undefined') ? ',' : decPoint
  var s = ''

  var toFixedFix = function(n, prec) {
    var k = Math.pow(10, prec)
    return '' + (Math.round(n * k) / k)
      .toFixed(prec)
  }

  // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || ''
    s[1] += new Array(prec - s[1].length + 1).join('0')
  }

  return s.join(dec)
}
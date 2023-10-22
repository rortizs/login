/*
*REVISAR SI EL USUARIO YA ESTA REGISTRADO
*/
$("#usuario").change(function(){
  $(".alert").remove();

  var usuario = $(this).val()
  var datos = new FormData();
  datos.append("validarUsuario", usuario);

  $.ajax({
    url:"ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){
      if(respuesta){
        $("#usuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');
        $("#usuario").val("");
      }
    }
  })
})
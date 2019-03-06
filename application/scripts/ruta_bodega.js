
   function myFunction(idButton) {
      var bodegas = document.getElementById('bodegas');
      var registrar_bodega = document.getElementById('registrar_bodega');
      var editar_bodega = document.getElementById('editar_bodega');
      
      switch(idButton) {
       case 1:
       bodegas.style.display = 'block';
       registrar_bodega.style.display = 'none';
       editar_bodega.style.display = 'none';      
       break;

       case 2:
       bodegas.style.display = 'none';
       registrar_bodega.style.display = 'block';
       editar_bodega.style.display = 'none';      
       break;

       case 3:
       bodegas.style.display = 'none';
       registrar_bodega.style.display = 'none';
       editar_bodega.style.display = 'block';
       
       break;

       default:
       alert("hay un problema: No existe la Ruta.")
   }

}


   function myFunction(idButton) {
      var productos = document.getElementById('productos');
      var registrar_producto = document.getElementById('registrar_producto');
      var editar_producto = document.getElementById('editar_producto');
      
      switch(idButton) {
       case 1:
       productos.style.display = 'block';
       registrar_producto.style.display = 'none';
       editar_producto.style.display = 'none';      
       break;

       case 2:
       productos.style.display = 'none';
       registrar_producto.style.display = 'block';
       editar_producto.style.display = 'none';      
       break;

       case 3:
       productos.style.display = 'none';
       registrar_producto.style.display = 'none';
       editar_producto.style.display = 'block';
       
       break;

       default:
       alert("hay un problema: No existe la Ruta.")
   }

}

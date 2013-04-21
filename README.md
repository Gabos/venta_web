Gestor de pedidos para la Empresa TD-Informática
=========
Una tienda solicita una pagina web interactiva con el usuario, donde este pueda comprar productos desde la pagina siempre y
cuando esten disponibles. En el momento que usuario haga una compra de un producto se le generará una factura,
la cual el encargado de ventas la aprobara. 
Se lleva un control de usuarios con diferentes permisos entre ello
(utilizando consultas en mysql), para ello se tiene un login y register
Cada tipo de usuario tiene un rol diferente y tendra opciones o acceso a paginas diferentes segun su tipo de usuario.

##Intervienen diferentes usuario:
* Visitante (no es asignado el tipo, si no hay sesion se sabe que es un visitante: isset)
* Cliente ( tipo = 1 )
* Encargado de ventas ( tipo = 2 )
* Encargado de inventario ( tipo = 3 )
* cada uno de ellos tiene un estado: 1 --> activo , 0 --> inactivo ( no puede iniciar sesion )


###Cliente
<ol>
<li>
Aspectos como Usuario
    <ul>
      <li>
        Modificar: Solo podra modificar su propia informacion, dara error al querer modificar el de algun otro.
      </li>
      <li>
        Consultar: Solo podra consultarse a si mismo de otra forma dara error
      </li>
      <li>
        Insertar: No podra crear nuevos usuarios desde su cuenta
      </li>
       <li>
        Listar Todo: No podra realizarlo, para hacer una consulta solo puede realizar la del punto anterior.
      </li>
    </ul>
</li>
<li>Realizar compra: Con el catalogo de productos el cliente podra seleccionar el  o los productos que desee agregar 
  al carro de compras, una ves terminado tendra que confirmar el pedido llenando los datos necesarios (direccion, telefono 
  metodo de pago, y paqueteria para el envio). Una vez confirmado no se podra cancelar el pedido.
    <ul>
      <li>Ver el estatus de su compra, de igual forma solo puede checar sus compras</li>
      <li>Que compras ha realizado(solo las de el)</li>
      <li>No tiene autorizacion para cancelar su compra, una vez generada</li>
      <li>De ninguna forma puede listar todas las compras de los demas usuarios</li>
    </ul>
</li>
<li>
Productos
    <ul>
      <li>
        Modificar: No tiene control sobre esta opcion
      </li>
      <li>
        Consultar: Puede consultar cualquier producto
      </li>
      <li>
        Insertar: No tiene control sobre esta opcion
      </li>
       <li>
        Listar Todo: No existe restriccion
      </li>
    </ul>
</li>
<li>
Facturas propias
    <ul>
      <li>
        Modificar: solo se podra modificar las facturas propias.
      </li>
      <li>
        Consultar: Puede consultar facturas propias
      </li>
      <li>
        Insertar: No tiene control sobre esta opcion
      </li>
       <li>
        Listar Todo: No tiene control sobre esta opcion.
      </li>
    </ul>
</li>
</ol>

###Encargado del inventario
* Puede consultar cantidad de producto consultar estado de producto(espera, disponible, agotado, descontinuado),
* podra modificar campos como la cantidad de productos, el cual permitira modificar fallas en existencias.

###Encargado de ventas
* Es el encargado de monitorear las compras que realiza el cliente y asegurarse de que hayan hecho correctamente,  
* Consulta de productos
* Consulta de clientes que han realizado pedido y expedirles factura
 
###Visitante
* Solo puede navegar por el sitio y ver los productos

##Lenguajes contemplados:
* HTML5
* PHP
* MySQL


##Desarrolladores
* Duarte Sánchez Alejandro
   * Codigo: 206587844
   * Email: lexds_1591@hotmail.com  
* Ortiz Valdovinos Gabriel
   * Codigo: 210224446
   * Email: gabrielortiz_26@hotmail.com

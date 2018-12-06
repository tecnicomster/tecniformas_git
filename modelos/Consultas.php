//*1 EN EL DISEÑO* CONSULTA LISTAR PRODUCTOS Y CONFIRMAR EXISTENCIAS AL AGREGAR DETALLES A LA VENTA EN EL MODAL
//En el ajax no mostrar el boton de agragar el producto si disponibles no es >=1

	SELECT p.idlista_precios,p.nombre,p.imagen,p.precio,(SELECT MIN( IF (a.stock>=c.cantidad,a.stock/c.cantidad,0)) as disp FROM componentes c INNER JOIN articulo a ON a.idarticulo=c.idarticulo WHERE c.idlista_precio=p.idlista_precios) as disponibles FROM lista_precios p GROUP BY nombre


//*3 EN EL DISEÑO* RESTAR STOCK DE ARTICULOS SEGUN LOS PRODUCTOS VENDIDOS


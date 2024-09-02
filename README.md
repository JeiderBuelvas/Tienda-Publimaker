Sistema Tienda Online


Avance :
- Se consume la primera API que el cliente mando, como no hay paginacion y trae todo de una sola vez. La carga es lenta y se implemento que consuma la api y lo guarde en dentro del sistema y cuando haga una nueva petición consuma la copia que se hizo. Y esa copia se actualiza cada 12 horas.
- Se hace un filtro de ese archivo que se crea al al hacer la petición a la API y se se obtiene las categorías y subcategorias. En la vista principal. ( ya que no dieron una api de las categorías o subcategorias)
- De ese mismo archivo se cargan los productos, y se le hizo paginacion. 
- Los detalles del producto ya esta echo ( usa ese mismo archivo que se creo al hacer la petición a la API). Falta crearle la vista. Los datos ya trae al hacer click sobre el producto. 

REQUIERE IMPLEMENTAR


- LA VISTA DONDE EL CLIENTE PUEDE REGISTRARSE.
- LA VISTA DONDE EL CLIENTE INICIA SESION Y PUEDE VER SUS PEDIDOS
- UN CARRITO DONDE EL CLIENTE PUEDE AGREGAR SUS PRODUCTOS. (EL CLIENTE SOLO SOLICITARA LOS PRODUCTOS QUE QUIERE COTIZAR, NO SE AGREGARA UNA PASARELA DE PAGO)

- IMPLEMENTAR LA PARTE ADMINISTRATIVA. DONDE EL ENCARGADO DE VER LOS PEDIDOS HAGA LA COTIZACION, ELLOS DEFINIRAN EL.PRECIO ( SERA UN MODULO DE COTIZACION)
- IMPLEMENTAR UN MODULO DE CONFIGURACIÓN DONDE SE PUEDA COLOCAR LOS SLIDERS QUE IRAM EN LA VISTA PRINCIPAL, EL NOMBRE, LOGO, CONTACTO. TODA INFORMACIÓN CON RELACIÓN AL NEGOCIO, AL HACER CAMBIOS AHI, DEBE REFLEJARSE EN LA VISTA PRINCIPAL.
- EL SISTEMA CONSUMIRA OTRAS API. 
- CONCLUSIÓN EL SISTEMA CONSUMIRA ENTRE 1 A 3 APIS Y SE CARGARA ESTOS PRODUCTOS EN LA VISTA PRINCIPAL. EL CLIENTE PODRA AGRRGAR A SU CARRITO DE PEDIDOS LOS PRODUCTOS QUE TENGA A DISPOSICIÓN DE LAS APIS. Y ESTO LE LLEGARA AL ADMINISTRADOR Y PROCEDERA A COTIZAR ( ESA COTIZACION SERA MANUAL, ELLOS DECIDIRAN EL PRECIO). UN IDEA SERIA IMPLEMENTAR UNA TABLA PEDIDOS EN LA BD QUE SE USARA PARA LA COTIZACION. 

- UN MODULO DONDE EL ADMINISTRADOR PUEDA COLOCAR IMAGENES A LAS CATEGORÍAS (ACTUALMENTE LA PRIMERA API NO TRAE IMAGENES DE LAS CATEGORÍAS. 

Demo del avance:
https://sis-demo.wuaze.com/app-tienda


# creacion de un proyecto
* Ir a la carpeta donde queremos crear la carpeta del proyecto
* composer create-project laravel/laravel abril4
* Voy a abrir la carpeta nueva en Visual Studio

## Configurar la base de datos
* Abrir el archivo .env
* Y cambiar las variables que comienzan con DB

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
* Para ocupar Sqlite, se debe cambiar por
DB_CONNECTION=sqlite

## Revisar el archivo de php.ini
* Ir a la carpeta donde se instalo php
* Y editar el archivo php.ini
* Si no esta el archivo renombrar php.ini-development a php.ini

En el archivo php.ini, descomentar las siguientes lineas:
antes:
```
;extension=pdo_sqlite
;extension=sqlite3
```
despues:
```
extension=pdo_sqlite
extension=sqlite3
```

## ejecutar el servidor de Laravel

```shell
php artisan serve
```

## crear un proyecto de ejemplo
Quiero hacer un proyecto para listar productos.

- [X] proyecto Laravel
- [X] crear base de dato, y una tabla
- [X] crear modelo
- [X] crear un controlador
- [X] crear una vista
- [X] crear un enrutador

### crear base de datos
* Abrir Sqlite studio (o el IDE que quiera trabajar)
* Y vamos a crear una nueva conexion.
* crear un archivo nuevo **/database/database.sqlite**

#### crear table
* Usando el IDE, cree una tabla con los siguientes campos
* tabla llamada: productos
* Una columna llamada id: (entero y llave primaria con autoincremento)
* Otrao columna llamada nombre (texto, y con 200 caracteres)
* Guardar la tabla

#### agregar datos a la tabla
* Usando el IDE, agregar datos de ejemplo

### crear el modelo
Usando la linea de comando, ejecutar lo siguiente:

```shell
php artisan make:model Producto
```

### crear un controlador
Usando la linea de comando, ejecutar lo siguiente:

```shell
php artisan make:controller ProductoController
```

### crear una vista
* Las vistas se crean en la carpeta **/resources/views**
* Las vistas no estan programada en PHP. Las vistas ocupan el script llamado "Blade".
* Cuando yo creo una vista, debo crear un archivo con extension **.blade.php**

Cree un archivo en esa carpeta llamado **listar.blade.php**:

```html
hola
```


### crear (modificar) el enrutador web
Editar el archivo routes/web.php
Borre la ruta por defecto y agregue la siguiente ruta:

```php
Route::get("/listar",[ProductoController::class,'listar']);
```

Y agregar el "use" junto a los otro "use" (si es que Visual Studio no lo agrego)

```php
use App\Http\Controllers\ProductoController;
```

Cada vez que se llama a la ruta http://127.0.0.1:8000/listar, se va a llamar al metodo "listar" de la clase ProductoController

### Controlador, agregar metodo
Ir a /app/Http/Controller y editar ProductoController.php agegando el metodo listar

```php
    public function listar() {

    }
```

Probar el codigo de la siguiente manera:
* En la linea de comando, ejecutar otra vez "php artisan serve"
* Y abri la siguiente ruta: http://127.0.0.1:8000/listar


### probar la conexion a la base de datos

En la funcion listar, agregar lo siguiente:
```php
    public function listar() {
        $productos=Producto::all(); // Del modelo, llamo a la funcion all(), Libreria Eloquent.
        dump($productos);
    }
```

### editar la vista
Las vistas estan en la carpeta /resources/views
Esta vista es html+tags(Blade)

Edite su vista listar.blade.php

```html
<ul>
<li>ejemplo 1</li>
<li>ejemplo 2 </li>
</ul>
```

Ejecutar el servidor y ve como se ven los datos.

### unir el controlador con la vista

Modifique el metodo del controlador como sigue:

```php
    public function listar() {
        $productos=Producto::all();
        // dump($productos);
        return view("listar");
    }
```

### modificar la vista para que muestre los datos correctos

Editar el archivo resources/views/listar.blade.php
```html
<ul>
    @foreach($productos as $producto)
    <li>{{$producto}}</li>
    @endforeach
</ul>
```

Si corro el codigo en este paso, me va a indicar que $productos no esta definido. Esto es porque la vista no ha recibido datos.

### modificar el controlador para que le envie datos a la vista

```php
    public function listar() {
        $productos=Producto::all();
        // dump($productos);
        return view("listar",['productos'=>$productos]);
    }
```    
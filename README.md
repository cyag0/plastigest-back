

## Instalacion


### 1. **Clonar el repositorio**
Abre visual estudio y selecciona la opcion de clonar proyecto https://github.com/cyag0/plastigest-app.git

### 2. Instalar dependencias con Composer

```bash
composer install
```

### 3. Copiar el archivo de configuración
abre la terminal del proyect
plastigest-backend> ....

```bash
copy .env.example .env
```

### 4. Configurar la base de datos
Edita el archivo .env para configurar la base de datos:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=plastigest
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generar llave
```bash
php artisan key:generate
```
### 6. Ejecutar migraciones y seeders
```bash
php artisan migrate
```

### 7. Iniciar el servidor de desarrollo
* este comando siempre se debe de usar al trabajar, es como el npm start de reat native
* Siempre tienes que tener iniciado xampp con sus servicios iniciados (apache y mysql)
```bash
php artisan serve
```


## Crud con laravel
Abre la terminal del proyecto

### 1. Crear un modelo, controlador, recurso y migracion
* Tienes que usar la palabra en ingles (Product)
* Tiene que estar en verbo singular (Produduct no Products)
* La primera letra tiene que estar en mayuscula
  
ejemplo de creacion para el modulo de Productos

```bash
php artisan make:model Product -mc --resource
```

Este comando generará:

* Modelo en `app/Models/Product.php`.
* Migración en `database/migrations/{timestamp}_create_products_table.php`.
* Controlador en

Crear resource
```bash
php artisan make:resource ProductResource
```

* Resource en `app/Http/Resources/ProductResource.php`.


### 2. Configuracion del modelo

hay un ejemplo de un modelo configurado en  `app/Models/Product.php`.

*Tienes que declarar la variable $fillable que es igual a un arreglo con el nombre de los campos de la base de datos ejemplo
```bash
    protected $fillable = [
        'name',
        'description',
        'price',
        'supplier_id',
    ];

```
* Probablemente el modulo tenga relaciones las relaciones me dices hablas para que te de una explicacion mejor

### 3. Configuracion del controlador
hay un ejemplo de un modelo configurado en  `App/Http/Controllers/ProductController.php`.

* Hasta arriba tenemos que hacer que la clase extienda de BaseController, este controlador lo hice para que los cruds simples se hagan solos

Codigo por defecto
```bash
<?php

namespace App\Http\Controllers;

use App\Http\Resources\Products\productResource;
use App\Models\Products\Product;
use Illuminate\Http\Request;

class ProductController
```

Lo que tienes que agregar
```bash
<?php

namespace App\Http\Controllers;

use App\Http\Resources\Products\productResource;
use App\Models\Products\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
```

Dentro de esa clase copiamos la configuracion inicial
```bash
 public function __construct()
    {
        parent::__construct(NombreIngles::class, NombreResource::class);
    }

    protected function indexRelations(): array
    {
        return [];
    }

    protected function showRelations(): array
    {
        return [];
    }

    protected function editRelations(): array
    {
        return [];
    }

    protected function storeValidationRules(Request $request): array
    {
        return $request->validate([

        ]);
    }

    protected function updateValidationRules(Request $request): array
    {
        return $this->storeValidationRules($request);
    }
```

### 4. Configurar el archivo Resource creado (IMPORTANTE)
hay un ejemplo de un modelo configurado en  `app/Http/Resources/ProductResource.php`.
lo que hace este archivo es darle formato a la informacion que se va a recibir el frontend

dentro de la funcion toArray podemos hacer lo siguiente
* $this vendria siendo una referencia de la base de datos para acceder a su columna
* debes de llenar los valores o no se enviara nada al front

```bash
public function toArray(Request $request): array
    {
        $item = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];


        return $item;
    }
```

### 5. Configurar la migracion creada
esto es para genera la tabla y sus columnas en la base de datos.
el archivo que te genero anteriormente se tiene que llenar de la siguiente manera, dile a chatgpt las columnas que quieres que tenga tu table

ejemplo de la tabla productos
```bash
 public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

```

al terminar tienes que usar el siguiente comando

```bash
php artisan migrate
```

si te equivocas usa lo siguiente para borrar la tabla
```bash
php artisan migrate:rollback
```

### 6. Registrar la API
este paso sirve para poder consumir la informacion desde el frontend, si no se hace esto no hay medio para poder comunicarse

En el archivo `routes/api.php` tenemos que registrar la ruta para acceder a nuestra informacion

```bash
Route::apiResource('products', ProductController::class);
```

* lo que le pasamos como cadena de texto es la ruta que tenemos que poner en nuestro crud en el frontend
* ProductController es el controlador que creamos al inicio tenemos que poner `::class` despues del controlador
* La funcion apiResource nos genera las siguientes rutas pero de manera mas compacta

Esto
```bash
Route::apiResource('products', ProductController::class);
```

Es lo mismo que esto
```bash
Route::get('products', [ProductController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::put('products/{product}', [ProductController::class, 'update']);
Route::delete('products/{product}', [ProductController::class, 'destroy']);
```


### 7. Manejar el Crud(opcional)

#### manejar la creacion (opcional)
Cuando el crud sea algo mas complejo puedes cambiar la logica de la funcion store sobreescribiendolo

ejemplo
```bash
public function store(Request $request){
    $data = $this->storeValidationRules($request);

    ....logica del codigo

    $producto = $this->create($data);
    $return = ProductResource($producto);
}
```

#### manejar la edicion del elemento (opcional)
Cuando el crud sea algo mas complejo puedes cambiar la logica de la funcion update sobreescribiendolo

copia lo siguiente en cualquier lugar

ejemplo
```bash
public function update(Request $request){
    $data = $this->storeValidationRules($request);

    ....logica del codigo

    $producto = $this->updateItem($data);
    $return = ProductResource($producto);
}
```

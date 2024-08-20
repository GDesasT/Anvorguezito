<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hamburguesas
        Producto::create([
            'nombre' => 'Hamburguesa Clásica',
            'descripcion' => 'Pan, carne, lechuga, tomate, queso, y cebolla',
            'precio' => 50.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain',
            'categoria' => 'food'
        ]);

        Producto::create([
            'nombre' => 'Hamburguesa Doble',
            'descripcion' => 'Pan, doble carne, lechuga, tomate, doble queso, y cebolla',
            'precio' => 75.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain',
            'categoria' => 'food'
        ]);

        Producto::create([
            'nombre' => 'Hamburguesa BBQ',
            'descripcion' => 'Pan, carne, queso, cebolla caramelizada, salsa BBQ',
            'precio' => 65.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain',
            'categoria' => 'food'
        ]);

        // Bebidas
        Producto::create([
            'nombre' => 'Refresco de Cola',
            'precio' => 20.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain',
            'categoria' => 'drinks'
        ]);

        Producto::create([
            'nombre' => 'Jugo de Naranja',
            'precio' => 25.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain',
            'categoria' => 'drinks'
        ]);

        Producto::create([
            'nombre' => 'Agua Mineral',
            'precio' => 15.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain',
            'categoria' => 'drinks'
        ]);
    }
}

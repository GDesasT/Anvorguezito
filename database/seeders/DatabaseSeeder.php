<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hamburguesa;
use App\Models\Bebida;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        Hamburguesa::create([
            'nombre' => 'Hamburguesa Clásica',
            'descripcion' => 'Pan, carne, lechuga, tomate, queso, y cebolla',
            'precio' => 50.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain'
        ]);

        Hamburguesa::create([
            'nombre' => 'Hamburguesa Doble',
            'descripcion' => 'Pan, doble carne, lechuga, tomate, doble queso, y cebolla',
            'precio' => 75.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain'
        ]);

        Hamburguesa::create([
            'nombre' => 'Hamburguesa BBQ',
            'descripcion' => 'Pan, carne, queso, cebolla caramelizada, salsa BBQ',
            'precio' => 65.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain'
        ]);

        // Bebidas
        Bebida::create([
            'nombre' => 'Refresco de Cola',
            'precio' => 20.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain'
        ]);

        Bebida::create([
            'nombre' => 'Jugo de Naranja',
            'precio' => 25.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain'
        ]);

        Bebida::create([
            'nombre' => 'Agua Mineral',
            'precio' => 15.00,
            'imagen_url' => 'https://th.bing.com/th/id/OIP.ly6yIuHghDlU_DDET9VTgQAAAA?rs=1&pid=ImgDetMain'
        ]);
    }
}

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-5 bg-white">
    <!-- Notificación de éxito -->
    @if(session('success'))
        <div id="notification" class="fixed z-50 p-4 text-white bg-green-500 rounded shadow-lg top-4 right-4 animate-slide-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex lg:flex-row flex-col-reverse shadow-lg">
        <!-- Sección Izquierda -->
        <div class="w-full lg:w-3/5 min-h-screen shadow-lg">
            <!-- Encabezado -->
            <div class="flex flex-row justify-between items-center px-5 mt-5">
                <div class="text-gray-800">
                    <div class="font-bold text-xl">Simons's BBQ Team</div>
                    <span class="text-xs">Location ID#SIMON123</span>
                </div>
                <div class="flex items-center">
                    <div class="text-sm text-center mr-4">
                        <div class="font-light text-gray-500">last synced</div>
                        <span class="font-semibold">3 mins ago</span>
                    </div>
                    <div>
                        <span class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded">
                            Help
                        </span>
                    </div>
                </div>
            </div>
            <!-- Fin del encabezado -->

            <!-- Categorías -->
            <div class="mt-5 flex flex-row px-5">
                <button onclick="filterItems('all', this)" class="category-button px-5 py-1 rounded-2xl text-sm font-semibold mr-4 hover:bg-yellow-500 active">
                    All items
                </button>
                <button onclick="filterItems('food', this)" class="category-button px-5 py-1 rounded-2xl text-sm font-semibold mr-4 hover:bg-yellow-500">
                    Food
                </button>
                <button onclick="filterItems('drinks', this)" class="category-button px-5 py-1 rounded-2xl text-sm font-semibold mr-4 hover:bg-yellow-500">
                    Drinks
                </button>
            </div>
            <!-- Fin de categorías -->

            <!-- Productos -->
            <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-5 mt-5 overflow-y-auto h-3/4">
                @foreach ($productos as $producto)
                    <button onclick="addToOrder('{{ $producto->id }}', '{{ $producto->nombre }}', {{ $producto->precio }}, '{{ $producto->imagen_url }}')" class="h-342px product-item flex flex-col border border-gray-300 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white p-4 focus:outline-none transform hover:scale-105" data-category="{{ strtolower($producto->categoria) }}">
                        <!-- Imagen del producto -->
                        <img src="{{ $producto->imagen_url }}" class="w-full h-40 object-cover rounded-md mb-4" alt="{{ $producto->nombre }}">
                        
                        <div class="flex-1">
                            <!-- Nombre del producto -->
                            <div class="font-semibold text-gray-800 text-lg mb-2">{{ $producto->nombre }}</div>
                            <!-- Descripción o peso -->
                            <span class="font-light text-sm text-gray-500">150g</span>
                        </div>
                        
                        <div class="flex items-center justify-between mt-4">
                            <!-- Precio del producto -->
                            <span class="font-bold text-xl text-yellow-600">{{ number_format($producto->precio, 2) }} MXN</span>
                        </div>
                    </button>
                @endforeach
            </div>
            <!-- Fin de productos -->
        </div>
        <!-- Fin de sección izquierda -->

        <!-- Sección Derecha -->
        <div class="w-full lg:w-2/5 bg-gray-100 p-4 rounded-lg shadow-md">
            <!-- Encabezado -->
            <div class="flex flex-row items-center justify-between mb-4">
                <div class="font-bold text-xl">Current Order</div>
                <div class="font-semibold">
                    <button onclick="clearOrder()" class="px-4 py-2 rounded-md bg-red-100 text-red-500">Clear All</button>
                    <button onclick="openSettings()" class="px-4 py-2 rounded-md bg-gray-100 text-gray-800">Settings</button>
                </div>
            </div>
            <!-- Fin del encabezado -->

            <!-- Lista de pedidos -->
            <div id="order-list" class="px-2 py-4 overflow-y-auto h-64">
                <!-- Los productos se agregarán aquí dinámicamente -->
            </div>
            <!-- Fin de lista de pedidos -->

            <!-- Total y botones -->
            <div class="flex flex-col mt-4">
                <div class="flex flex-row justify-between mb-2">
                    <span class="font-semibold">Total:</span>
                    <span id="total-amount" class="font-bold text-lg">$0.00</span>
                </div>
                <button onclick="finalizeOrder()" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Finalize Order</button>
            </div>
        </div>
        <!-- Fin de sección derecha -->
    </div>
</div>

<script>
    const orderList = document.getElementById('order-list');
    const totalAmountElement = document.getElementById('total-amount');

    let orderItems = [];
    let totalAmount = 0;

    function addToOrder(id, name, price, imageUrl) {
        // Check if item already exists
        const existingItemIndex = orderItems.findIndex(item => item.id === id);
        if (existingItemIndex >= 0) {
            // Update quantity if already exists
            orderItems[existingItemIndex].quantity += 1;
        } else {
            // Add new item
            orderItems.push({
                id: id,
                name: name,
                price: price,
                imageUrl: imageUrl,
                quantity: 1
            });
        }
        updateOrderList();
    }

    function filterItems(category, button) {
        // Obtener todos los botones de categoría y eliminar la clase 'active' de ellos
        document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
        // Agregar la clase 'active' al botón seleccionado
        button.classList.add('active');

        // Filtrar los productos según la categoría seleccionada
        document.querySelectorAll('.product-item').forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'block'; // Mostrar producto
            } else {
                item.style.display = 'none';  // Ocultar producto
            }
        });
    }

    function updateOrderList() {
        orderList.innerHTML = '';
        totalAmount = 0;

        orderItems.forEach(item => {
            totalAmount += item.price * item.quantity;
            orderList.innerHTML += `
                <div class="flex flex-row justify-between items-center mb-4">
                    <div class="flex flex-row items-center w-2/5">
                        <img src="${item.imageUrl}" class="w-10 h-10 object-cover rounded-md" alt="${item.name}">
                        <span class="ml-4 font-semibold text-sm">${item.name}</span>
                    </div>
                    <div class="w-32 flex justify-between items-center">
                        <button onclick="updateQuantity('${item.id}', -1)" class="px-3 py-1 rounded-md bg-gray-300">-</button>
                        <span class="font-semibold mx-4">${item.quantity}</span>
                        <button onclick="updateQuantity('${item.id}', 1)" class="px-3 py-1 rounded-md bg-gray-300">+</button>
                    </div>
                    <div class="font-semibold text-lg w-16 text-center">
                        $${(item.price * item.quantity).toFixed(2)}
                    </div>
                </div>
            `;
        });

        totalAmountElement.textContent = `$${totalAmount.toFixed(2)}`;
    }

    function updateQuantity(id, change) {
        const itemIndex = orderItems.findIndex(item => item.id === id);
        if (itemIndex >= 0) {
            orderItems[itemIndex].quantity += change;
            if (orderItems[itemIndex].quantity <= 0) {
                orderItems.splice(itemIndex, 1);
            }
            updateOrderList();
        }
    }

    function clearOrder() {
        orderItems = [];
        updateOrderList();
    }

    async function finalizeOrder() {
    if (orderItems.length > 0) {
        const ventasStoreUrl = '{{ route('ventas.store') }}';
        try {
            const response = await fetch(ventasStoreUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Importante para enviar JSON
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ productos: orderItems })
            });

            const result = await response.text(); // Cambiado a text() para capturar todo
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while finalizing the order.');
        }
    } else {
        alert('No items in the order.');
    }
}

    function openSettings() {
        alert('Settings dialog.');
    }
</script>

@endsection

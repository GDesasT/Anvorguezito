@extends('layouts.app')

@section('content')
<div class="container px-5 mx-auto bg-white">
    <!-- Notificación de éxito -->
    @if(session('success'))
        <div id="notification" class="fixed z-50 p-4 text-white bg-green-500 rounded shadow-lg top-4 right-4 animate-slide-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col-reverse shadow-lg lg:flex-row">
        <!-- Sección Izquierda -->
        <div class="w-full min-h-screen shadow-lg lg:w-3/5">
            <!-- Encabezado -->
            <div class="flex flex-row items-center justify-between px-5 mt-5">
                <div class="text-gray-800">
                    <div class="text-xl font-bold">Ñeco El Muñeco</div>
                    <span class="text-xs">Torreon, Coahuila</span>
                </div>
                <div class="flex items-center">
                    <div class="mr-4 text-sm text-center">
                        <div id="datetime" class="text-lg font-semibold text-gray-800"></div>
                    </div>
                    <div>
                        <span class="px-4 py-2 font-semibold text-gray-800 bg-gray-200 rounded">
                            Help
                        </span>
                    </div>
                </div>
            </div>
            <!-- Fin del encabezado -->

            <!-- Categorías -->
            <div class="flex flex-row px-5 mt-5">
                <button onclick="filterItems('all', this)" class="px-5 py-1 mr-4 text-sm font-semibold category-button rounded-2xl hover:bg-yellow-500 active">
                    All items
                </button>
                <button onclick="filterItems('food', this)" class="px-5 py-1 mr-4 text-sm font-semibold category-button rounded-2xl hover:bg-yellow-500">
                    Food
                </button>
                <button onclick="filterItems('drinks', this)" class="px-5 py-1 mr-4 text-sm font-semibold category-button rounded-2xl hover:bg-yellow-500">
                    Drinks
                </button>
            </div>
            <!-- Fin de categorías -->

            <!-- Productos -->
            <div id="product-list" class="grid grid-cols-1 gap-6 px-5 mt-5 overflow-y-auto sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 h-3/4">
                @foreach ($productos as $producto)
                    <button onclick="addToOrder('{{ $producto->id }}', '{{ $producto->nombre }}', {{ $producto->precio }}, '{{ $producto->imagen_url }}')" class="flex flex-col p-4 transition-shadow duration-300 transform bg-white border border-gray-300 rounded-lg shadow-lg h-342px product-item hover:shadow-xl focus:outline-none hover:scale-105" data-category="{{ strtolower($producto->categoria) }}">
                        <!-- Imagen del producto -->
                        <img src="{{ $producto->imagen_url }}" class="object-cover w-full h-40 mb-4 rounded-md" alt="{{ $producto->nombre }}">

                        <div class="flex-1">
                            <!-- Nombre del producto -->
                            <div class="mb-2 text-lg font-semibold text-gray-800">{{ $producto->nombre }}</div>
                            <!-- Descripción o peso -->
                            <span class="text-sm font-light text-gray-500">150g</span>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <!-- Precio del producto -->
                            <span class="text-xl font-bold text-yellow-600">{{ number_format($producto->precio, 2) }} MXN</span>
                        </div>
                    </button>
                @endforeach
            </div>
            <!-- Fin de productos -->
        </div>
        <!-- Fin de sección izquierda -->

        <!-- Sección Derecha -->
        <div class="w-full p-4 bg-gray-100 rounded-lg shadow-md lg:w-2/5">
            <!-- Encabezado -->
            <div class="flex flex-row items-center justify-between mb-4">
                <div class="text-xl font-bold">Venta Actual</div>
                <div class="font-semibold">
                    <button onclick="clearOrder()" class="px-4 py-2 text-red-500 bg-red-100 rounded-md">Limpiar Venta</button>

                </div>
            </div>
            <!-- Fin del encabezado -->

            <!-- Lista de pedidos -->
            <div id="order-list" class="h-64 px-2 py-4 overflow-y-auto">
                <!-- Los productos se agregarán aquí dinámicamente -->
            </div>
            <!-- Fin de lista de pedidos -->

            <!-- Total y botones -->
            <div class="flex flex-col mt-4">
                <div class="flex flex-row justify-between mb-2">
                    <span class="font-semibold">Total:</span>
                    <span id="total-amount" class="text-lg font-bold">$0.00</span>
                </div>
                <button onclick="finalizeOrder()" class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">Finalizar Venta</button>
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
                <div class="flex flex-row items-center justify-between mb-4">
                    <div class="flex flex-row items-center w-2/5">
                        <img src="${item.imageUrl}" class="object-cover w-10 h-10 rounded-md" alt="${item.name}">
                        <span class="ml-4 text-sm font-semibold">${item.name}</span>
                    </div>
                    <div class="flex items-center justify-between w-32">
                        <button onclick="updateQuantity('${item.id}', -1)" class="px-3 py-1 bg-gray-300 rounded-md">-</button>
                        <span class="mx-4 font-semibold">${item.quantity}</span>
                        <button onclick="updateQuantity('${item.id}', 1)" class="px-3 py-1 bg-gray-300 rounded-md">+</button>
                    </div>
                    <div class="w-16 text-lg font-semibold text-center">
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
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ productos: orderItems })
            });

            const result = await response.json();
            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Venta Exitosa',
                    text: 'La Venta se ha Hecho Exitosamente!',
                });
                clearOrder();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La Venta no se Completo, Intentelo de Nuevo',
                });
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La Venta no se Completo, Intentelo de Nuevo',
            });
        }
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'No Hay Productos Seleccionados',
        });
    }
}


    function openSettings() {
        alert('Settings dialog.');
    }
    function updateDateTime() {
            const now = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
            const dateString = now.toLocaleDateString('es-ES', options);
            const timeString = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            document.getElementById('datetime').textContent = `${dateString} ${timeString}`;
        }

        // Actualiza la fecha y hora cada segundo
        setInterval(updateDateTime, 1000);

        // Muestra la fecha y hora inmediatamente al cargar la página
        updateDateTime();
</script>

@endsection

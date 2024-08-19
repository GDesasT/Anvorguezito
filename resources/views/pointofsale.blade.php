@extends('layouts.app')

@section('content')
<div class="container p-4 mx-auto">
    <!-- Notificación de éxito -->
    @if(session('success'))
        <div id="notification" class="fixed z-50 p-4 text-white bg-green-500 rounded shadow-lg top-4 right-4 animate-slide-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-4 gap-4">
        <!-- Panel Fijo a la Izquierda -->
        <div class="col-span-1">
            <div class="flex flex-col justify-between h-full p-4 border-2 border-gray-300" style="height: calc(100vh - 8rem);">
                <div class="flex-grow overflow-y-auto" style="max-height: calc(100vh - 20rem);">
                    <h3 class="text-lg font-bold">Información de lo que se pidió</h3>
                    <div id="pedido-lista" class="mt-4">
                        <!-- Aquí se agregarán los productos seleccionados -->
                    </div>
                </div>
                <div>
                    <p><strong>Total:</strong> <span id="total-pedido">0.00</span> MXN</p>
                    <form id="form-total" method="POST" action="{{ route('guardar_venta') }}">
                        @csrf
                        <input type="hidden" name="total" id="final-total-input" value="0">
                        <button id="total-button" type="submit" class="w-full px-4 py-2 mb-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700" disabled>Total</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Panel con Pestañas -->
        <div class="col-span-3">
            <div class="flex mb-4">
                <button id="tab-hamburguesas" onclick="openTab(event, 'hamburguesas')" class="w-1/2 px-4 py-2 font-semibold text-gray-700 bg-white border-t-2 border-l-2 border-r-2 border-gray-300 rounded-t-md focus:outline-none">Hamburguesas</button>
                <button id="tab-bebidas" onclick="openTab(event, 'bebidas')" class="w-1/2 px-4 py-2 font-semibold text-gray-700 bg-white border-t-2 border-l-2 border-r-2 border-gray-300 rounded-t-md focus:outline-none">Bebidas</button>
            </div>

            <div id="hamburguesas" class="flex flex-col justify-between p-4 border-b-2 border-l-2 border-r-2 border-gray-300 tab-content" style="height: calc(100vh - 8rem);">
                <div class="grid flex-grow grid-cols-3 gap-4">
                    <!-- Botones con imágenes para Hamburguesas -->
                    @foreach ($productos as $producto)
                        @if ($producto instanceof App\Models\Hamburguesa)
                            <button onclick="addToOrder('{{ $producto->nombre }}', {{ $producto->precio }})" class="flex items-center justify-center h-32 p-4 bg-white border-2 border-gray-300 hover:bg-gray-100">
                                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="object-cover h-full">
                                <div class="ml-2 text-left">
                                    <p>{{ $producto->nombre }}</p>
                                    <p>{{ number_format($producto->precio, 2) }} MXN</p>
                                </div>
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <div id="bebidas" class="flex flex-col justify-between hidden p-4 border-b-2 border-l-2 border-r-2 border-gray-300 tab-content" style="height: calc(100vh - 8rem);">
                <div class="grid flex-grow grid-cols-3 gap-4">
                    <!-- Botones con imágenes para Bebidas -->
                    @foreach ($productos as $producto)
                        @if ($producto instanceof App\Models\Bebida)
                            <button onclick="addToOrder('{{ $producto->nombre }}', {{ $producto->precio }})" class="flex items-center justify-center h-32 p-4 bg-white border-2 border-gray-300 hover:bg-gray-100">
                                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="object-cover h-full">
                                <div class="ml-2 text-left">
                                    <p>{{ $producto->nombre }}</p>
                                    <p>{{ number_format($producto->precio, 2) }} MXN</p>
                                </div>
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slide-in {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slide-out {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }

    .animate-slide-in {
        animation: slide-in 0.5s ease-out forwards;
    }

    .animate-slide-out {
        animation: slide-out 0.5s ease-out forwards;
    }
</style>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Mostrar la primera pestaña por defecto
    document.getElementById("tab-hamburguesas").click();

    function addToOrder(nombre, precio) {
        var lista = document.getElementById("pedido-lista");
        var total = document.getElementById("total-pedido");

        var item = document.createElement("div");
        item.classList.add("flex", "justify-between", "items-center", "my-2");

        var itemText = document.createElement("p");
        itemText.innerText = nombre + ' - ' + precio.toFixed(2) + ' MXN';

        var deleteButton = document.createElement("button");
        deleteButton.innerText = "Eliminar";
        deleteButton.classList.add("text-red-500", "ml-4");
        deleteButton.onclick = function() {
            lista.removeChild(item);
            total.innerText = (parseFloat(total.innerText) - precio).toFixed(2);
            document.getElementById("final-total-input").value = total.innerText;
            toggleTotalButton();
        };

        item.appendChild(itemText);
        item.appendChild(deleteButton);
        lista.appendChild(item);

        total.innerText = (parseFloat(total.innerText) + precio).toFixed(2);
        document.getElementById("final-total-input").value = total.innerText;

        toggleTotalButton();
    }

    function toggleTotalButton() {
        var lista = document.getElementById("pedido-lista");
        var totalButton = document.getElementById("total-button");
        if (lista.children.length > 0) {
            totalButton.disabled = false;
        } else {
            totalButton.disabled = true;
        }
    }

    // Ocultar la notificación después de unos segundos con animación
    setTimeout(function() {
        var notification = document.getElementById('notification');
        if (notification) {
            notification.classList.remove('animate-slide-in');
            notification.classList.add('animate-slide-out');
            setTimeout(function() {
                notification.style.display = 'none';
            }, 500); // Espera a que termine la animación
        }
    }, 3000); // La notificación desaparecerá después de 3 segundos
</script>

@endsection

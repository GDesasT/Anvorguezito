@extends('layouts.app')

@section('content')
<div class="bg-cover bg-center" style="background-image: url('../img/comedorbueno.png');">
    <div class="container mx-auto py-20 px-10 animate-fadeInUp">
        <div class="flex flex-col md:flex-row md:space-x-8 items-center">
            <div class="md:w-1/2 flex justify-center animate-fadeInUp">
                <div class="w-64 h-64 flex justify-center items-center">
                    <img src="{{ asset('img/logo.jpg') }}" class="max-w-full max-h-full rounded-full" alt="Logo Comedor Industrial">
                </div>
            </div>
            <div class="md:w-1/2 sm:w-auto bg-black bg-opacity-40 rounded-2xl p-5 m-10 animate-fadeInUp">
                <h1 class="text-3xl font-bold text-center text-white">Lorem Ipsum</h1>
                <p class="mt-4 text-gray-300 text-justify leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus facilisis dolor at sapien tincidunt, sed sollicitudin metus viverra. Sed laoreet, dui ut faucibus convallis, orci erat tempus felis, non fermentum arcu orci non leo.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto mt-8">
    <div class="grid grid-cols-1 md:grid-cols-2 sm:grid-cols-1 gap-8 animate-fadeInUp">
        <div class="bg-white rounded-lg shadow-md overflow-hidden animate-fadeInUp">
            <img src="{{ asset('img/barradeensaladas.jpg') }}" class="w-full h-64 object-cover" alt="Card Image">
            <div class="p-4">
                <h5 class="text-xl font-bold text-gray-800 mb-2">Lorem Ipsum</h5>
                <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis tincidunt sem. Mauris in venenatis nunc, at congue elit. Nam dapibus, sapien sed vehicula dignissim, nulla elit ornare arcu, sed tempus ex felis et odio.</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden animate-fadeInUp">
            <img src="{{ asset('img/generalcomedor.jpg') }}" class="w-full h-64 object-cover" alt="Card Image">
            <div class="p-4">
                <h5 class="text-xl font-bold text-gray-800 mb-2">Lorem Ipsum</h5>
                <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis tincidunt sem. Mauris in venenatis nunc, at congue elit. Nam dapibus, sapien sed vehicula dignissim, nulla elit ornare arcu, sed tempus ex felis et odio.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto mt-8">
    <div class="flex flex-col md:flex-row md:space-x-8 items-center animate-fadeInUp">
        <div class="md:w-1/3 flex justify-center animate-fadeInUp">
            <img src="{{ asset('img/distintivoH.png') }}" class="h-64" alt="Distintivo H">
        </div>
        <div class="md:w-2/3 sm:w-auto bg-white rounded-2xl p-5 m-10 animate-fadeInUp">
            <h2 class="text-3xl font-bold text-center text-gray-800">Lorem Ipsum</h2>
            <p class="mt-4 text-gray-600 text-justify leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod ipsum sed dui tristique, sed posuere odio aliquet.
            </p>
            <p class="mt-4 text-gray-600 text-justify leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod ipsum sed dui tristique, sed posuere odio aliquet.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto mt-8">
    <div class="flex flex-col md:flex-row md:space-x-8 items-center animate-fadeInUp">
        <div class="md:w-2/3 bg-white rounded-2xl p-10 m-10 animate-fadeInUp">
            <h2 class="text-4xl font-bold text-center text-gray-800">Lorem Ipsum</h2>
            <p class="mt-6 text-xl text-gray-600 text-center leading-relaxed">
                Lorem ipsum dolor sit amet.
            </p>
            <p class="mt-4 text-xl text-gray-600 text-center leading-relaxed">
                Lorem ipsum dolor sit amet.
            </p>
        </div>
        <div class="md:w-1/3 flex justify-center animate-fadeInUp">
            <img src="{{ asset('img/logotelefonoyemail.png') }}" class="h-48" alt="Contacto">
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

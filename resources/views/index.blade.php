@extends('layouts.app')

@section('content')
<div class="bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('../img/parrilla.jpg');">
    <div class="container mx-auto px-4 py-16 md:py-24 animate-fadeInUp">
        <div class="flex flex-col md:flex-row md:space-x-8 items-center">
            <div class="md:w-1/2 flex justify-center">
                <div class="md:w-1/2 w-32 h-32 md:w-64 md:h-64 flex justify-center items-center bg-white rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('img/logo.jpg') }}" class="w-full h-full object-cover rounded-full" alt="Logo Comedor Industrial">
                </div>
            </div>
            <div class="md:w-1/2 bg-black bg-opacity-60 rounded-xl p-8 md:p-12 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white">Lorem Ipsum</h1>
                <p class="mt-6 text-gray-300 text-lg leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus facilisis dolor at sapien tincidunt, sed sollicitudin metus viverra. Sed laoreet, dui ut faucibus convallis, orci erat tempus felis, non fermentum arcu orci non leo.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto mt-12 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="{{ asset('img/barradeensaladas.jpg') }}" class="w-full h-56 object-cover" alt="Barra de Ensaladas">
            <div class="p-6">
                <h5 class="text-2xl font-bold text-gray-800 mb-3">Lorem Ipsum</h5>
                <p class="text-gray-600 text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis tincidunt sem. Mauris in venenatis nunc, at congue elit. Nam dapibus, sapien sed vehicula dignissim, nulla elit ornare arcu, sed tempus ex felis et odio.</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="{{ asset('img/generalcomedor.jpg') }}" class="w-full h-56 object-cover" alt="Comedor General">
            <div class="p-6">
                <h5 class="text-2xl font-bold text-gray-800 mb-3">Lorem Ipsum</h5>
                <p class="text-gray-600 text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis tincidunt sem. Mauris in venenatis nunc, at congue elit. Nam dapibus, sapien sed vehicula dignissim, nulla elit ornare arcu, sed tempus ex felis et odio.</p>
            </div>
        </div>
    </div>
</div>

@if($images->count() > 0)
<div class="container mx-auto mt-12 px-4">
    <div x-data="carouselData()" class="relative w-full">
        <div class="relative h-64 md:h-96 overflow-hidden rounded-lg shadow-lg">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === (index + 1)" class="absolute inset-0 transition-all transform duration-700"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <img :src="'{{ Storage::url('') }}' + slide.path" class="absolute block w-full h-full object-cover rounded-lg" alt="">
                </div>
            </template>
        </div>
        <button @click="prevSlide()" id="prev" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button @click="nextSlide()" id="next" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</div>
@else
    <p class="text-center mt-8 text-gray-600">No hay imágenes activas en el carrusel.</p>
@endif

<script>
    function carouselData() {
        return {
            activeSlide: 1,
            slides: @json($images),
            nextSlide() {
                this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1;
            },
            prevSlide() {
                this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1;
            }
        }
    }
</script>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

<div class="bg-white rounded-lg shadow-md mb-4">
    <div class="relative">
        @php
            $images = json_decode($car->images);
            $mainImage = $images[0] ?? '';
        @endphp
        <img src="{{ $mainImage }}" 
             alt="{{ $car->title }}"
             class="w-full h-48 object-cover rounded-t-lg"
             style="object-position: center;">
        @if($car->is_featured)
            <div class="absolute top-2 right-2">
                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">Featured</span>
            </div>
        @endif
    </div>
    <div class="p-4">
        <h3 class="text-xl font-semibold mb-2 truncate">{{ $car->title }}</h3>
        <div class="flex justify-between items-center mb-4">
            <span class="text-2xl font-bold text-blue-600">${{ number_format($car->price) }}</span>
            <span class="text-gray-600">{{ $car->year }}</span>
        </div>
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
            <div class="flex items-center">
                <i class="material-icons text-gray-500 mr-2">speed</i>
                {{ number_format($car->mileage) }} mi
            </div>
            <div class="flex items-center">
                <i class="material-icons text-gray-500 mr-2">settings</i>
                {{ $car->transmission }}
            </div>
        </div>
        <a href="{{ route('cars.show', $car) }}" 
           class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition duration-300">
            View Details
        </a>
    </div>
</div>

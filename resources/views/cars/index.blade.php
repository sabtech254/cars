<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Available Cars</h1>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('cars.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add New Car
                    </a>
                @endif
            @endauth
        </div>

        <!-- Filters -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form action="{{ route('cars.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                    <select name="make" id="make" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All Makes</option>
                        @foreach($makes as $m)
                            <option value="{{ $m }}" {{ request('make') == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="body_type" class="block text-sm font-medium text-gray-700">Body Type</label>
                    <select name="body_type" id="body_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All Types</option>
                        @foreach($bodyTypes as $type)
                            <option value="{{ $type }}" {{ request('body_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="price_range" class="block text-sm font-medium text-gray-700">Price Range</label>
                    <select name="price_range" id="price_range" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Any Price</option>
                        <option value="0-50000" {{ request('price_range') == '0-50000' ? 'selected' : '' }}>Under $50,000</option>
                        <option value="50000-100000" {{ request('price_range') == '50000-100000' ? 'selected' : '' }}>$50,000 - $100,000</option>
                        <option value="100000-plus" {{ request('price_range') == '100000-plus' ? 'selected' : '' }}>Over $100,000</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Cars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $car)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative" style="height: 250px; overflow: hidden;">
                    @php
                        $images = json_decode($car->images);
                        $mainImage = $images[0] ?? 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800';
                    @endphp
                    <img src="{{ $mainImage }}" 
                         alt="{{ $car->title }}"
                         class="w-full h-full object-cover"
                         style="object-position: center;">
                    @if($car->is_featured)
                        <span class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded text-sm">Featured</span>
                    @endif
                </div>
                
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $car->title }}</h2>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-bold text-blue-600">${{ number_format($car->price) }}</span>
                        <span class="text-sm text-gray-600">{{ $car->year }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 mb-4 text-sm">
                        <div class="flex items-center">
                            <i class="material-icons text-gray-500 mr-1" style="font-size: 16px;">speed</i>
                            <span>{{ number_format($car->mileage) }} mi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="material-icons text-gray-500 mr-1" style="font-size: 16px;">local_gas_station</i>
                            <span>{{ $car->fuel_type }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="material-icons text-gray-500 mr-1" style="font-size: 16px;">settings</i>
                            <span>{{ $car->transmission }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="material-icons text-gray-500 mr-1" style="font-size: 16px;">palette</i>
                            <span>{{ $car->color }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('cars.show', $car) }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View Details
                        </a>
                        @auth
                            @if(auth()->user()->is_admin)
                                <div class="flex space-x-2">
                                    <a href="{{ route('cars.edit', $car) }}" 
                                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                onclick="return confirm('Are you sure you want to delete this car?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $cars->links() }}
        </div>
    </div>
</x-app-layout>

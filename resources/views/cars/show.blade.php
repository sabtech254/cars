<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Image Gallery -->
            <div class="relative">
                <div id="carImageGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $images = json_decode($car->images);
                        @endphp
                        @foreach($images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div style="height: 500px; overflow: hidden;">
                                    <img src="{{ $image }}" 
                                         alt="{{ $car->title }} - Image {{ $index + 1 }}"
                                         class="w-full h-full object-cover"
                                         style="object-position: center;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if(count($images) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carImageGallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carImageGallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
                
                <!-- Thumbnail Navigation -->
                <div class="flex justify-center mt-4 space-x-2 px-4">
                    @foreach($images as $index => $image)
                        <div class="cursor-pointer" 
                             onclick="document.querySelector('#carImageGallery').querySelector('.carousel-item:nth-child({{ $index + 1 }})').classList.add('active')"
                             style="width: 100px; height: 75px; overflow: hidden;">
                            <img src="{{ $image }}" 
                                 alt="Thumbnail {{ $index + 1 }}"
                                 class="w-full h-full object-cover hover:opacity-75 transition-opacity duration-200"
                                 style="object-position: center;">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Car Details -->
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $car->title }}</h1>
                        <p class="text-gray-600">{{ $car->year }} {{ $car->make }} {{ $car->model }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-blue-600">${{ number_format($car->price, 2) }}</div>
                        <span class="inline-block mt-2 px-3 py-1 bg-{{ $car->status === 'available' ? 'green' : 'red' }}-500 text-white rounded-full text-sm">
                            {{ ucfirst($car->status) }}
                        </span>
                    </div>
                </div>

                <!-- Key Features -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="flex items-center">
                        <i class="material-icons text-gray-500 mr-2">speed</i>
                        <div>
                            <div class="text-sm text-gray-600">Mileage</div>
                            <div class="font-semibold">{{ number_format($car->mileage) }} km</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="material-icons text-gray-500 mr-2">local_gas_station</i>
                        <div>
                            <div class="text-sm text-gray-600">Fuel Type</div>
                            <div class="font-semibold">{{ $car->fuel_type }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="material-icons text-gray-500 mr-2">settings</i>
                        <div>
                            <div class="text-sm text-gray-600">Transmission</div>
                            <div class="font-semibold">{{ $car->transmission }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="material-icons text-gray-500 mr-2">palette</i>
                        <div>
                            <div class="text-sm text-gray-600">Color</div>
                            <div class="font-semibold">{{ $car->color }}</div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold mb-3">Description</h2>
                    <p class="text-gray-700">{{ $car->description }}</p>
                </div>

                <!-- Features -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold mb-3">Features</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach(json_decode($car->features) as $feature)
                            <div class="flex items-center">
                                <i class="material-icons text-green-500 mr-2" style="font-size: 16px;">check_circle</i>
                                <span>{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t">
                    <div class="flex space-x-4">
                        @auth
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('cars.edit', $car) }}" 
                                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Car
                                </a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                            onclick="return confirm('Are you sure you want to delete this car?')">
                                        Delete Car
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                    
                    <div class="flex space-x-4">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                onclick="document.getElementById('contactModal').classList.remove('hidden')">
                            Contact Seller
                        </button>
                        @auth
                            <a href="{{ route('bids.create', $car) }}" class="btn btn-primary">
                                <i class="material-icons align-middle">gavel</i> Place Bid
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Contact Seller</h2>
                    <form action="{{ route('cars.contact', $car) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" id="email" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   value="{{ auth()->user()->email ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                            <textarea name="message" id="message" rows="4" required
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button type="button" 
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="document.getElementById('contactModal').classList.add('hidden')">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bid Modal -->
    @auth
    <div id="bidModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Place a Bid</h2>
                    <form action="{{ route('bids.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <div class="mb-4">
                            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Bid Amount ($)</label>
                            <input type="number" name="amount" id="amount" required min="{{ $car->price }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <p class="text-sm text-gray-600 mt-1">Minimum bid: ${{ number_format($car->price, 2) }}</p>
                        </div>
                        <div class="mb-4">
                            <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button type="button" 
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="document.getElementById('bidModal').classList.add('hidden')">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Submit Bid
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
</x-app-layout>

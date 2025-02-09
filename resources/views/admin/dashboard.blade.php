<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <!-- Total Cars -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">Total Cars</h3>
                        <p class="text-3xl font-bold">{{ $totalCars }}</p>
                        <div class="mt-2">
                            <span class="text-sm text-gray-600">Available: {{ $availableCars }}</span>
                            <span class="text-sm text-gray-600 ml-4">Sold: {{ $soldCars }}</span>
                        </div>
                    </div>
                </div>

                <!-- Featured Cars -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">Featured Cars</h3>
                        <p class="text-3xl font-bold">{{ $featuredCars }}</p>
                        <p class="text-sm text-gray-600 mt-2">Currently featured</p>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                        <p class="text-sm text-gray-600 mt-2">Registered users</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Recent Cars -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Cars</h3>
                    <div class="space-y-4">
                        @foreach($recentCars as $car)
                        <div class="flex items-center justify-between border-b pb-2">
                            <div>
                                <h4 class="font-medium">{{ $car->title }}</h4>
                                <p class="text-sm text-gray-600">${{ number_format($car->price) }} - {{ $car->status }}</p>
                            </div>
                            <a href="{{ route('cars.show', $car) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('cars.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">View all cars →</a>
                </div>

                <!-- Recent Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Users</h3>
                    <div class="space-y-4">
                        @foreach($recentUsers as $user)
                        <div class="flex items-center justify-between border-b pb-2">
                            <div>
                                <h4 class="font-medium">{{ $user->name }}</h4>
                                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                            </div>
                            <span class="text-sm text-gray-600">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

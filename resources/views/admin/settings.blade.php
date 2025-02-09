@extends('layouts.admin')

@section('main-content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Admin Settings</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-6">
            <!-- Site Settings -->
            <div class="border-b pb-6">
                <h2 class="text-xl font-semibold mb-4">Site Settings</h2>
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                        <input type="text" name="site_name" id="site_name" value="{{ $settings['site_name'] }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                        <input type="email" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ $settings['phone_number'] }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Save Settings
                    </button>
                </form>
            </div>

            <!-- Email Settings -->
            <div class="border-b pb-6">
                <h2 class="text-xl font-semibold mb-4">Email Settings</h2>
                <form action="{{ route('admin.settings.email') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="smtp_host" class="block text-sm font-medium text-gray-700">SMTP Host</label>
                        <input type="text" name="smtp_host" id="smtp_host" value="{{ $settings['smtp_host'] }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="smtp_port" class="block text-sm font-medium text-gray-700">SMTP Port</label>
                        <input type="text" name="smtp_port" id="smtp_port" value="{{ $settings['smtp_port'] }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="smtp_username" class="block text-sm font-medium text-gray-700">SMTP Username</label>
                        <input type="text" name="smtp_username" id="smtp_username" value="{{ $settings['smtp_username'] }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="smtp_password" class="block text-sm font-medium text-gray-700">SMTP Password</label>
                        <input type="password" name="smtp_password" id="smtp_password" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Save Email Settings
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

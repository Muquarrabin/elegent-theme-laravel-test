<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <div class="card-header">
                            Customer Details
                        </div>
                        <div class="card-body">
                            <label>Name: {{$customer->name}}</label>
                            <br>
                            <label>Phone: {{$customer->phone}}</label>
                            <br>
                            <label>Email: {{$customer->email}}</label>
                            <br>
                            <label>Desired Budget: {{$customer->budget}}</label>
                            <br>
                            <label>Message: {{$customer->message}}</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


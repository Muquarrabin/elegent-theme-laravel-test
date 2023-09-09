<x-app-layout>
    <!-- Session Status -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{route('customer.store')}}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus  />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus  />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus  />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Budget -->
                        <div>
                            <x-input-label for="budget" value="Desired Budget" />
                            <x-text-input id="budget" class="block mt-1 w-full" type="text" name="budget" :value="old('budget')" required autofocus  />
                            <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                        </div>

                        <!-- Budget -->
                        <div>
                            <x-input-label for="message" value="Message" />
                            <x-textarea-input id="message" class="block mt-1 w-full"  name="message" :value="old('message')" required autofocus  />
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>



                        <div class="flex items-center justify-end mt-4">


                            <x-primary-button class="ml-3">
                                Submit
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

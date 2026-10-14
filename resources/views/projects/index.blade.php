@auth
    <x-app-layout>
        @endauth
<x-public-layout>
    <h1>Welcome to the projects page!</h1>

        <x-card
        title="Hello, World!"
        summary="Summary"
        ></x-card>

        @auth
                </x-app-layout>
        @endauth
</x-public-layout>
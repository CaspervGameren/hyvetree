<x-layouts.app>
    <x-header title="Create Project">
        <form action="{{ route('projects.store') }}" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </form>
    </x-header>
</x-layouts.app>
<x-public-layout>
    <form action="{{ route(project.store) }}" method="post"></form>
    <label for="title">Project Titel</label>
    <input type="text" id="title" name="title" value="{{ old('title') }}">
</x-public-layout>
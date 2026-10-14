@props([
    'title' => 'Project title',
    'summary' => 'Short desciption of the project'
])

<div>
    <h2>{{ $title }}</h2>
    <desc>{{ $summary }}</desc>
    <img src="" alt="{{ $title . ' ' . $summary }}">
    <button>Details</button>
</div>
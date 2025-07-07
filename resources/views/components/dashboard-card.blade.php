@props(['title', 'count', 'color' => 'blue', 'link' => null, 'linkText' => null])

<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
    <h2 class="text-xl font-semibold mb-2">{{ $title }}</h2>
    <p class="text-3xl font-bold text-{{ $color }}-600">{{ $count }}</p>
    @if ($link)
        <a href="{{ $link }}" class="text-{{ $color }}-500 hover:underline mt-2 inline-block">
            {{ $linkText }}
        </a>
    @endif
</div>

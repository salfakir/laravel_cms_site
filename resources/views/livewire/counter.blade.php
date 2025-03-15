<div class="text-align: center">
    {{-- Stop trying to control. --}}
    <button wire:click="increment" onclick="console.log({{ $count }})">+</button>
    <h1>{{ $count }}</h1>
     <div x-data="{ expanded: false }">
        <button type="button" x-on:click="expanded = ! expanded">
            <span x-show="! expanded">Show post content...</span>
            <span x-show="expanded">Hide post content...</span>
        </button>

        <div x-show="expanded">
            {{ $count }}
        </div>
    </div>
</div>

<div>
    <x-navbar :selected="$selected" />
    <div class="content">
        {{ $slot }}
    </div>
    <x-footer />
</div>
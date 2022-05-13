<button type='submit' @class([
    'bg-lilac-100'=> $filled,
    'text-lilac-100'=> !$filled,
    'text-white'=> $filled,
    'border-2'=> !$filled,
    'border-lilac-100',
    'p-2',
    'm-1',
    'font-bold',
    'rounded-cust',
    'hover:bg-lilac-200',
    'hover:text-white'=> !$filled,
    'transition',
    'duration-500'
])>
    {{ $slot }}
</button>

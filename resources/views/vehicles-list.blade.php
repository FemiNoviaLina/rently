<x-base-layout>
    <x-base-body selected="">
    <div class="flex justify-between flex-wrap mt-20">
            <div class="flex flex-col justify-center mx-10">
                <h2 class="text-lilac-200 font-bold text-4xl">Available {{ $type }}s</h2>
                <p class="text-lilac-100 font-bold">{{ count($vehicles) }} Vehicles</p>
            </div>
            <form action="{{ '/'.strtolower($type).'s' }}" method="get" class=>
                <div class="flex flex-wrap max-w-3xl mx-10 py-10 gap-5 px-10 justify-center bg-white rounded-xl shadow-md">
                    <div class="flex items-center font-bold text-lilac-200">
                        <p>Filter by</p>
                    </div>
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="pickup_date" value="{{ $pickup_date }}">
                    <input type="hidden" name="dropoff_date" value="{{ $dropoff_date }}">
                    <div>
                        <label class="block tracking-wide font-bold mb-2" for="brand">
                            Brand
                        </label>
                        <div class="inline-block w-32">
                            @if($type == 'Motor')
                            <?php $brands = array('All', 'Honda', 'Suzuki', 'Yamaha') ?>
                            @else
                            <?php $brands = array('All', 'Honda', 'Suzuki', 'Toyota', 'Daihatsu', 'Nissan') ?>
                            @endif
                            <select name="brand" class="focus:ring focus:ring-lilac-200 focus:ring-opacity-50 block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($brands as $brandItem)    
                                <option value="{{ $brandItem }}" {{ $brand == $brandItem ? 'selected' : '' }} >{{ $brandItem }}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block tracking-wide font-bold mb-2" for="transmission">
                            Transmision
                        </label>
                        <div class="inline-block w-32">
                            <?php $transmissions = array('All', 'Manual', 'Automatic') ?>
                            <select name="transmission" class="focus:ring focus:ring-lilac-200 focus:ring-opacity-50 block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($transmissions as $transmissionItem)
                                <option value="{{ $transmissionItem }}" {{ $transmission == $transmissionItem ? 'selected' : '' }}>{{ $transmissionItem }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <x-button filled="true">Apply Filter</x-button>
                    </div>
                </div>
            </form>
        </div>
        @if(count($vehicles) == 0)
        <div class="h-96 mt-20 mb-32 flex justify-center items-center">
            <div class="flex flex-col items-center w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <p> Belum ada kendaraan yang sesuai </p>
                <a href="/find/{{ strtolower($type) }}">
                    <x-button filled="true">Kembali ke Pencarian</x-button>
                </a>
            </div>
        </div>
        @else
        <div class="flex flex-wrap flex-row justify-around mx-10 my-10">
            @foreach($vehicles as $vehicle)
            <a href="{{ '/rent/'.strtolower($type).'/'.$vehicle->id }}">
                <div class="w-80 p-8 rounded-lg overflow-hidden shadow-md h-full">
                    <div>
                        <img class="w-full h-40 object-cover shadow" src="{{ '/storage/images/'.$vehicle->photo }}" alt="">
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 text-center">{{ $vehicle->name }}</div>
                        <p class="text-sm text-center">
                            IDR {{ $vehicle->price }}/day
                        </p>
                    </div>
                    <div class="grid grid-rows-2 grid-flow-col justify-center gap-4">
                        <div class="flex gap-2">
                            <svg class="fill-current h-23 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31 23"><path d="M8.83334 0.833252V3.49992H12.8333V6.16659H8.83334L6.16668 8.83325V12.8333H3.50001V8.83325H0.833344V19.4999H3.50001V15.4999H6.16668V19.4999H10.1667L12.8333 22.1666H23.5V16.8333H26.1667V20.8333H30.1667V7.49992H26.1667V11.4999H23.5V6.16659H15.5V3.49992H19.5V0.833252H8.83334Z" fill="#7C7DDC"/></svg>
                            <p class="font-bold text-xs">{{ $vehicle->transmission }}</p>
                        </div>
                        <div class="flex gap-2.5">
                            <svg class="fill-current h-23 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 26"><path d="M0 0.166748H4C4.37333 0.166748 4.70667 0.313415 4.94667 0.553415L7.72 3.34008L8.78667 2.28675C9.33333 1.76675 10 1.50008 10.6667 1.50008H18.6667C19.3333 1.50008 20 1.76675 20.5467 2.28675L21.88 3.62008C22.4 4.16675 22.6667 4.83342 22.6667 5.50008V22.8334C22.6667 23.5407 22.3857 24.2189 21.8856 24.719C21.3855 25.2191 20.7072 25.5001 20 25.5001H6.66667C5.95942 25.5001 5.28115 25.2191 4.78105 24.719C4.28095 24.2189 4 23.5407 4 22.8334V8.16675C4 7.50008 4.26667 6.83342 4.78667 6.28675L5.84 5.22008L3.45333 2.83341H0V0.166748ZM10.6667 4.16675V6.83342H18.6667V4.16675H10.6667ZM11.2133 12.1667L8.54667 9.50008H6.66667V11.3801L9.33333 14.0467V18.2867L6.66667 20.9534V22.8334H8.54667L11.2133 20.1667H15.4533L18.12 22.8334H20V20.9534L17.3333 18.2867V14.0467L20 11.3801V9.50008H18.12L15.4533 12.1667H11.2133ZM12 14.8334H14.6667V17.5001H12V14.8334Z" fill="#7C7DDC"/></svg>
                            <p class="font-bold text-xs">{{ $vehicle->fuel }}</p>
                        </div>
                        <div class="flex gap-2">
                            <svg class="fill-current h-23 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 32"><path d="M18.3938 9.19375C18.4625 9.61875 18.5 10.0563 18.5 10.4438C18.5 10.9438 18.4625 11.3812 18.3938 11.8062L19.7813 13.0437C20.2188 13.4375 20.4 14.0062 20.1688 14.6062C20.025 14.8812 19.8688 15.2625 19.6938 15.575L19.5 15.9125C19.2563 16.225 19.1063 16.525 18.8875 16.8188C18.5313 17.2938 17.9063 17.45 17.3438 17.2625L15.575 16.6812C14.9063 17.2375 14.1438 17.6812 13.3125 17.9937L12.8813 19.8062C12.8125 20.3875 12.3625 20.85 11.775 20.925C11.3563 20.975 10.9313 21 10.5 21C10.0688 21 9.64376 20.975 9.22501 20.925C8.63751 20.85 8.13126 20.3875 8.06251 19.8062L7.63126 17.9937C6.85626 17.6812 6.09376 17.2375 5.42189 16.6812L3.65814 17.2625C3.09626 17.45 2.47001 17.2938 2.11376 16.8188C1.89251 16.525 1.68626 16.2188 1.49626 15.9062L1.30751 15.575C1.13314 15.2625 0.974513 14.9375 0.832763 14.6062C0.601263 14.0062 0.778638 13.4375 1.22001 13.0437L2.60626 11.8062C2.53626 11.3812 2.44376 10.9438 2.44376 10.4438C2.44376 10.0563 2.53626 9.61875 2.60626 9.19375L1.22001 7.95625C0.778638 7.50625 0.601263 6.9375 0.832763 6.39375C0.974513 6.00625 1.13314 5.73688 1.30689 5.4225L1.49689 5.09438C1.68626 4.77875 1.89251 4.47375 2.11376 4.18062C2.47001 3.70875 3.09626 3.55188 3.65814 3.73688L5.42189 4.31812C6.09376 3.76562 6.85626 3.32063 7.63126 3.00938L8.06251 1.1925C8.13126 0.6125 8.63751 0.148125 9.22501 0.0769376C9.64807 0.0256246 10.0739 -6.80769e-05 10.5 1.35465e-07C10.9313 1.35465e-07 11.3563 0.0261251 11.775 0.0768751C12.3625 0.148125 12.8125 0.6125 12.8813 1.1925L13.3125 3.00938C14.1438 3.32063 14.9063 3.76562 15.575 4.31812L17.3438 3.73688C17.9063 3.55188 18.5313 3.70875 18.8875 4.18062C19.1063 4.4725 19.2563 4.77625 19.5 5.09L19.6938 5.42688C19.8688 5.74 20.025 6.0625 20.1688 6.39375C20.4 6.9375 20.2188 7.50625 19.7813 7.95625L18.3938 9.19375ZM10.5 7.44375C8.84376 7.44375 7.50001 8.84375 7.50001 10.4438C7.50001 12.1562 8.84376 13.4438 10.5 13.4438C12.1563 13.4438 13.5 12.1562 13.5 10.4438C13.5 8.84375 12.1563 7.44375 10.5 7.44375ZM30.8063 29.3937C30.3813 29.4625 29.9438 29.5 29.5 29.5C29.0563 29.5 28.6188 29.4625 28.1938 29.3937L26.9563 30.7812C26.5063 31.2188 25.9375 31.4 25.3938 31.1688C25.0625 31.025 24.7375 30.8687 24.425 30.6938L24.0875 30.5C23.775 30.2563 23.475 30.1063 23.1813 29.8875C22.7063 29.5312 22.55 28.9062 22.7375 28.3438L23.3188 26.575C22.7625 25.9062 22.3188 25.1437 22.0063 24.3125L20.1938 23.8813C19.6125 23.8125 19.15 23.3625 19.075 22.775C19.025 22.3562 19 21.9312 19 21.5C19 21.0688 19.025 20.6438 19.075 20.225C19.15 19.6375 19.6125 19.1313 20.1938 19.0625L22.0063 18.6313C22.3188 17.8563 22.7625 17.0938 23.3188 16.425L22.7375 14.6562C22.55 14.0938 22.7063 13.4688 23.1813 13.1125C23.475 12.8938 23.7813 12.6312 24.0938 12.4937L24.425 12.3062C24.7375 12.1312 25.0063 11.975 25.3938 11.8313C25.9375 11.6 26.5063 11.7812 26.9563 12.2188L28.1938 13.6062C28.6188 13.5375 29.0563 13.5 29.5 13.5C29.9438 13.5 30.3813 13.5375 30.8063 13.6062L32.0438 12.2188C32.4375 11.7812 33.0063 11.6 33.6063 11.8313C33.9375 11.975 34.2625 12.1312 34.575 12.3062L34.9063 12.4937C35.2188 12.6312 35.525 12.8938 35.8188 13.1125C36.2938 13.4688 36.45 14.0938 36.2625 14.6562L35.6813 16.425C36.2375 17.0938 36.6813 17.8563 36.9938 18.6313L38.8063 19.0625C39.3875 19.1313 39.85 19.6375 39.925 20.225C39.975 20.6438 40 21.0688 40 21.5C40 21.9312 39.975 22.3562 39.925 22.775C39.85 23.3625 39.3875 23.8125 38.8063 23.8813L36.9938 24.3125C36.6813 25.1437 36.2375 25.9062 35.6813 26.575L36.2625 28.3438C36.45 28.9062 36.2938 29.5312 35.8188 29.8875C35.525 30.1063 35.225 30.2563 34.9125 30.5L34.575 30.6938C34.2625 30.8687 33.8813 31.025 33.6063 31.1688C33.0063 31.4 32.4375 31.2188 32.0438 30.7812L30.8063 29.3937ZM32.5 21.5C32.5 19.8438 31.1563 18.5 29.5 18.5C27.8438 18.5 26.5 19.8438 26.5 21.5C26.5 23.1562 27.8438 24.5 29.5 24.5C31.1563 24.5 32.5 23.1562 32.5 21.5Z" fill="#7C7DDC"/></svg>
                            <p class="font-bold text-xs">{{ $vehicle->cc }}cc</p>
                        </div>
                        <div class="flex gap-2">
                            <svg class="fill-current h-23 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31 23"><path d="M12.4875 0C5.5875 0 0 5.6 0 12.5C0 19.4 5.5875 25 12.4875 25C19.4 25 25 19.4 25 12.5C25 5.6 19.4 0 12.4875 0ZM16.6125 18.3875L11.25 13.0125V6.25H13.75V11.9875L18.3875 16.625L16.6125 18.3875Z" fill="#7C7DDC"/></svg>
                            <p class="font-bold text-xs">{{ $vehicle->year }}</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </x-base-body>
</x-base-layout>
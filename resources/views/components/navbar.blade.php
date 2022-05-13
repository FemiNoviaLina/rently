<div class="fixed mt-0 top-0 inset-x-0 bg-white">
    <div class="w-screen h-1 bg-lilac-100"></div>
    <div class="navbar flex justify-between">
        <a href="{{ url('/') }}"><div class="navbar-logo basis-1/4 text-lilac-100">Rent.ly</div></a>
        <div class="basis-3/4 flex justify-between sm:max-h-0 md:max-h-0 bg-white" id="menu-list">
            <div class="navbar-links flex p-3 m-3">
                @guest
                <?php $values = array('Rent' => 'rent', 'Guide' => 'guide', 'Help' => 'help', 'About' => 'about'); ?>
                @endguest
                @auth
                    @if(auth()->user()->hasRole('user'))
                    <?php $values = array('Rent' => 'rent', 'My order' => 'me/order', 'Guide' => 'guide', 'Help' => 'help', 'About' => 'about'); ?>
                    @else
                    <?php $values = array('Order' => 'dashboard/orders', 'Product' => 'dashboard/vehicles', 'Customer' => 'dashboard/customers') ?>
                    @endif 
                @endauth
                @foreach($values as $key => $value)
                    <a href="{{ $isRent($key) ? '' : url($value) }}">
                        <div id="{{ $isRent($key) ? 'rent-button' : '' }}" class="relative navbar-option mx-6 whitespace-nowrap {{ Auth::check() ? 'w-24' : 'w-20' }}">
                            <p class="inline-block w-8 px-2 text-center {{ $isSelected($key) ? 'font-bold' : '' }}"> {{ $key }} </p>
                                @if($isRent($key)) 
                                    <img src="{{ asset('images/down-arrow.svg') }}" class="inline-block w-5 ml-3 pl-1">
                                    <div id="rent-menu" class="rent-menu z-10 hidden absolute w-40 font-normal bg-white">
                                        <div class="rent-menu-option px-2 py-1 bg-gray hover:bg-lilac-100 hover:text-white">
                                            Rent Car
                                        </div>
                                        <div class="rent-menu-option px-2 py-1 bg-gray hover:bg-lilac-100 hover:text-white">
                                            Rent Motorcycle
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </a>
                @endforeach
                </div>
            <div class="cta-button m-2 flex flex-nowrap content-center">
                @guest
                <a href="{{ url('/login') }}">
                    <x-button filled=true> {{ __('Login') }}</x-button>
                </a>
                <a href="{{ url('/register') }}">
                    <x-button> {{ __('Register') }}</x-button>
                </a>
                @endguest
                @auth
                <a href="{{ '/me/profile' }}"><div class="mx-2 my-1 border border-black px-2 py-1 rounded-lg w-20 h-11 text-ellipsis overflow-hidden">
                    @if(auth()->user()->hasRole('admin'))
                    <p class="text-xs">Admin</p>
                    @else
                    <p class="text-xs">Customer</p>
                    @endif
                    <p class="text-sm font-bold text-lilac-100">{{ auth()->user()->name }}</p>
                </div></a>
                <form action="{{ url('/logout') }}" method="post">
                    @csrf
                    <x-button filled=true> {{ __('Logout') }}</x-button>
                </form>
                @endauth
            </div>
        </div>
        <div class="lg:hidden sm:inline md:inline m-3 cursor-pointer" id="menu-toggle">
            <div class="w-8 h-0.5 bg-lilac-100 block m-2"></div>
            <div class="w-8 h-0.5 bg-lilac-100 block m-2"></div>
            <div class="w-8 h-0.5 bg-lilac-100 block m-2"></div>
        </div>
    </div>
    <script src="{{ asset('js/navbar_script.js') }}"></script>
</div>
<nav class="menu menu__main">
    <a class="logo" href="/">Go Home</a>
    <ul class="menu__list">

        @foreach ($navbarItems as $item)
            <x-layout.navbar-item class="{{ $item['class'] ?? '' }}" :href="$item['href']">{{ $item['label'] }}</x-layout.navbar-item>
        @endforeach

        @guest
            <x-layout.navbar-item :href="route('login')">
                Войти
            </x-layout.navbar-item>
            <x-layout.navbar-item :href="route('register')">
                Регистрация
            </x-layout.navbar-item>
        @endguest

        <x-layout.navbar-item
            :href="route('cart.list')" 
            class="cart__link" 
            id="cart-link" 
            >
            <span class="cart__icon"></span>
            <div class="cart__header-total">
                <span class="cart__header-price"></span>
                <span>₽</span>
            </div>
        </x-layout.navbar-item>

        @auth
            <x-layout.navbar-item :href="route('account', ['user' => auth()->user()])" class="account__icon">
                <img src="{{ auth()->user()->image ?? '/storage/images/assets/icons/user-icon.svg' }}">
            </x-layout.navbar-item>
        @endauth

    </ul>

    <div class="menu__mobile">
        <x-layout.navbar-hamburger></x-layout.navbar-hamburger>
        <span>Menu</span>
    </div>
</nav>

<!-- Nav -->
<nav class="menu menu__main--mobile">
    <div class="close-menu" @click.stop="toggleMenu = false"></div>
    <ul class="menu__list menu__list--mobile">
        @foreach ($navbarItems as $item)
        <x-layout.navbar-item class="menu__item--mobile" :href="$item['href']">{{ $item['label'] }}</x-layout.navbar-item>
        @endforeach
    </ul>
</nav>
<header class="container">
    <hgroup>
        <h1>Sportswear</h1>
        <p>Admin Panel</p>
    </hgroup>
    <nav>
        <ul>
            <li><a href="{{ route('admin.account') }}">Account</a></li>
            <li><a href="{{ route('admin.reports') }}">Stock Reports</a></li>
            @if(Auth::check())
                <li><a href="{{ route('admin.products.index') }}" class="btn btn-primary">Manage Products</a></li>
                <li><a href="{{ route('admin.manage-users') }}">Manage Users</a></li>
                <li><a href="{{ route('admin.discounts') }}">Create a Discount</a></li>
            @endif
            <li><a href="{{ route('admin.messages') }}">User messages</a></li>
        </ul>
        <!-- dont need to question why this button became a form, it was necessary -->
        <form action="{{ Auth::check() ? route('logout') : '/login/admin' }}" method="GET">
            <ul>
                <li><button onclick="this.form.submit()" class="secondary">
                    {{ Auth::check() ? 'Sign out' : 'Login' }}
                </button></li>
            </ul>
        </form>

    </nav>
</header>

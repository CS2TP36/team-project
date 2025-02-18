@use(Illuminate\Support\Facades\Auth)
<header class="container">
    <hgroup>
        <h1>Sportswear</h1>
        <p>Admin Panel</p>
    </hgroup>
    <nav>
        <ul>
            <li><a href="{{ route('admin.account') }}">Account</a></li>
            <li><a href="#">Manage Products</a></li>
            <li><a href="{{ route('admin.reports') }}">Stock Reports</a></li>
            @if(Auth::check())
            <li><a href="#">Manage Users</a></li>
            @endif
            <li><a href="#">User messages</a></li>
        </ul>
        <!-- dont need to question why this button became a form, it was necessary -->
        <form action="@if(!Auth::check())/login/admin" @else{{ route("logout") }}" method="GET"@endif>
            <ul>
                <li><button onclick="this.form.submit()" class="secondary">@if(Auth::check()) Sign out @else Login @endif</button></li>
            </ul>
        </form>
    </nav>
</header>

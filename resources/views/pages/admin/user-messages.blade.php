@extends("layouts.admin")
@section("title","Messages")
@section("content")
    <h3>Messages</h3>
    <br>
    @if($pages == 0)
        <p>No messages</p>
    @endif
    @foreach($contactItems as $contactItem)
        <article style="align-content: center; text-align: center; justify-items: center; justify-content: center; align-items: center">
            <h4>{{ $contactItem->name }}</h4>
            <div role="group">
                <p style="margin-right: 5px"><a href="mailto:{{ $contactItem->email }}">{{ $contactItem->email }}</a></p>
                <p style="margin-left: 5px">{{ $contactItem->phone }}</p>
            </div>
            <p>{{ $contactItem->message }}</p>

        </article>
    @endforeach
    <nav>
        <ul>
            <li>
                <small>Pages: </small>
            </li>
            @for($i = 1; $i <= $pages; $i++)
                <li>
                    <!-- dont show link for current page -->
                    <small>@if ($i == $page) {{ $i }} @else <a href="/admin/messages/{{ $i }}">{{ $i }}</a>@endif</small>
                </li>
            @endfor
        </ul>
    </nav>
@endsection

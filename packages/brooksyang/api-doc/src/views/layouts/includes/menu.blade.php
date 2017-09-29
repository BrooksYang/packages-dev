<aside class="menu">
    <p class="menu-label">
        Api Modules
    </p>
    <ul class="menu-list">
        <li>
            <a href="{{ url("api/docs") }}" class="{{ Request::path() == 'api/docs' ? 'is-active' : '' }}">
                全部 ({{ $total }})
            </a>
        </li>

        @foreach ($modules as $module)
            <li>
                <a href="{{ url("api/docs/$module") }}"
                   class="{{ Request::route()->parameter('module') == $module ? 'is-active' : '' }}">
                    {{ $module }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>

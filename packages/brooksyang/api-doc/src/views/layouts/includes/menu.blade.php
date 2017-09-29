<aside class="menu">
    <p class="menu-label">
        Api Modules
    </p>
    <ul class="menu-list">
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

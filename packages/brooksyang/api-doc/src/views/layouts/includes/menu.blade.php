<aside class="menu">
    <p class="menu-label">
        Api Modules
    </p>
    <ul class="menu-list">
        @foreach ($modules as $module)
            <li>
                <a class="{{ Request::get('uri') == $module ? 'is-active' : '' }}">
                    {{ $module }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>

<a href="/">
    @if ( settings('appDarkLogo') )
        <img src="{{ settings('appDarkLogo') }}" alt="{{ settings('appName') ?? config('app.name') }}" style="height: 120px">
    @else
        {{ settings('appName') ?? config('app.name') }}
    @endif
</a>
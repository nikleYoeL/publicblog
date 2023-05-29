<form {{ $attributes->merge(['method' => 'POST', 'class' => 'flex flex-col p-3 mx-auto bg-white']) }}>
    @csrf
    {{ $slot }}
</form>
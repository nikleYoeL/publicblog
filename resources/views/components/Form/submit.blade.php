<button {{ $attributes->merge(['type' => 'submit', 'class' => 'mx-auto my-3 px-3 py-1 text-white bg-slate-800 hover:bg-sky-900']) }}>
    {{ $slot }}
</button>
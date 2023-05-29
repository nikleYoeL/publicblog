<header {{ $attributes->class(['sticky top-0 z-10 mb-1 p-2 xl:px-0 bg-slate-900 text-white shadow'])->merge(['']) }}>
    <div class="container mx-auto">
        <div class="flex flex-row justify-between items-center xl:w-2/3 xl:mx-auto">
            {{ $slot }}
        </div>
    </div>
</header>
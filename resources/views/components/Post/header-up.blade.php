<div {{ $attributes->class(['flex', 'flex-row', 'justify-between', 'items-center', 'w-full', 'bg-slate-900'])->merge(['']) }}>
    <h1 class="p-3 text-3xl text-white font-bold">{{ $post->title }}</h1>
    {{ $slot }}
</div>

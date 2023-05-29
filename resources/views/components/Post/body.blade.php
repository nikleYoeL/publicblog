<p {{ $attributes->class(['text-xl'])->merge(['']) }}>
    {!! nl2br($post->body) !!}
</p>
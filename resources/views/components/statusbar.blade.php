@if (session('status'))
    <div class="sticky w-full xl:w-2/3  px-3 py-1.5 mb-1 mx-auto text-green-700 bg-green-500/20">{{ session('status') }}</div>
@endif
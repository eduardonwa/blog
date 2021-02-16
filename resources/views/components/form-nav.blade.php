<div class="m-8 h-34 flex flex-col items-center text-center">
    
    <a href="/dashboard">
        <img class="w-80 h-34 mb-8 pb-8" 
            src="/img/logo.png" 
            alt="eduardocoello-logo" />
    </a>

    <div class="flex">
        <a href="/dashboard/{{ $type === 'posts' ? 'posts' : 'categories' }}"
            class="text-md no-underline hover:underline"> 
            <h1 class="text-yellow-200"> {{ $prevSection ?? 'Back'}} </h1> 
        </a>
    </div>

</div>
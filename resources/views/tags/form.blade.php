@csrf

    <div class="flex items-start pt-8">
        <div class="flex flex-col">
            <span class="block text-base pb-3 font-medium text-white-700 text-center pb-4"> 
                Name 
            </span>

            <input
                class="pl-2 rounded-md h-12 border focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent bg-transparent @error('name')is-danger @enderror"
                type="text"
                name="name"
                required
                value="{{ old('name') ?? $tag->name }}"
            >

            @error('name')
                <p class="is-danger">
                    {{ $errors->first('name') }}
                </p>
            @enderror 

            <div class="flex items-center justify-center">
                <button class="submit-btn">
                    {{ $submitButtonText ?? 'Create' }}
                </button>  
            </div>

        </div>
    </div>
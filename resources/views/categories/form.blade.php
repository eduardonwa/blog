@csrf

    <div class="flex items-start pt-8">                
        <div class="flex flex-col">
            <span class="pr-4 pb-4"> 
                Name 
            </span>

            <input
                class="text-black pl-2 rounded-sm @error('name')is-danger @enderror"
                type="text"
                name="name"
                value="{{ old('name') ?? $category->name }}"
            >
            
            @error('name')
                <p class="is-danger">
                    {{ $errors->first('name') }}
                </p>
            @enderror  
            
            <div class="pt-4">
                <label class="block text-base font-medium text-white-700 pb-4">
                    Image
                </label>
    
                @if($category->image_url == true)
                    <img src="{{ asset('/storage/img/category/'.$category->image_url) }}" 
                        class="w-52 bg-gray-900 rounded-md" 
                        alt="categoryicon"/>
                @endif
                
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 
                                border-2 border-gray-300 border-dashed rounded-md">
                        
                        <div class="space-y-1 text-center">
                            
                            <svg class="mx-auto h-12 w-12 text-gray-400" 
                                    stroke="currentColor" 
                                    fill="none" 
                                    viewBox="0 0 48 48" 
                                    aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                    
                            <div class="flex flex-col text-sm">  
                                <label for="file-upload" 
                                        class="relative cursor-pointer 
                                                bg-green-400 rounded-md font-medium">
                                                
                                    <span style="color:black;">Upload a file</span>
                                    <input 
                                        id="file-upload" 
                                        name="icon" 
                                        type="file" 
                                        class="@error('icon')is-danger @enderror sr-only"
                                    >
                                </label>

                                <p class="pt-3" style="color: gainsboro;">
                                    or drag and drop
                                </p>
                                @error('icon')
                                    <p class="is-danger">
                                        {{ $errors->first('icon') }}
                                    </p>
                                @enderror
                            </div>  
                        </div>
                    </div>
            </div> <!-- image end -->

            <div class="flex items-center justify-center">
                <button class="submit-btn">
                    {{ $submitButtonText ?? 'Create' }}
                </button>  

            </div>
        </div>            
    </div>
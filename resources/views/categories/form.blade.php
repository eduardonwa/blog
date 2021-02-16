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
                value="{{ old('name') ?? $category->name }}"
            >
            
            @error('name')
                <p class="is-danger">
                    {{ $errors->first('name') }}
                </p>
            @enderror  
            
            <div class="pt-4">
                <label class="block text-base pb-3 font-medium text-white-700 text-center pb-4">
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
                            <div class="flex flex-col text-sm">  
                                <label for="file-upload" 
                                        class="relative cursor-pointer rounded-md font-medium">
                                                
                                    <span class="pb-2">Upload a file</span>

                                    <input 
                                        id="file-upload" 
                                        name="icon" 
                                        type="file" 
                                        class="@error('icon')is-danger @enderror sr-only">
                                        <img src="/img/search-img-gray.png" id="preview" class="w-24"/>
                                </label>
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

    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file-upload").change(function(){
            readURL(this);
        });
    </script>
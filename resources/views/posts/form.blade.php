    @csrf

    <a href="#post-details" class="transform hover:scale-110 motion-reduce:transform-none absolute top-0 right-0 m-8"> <span><i class="fas fa-share-square"></i> </span> Post details</a>

        <div data-validate="Title is required" id="title-field" class="p-8 flex items-center justify-center">
            <input 
                class="focus:ring-2 focus:ring-blue-600 rounded-sm h-14 text-4xl bg-transparent @error('title')is-danger @enderror title-field"
                type="text"
                name="title"
                placeholder="Title"
                value="{{ old('title') ?? $post->title}}">
                @error('title')
            <p class="is-danger">
                {{ $errors->first('title') }}
            </p>@enderror
        </div> <!-- Title field -->

        <div data-validate="Body is required" id="body-field" class="mb-8 mt-8">
            <textarea 
                class="@error('body')is-danger @enderror" 
                rows="30" 
                cols="50" 
                name="body" 
                class="tinyMCE" 
                id="bodyArea" 
                placeholder="Write something amazing">{{ old('body') ?? $post->body }}</textarea>
                @error('body')
            <p class="is-danger">
                {{ $errors->first('body') }}
            </p>@enderror
        </div> <!-- Message body field --> 

        <div id="post-details" class="raro grid grid-cols-1 flex items-center justify-center pt-4"> <!-- overlay -->
            <div class="ventana"> <!-- modal -->
                <a href="#" class="flex justify-end text-2xl font-bold">&times;</a>
                
                    <div class="slug" 
                        data-validate="Slug is required">

                        <label class="block text-base pb-3 font-medium text-white-700">
                            Slug
                        </label>

                        <input 
                            class="h-12 pl-2 rounded-md h-12 border focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent bg-transparent @error('slug')is-danger @enderror"
                            type="text"
                            name="slug"
                            placeholder="Slug"
                            value="{{ old('slug') ?? $post->slug }}">
                            
                            @error('slug')
                                <p class="is-danger">
                                    {{ $errors->first('slug') }}
                                </p>
                            @enderror
                    </div> <!-- Slug field end -->

                    <div class="tags" 
                        data-validate="Tags are required">

                        <label class="block text-base pb-3 font-medium text-white-700">
                            Tags
                        </label>

                        <select name="tags[]" 
                                multiple
                                class="text-white rounded-sm text-black text-base border 
                                        focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent 
                                        bg-transparent cursor-pointer focus:outline-none focus:ring focus:border-blue-300">
                            @foreach($tags as $tag)
                                <option 
                                    value="{{ $tag->id }}"
                                    {{ $post->tags()->pluck('tags.id')->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('tags')
                            <p class="is-danger"> {{ $message }} </p>
                        @enderror
                    </div> <!-- Tag field end -->

                    <div class="category" 
                        data-validate="Category is required">

                        <label class="block text-base pb-3 font-medium text-white-700">
                            Category
                        </label>

                        <select
                            name="category_id"
                            required
                            class="rounded-sm pl-2 border text-black text-base appearance-none bg-transparent h-12 text-white
                                    text-white-700focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent
                                    cursor-pointer focus:outline-none focus:ring focus:border-blue-300">
                            @foreach($categories as $category)
                                <option 
                                    value="{{ $category->id }}"
                                    class="text-white-700"
                                    {{ $category->id == $post->category_id ? 'selected' : ''}}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select> 

                        @error('category')
                            <p class="is-danger"> {{ $message }} </p>
                        @enderror
                    </div> <!-- Category field end -->

                    <div class="post-img">
                        <label class="block text-base font-medium text-white-700 text-center pb-4">
                            Upload image
                        </label>

                        @if($post->image_url == true)
                        <img src="https://blog-img.s3.us-east-2.amazonaws.com/images/{{ $post->image_url }}" alt="postimage">
                        @endif
                        
                        <div class="mt-1 flex justify-center px-6
                                    border-2 border-gray-300 border-dashed rounded-md">

                            <div class="space-y-1 text-center">

                                <div class="flex flex-col text-sm">  

                                    <label for="file-upload" 
                                            class="relative cursor-pointer 
                                                    bg-green-400 rounded-md font-medium">
                                        
                                        <input 
                                            id="file-upload" 
                                            name="image" 
                                            type="file" 
                                            class="@error('image')is-danger @enderror sr-only">

                                            <img src="/img/search-img.png" id="preview" class="w-32"/>
                                    </label>

                                </div>  
                            </div>
                        </div>

                        @error('image')
                            <p class="is-danger"> {{ $message }} </p>
                        @enderror
                    </div> <!-- Image field end -->

                    <div class="flex items-center w-48 p-3"
                        style="border-bottom: 1px solid white; width: 100%;"
                        data-validate="Status is required">

                            <label for="approved" class="block text-base text-center font-medium text-white-700">
                                Publish Now
                            </label>
                        
                        <input type="checkbox"
                                name="status"
                                id="approved"
                                value="1" 
                                {{($post->is_approved || old('is_approved', 0) === 1 ? 'checked' : '')}}>
                    </div> <!-- Status end -->

                    <div class="submit">
                        <button class="submit-btn">
                            {{ $submitButtonText ?? 'Create Post' }}
                        </button>
                    </div> <!-- Submit button -->
            </div>
        </div> <!-- Slug, Tags, Image, Category & submit button end -->
    
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
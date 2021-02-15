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

                        <label class="block text-base pb-3
                                        font-medium text-white-700">
                            Slug
                        </label>

                        <input 
                            class="rounded-sm pl-2 text-black text-base @error('slug')is-danger @enderror"
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

                        <label class="block text-base pb-3
                                    font-medium text-white-700">
                            Tags
                        </label>    

                        <select name="tags[]" 
                                multiple
                                class="rounded-sm text-black text-base 
                                    cursor-pointer focus:outline-none focus:ring focus:border-blue-300">
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

                        <label class="block text-base pb-3
                                    font-medium text-white-700">
                            Category
                        </label>

                        <select
                            name="category_id"
                            required
                            class="rounded-sm pl-2 text-black text-base appearance-none 
                                    cursor-pointer focus:outline-none focus:ring focus:border-blue-300">
                            @foreach($categories as $category)
                                <option 
                                    value="{{ $category->id }}"
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
                            Image
                        </label>

                        @if($post->image_url == true)
                            <img class="rounded-md shadow-2xl" src="{{ asset('/storage/img/post_uploads/'.$post->image_url) }}" alt="postimage"/> 
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
                                            name="image" 
                                            type="file" 
                                            class="@error('image')is-danger @enderror sr-only">
                                    </label>
                                        <p class="pt-3" style="color: gainsboro;">
                                            or drag and drop
                                        </p>
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

                            <label for="approved" 
                                    class="block text-base text-center font-medium text-white-700">
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

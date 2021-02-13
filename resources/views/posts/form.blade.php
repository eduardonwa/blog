    @csrf
        <div data-validate="Title is required" id="title-field">
            <span> Title </span>
            <input 
                class="@error('title')is-danger @enderror title-field"
                type="text"
                name="title"
                placeholder="Title"
                value="{{ old('title') ?? $post->title}}">
                @error('title')
            <p class="is-danger">
                {{ $errors->first('title') }}
            </p>@enderror
        </div> <!-- Title field -->

        <div data-validate="Body is required" id="body-field">
            <span> Body </span>
            <textarea 
                class="@error('body')is-danger @enderror" 
                rows="30" 
                cols="50" 
                name="body" 
                class="tinyMCE" 
                id="bodyArea" 
                placeholder="Write something awesome">{{ old('body') ?? $post->body }}</textarea>
                @error('body')
            <p class="is-danger">
                {{ $errors->first('body') }}
            </p>@enderror
        </div> <!-- Message body field --> 

    <section id="post-details">

        <div 
            data-validate="Slug is required">
            <span> Slug </span>
            <input 
                class="@error('slug')is-danger @enderror"
                type="text"
                name="slug"
                placeholder="Slug"
                value="{{ old('slug') ?? $post->slug }}">
                
                @error('slug')
                <p class="is-danger">
                    {{ $errors->first('slug') }}
                </p>@enderror
        </div> <!-- Slug field end -->

        <div class="tags" 
            data-validate="Tags are required">

            <span> Tags </span>        
            <select name="tags[]" 
                multiple>
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

            <span> Category </span>
            <select
                name="category_id"
                required>
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
            <span> Image </span>
            <input
                type="file" 
                name="image">

            @if($post->image_url == true)
                <img src="{{ asset('/storage/img/post_uploads/'.$post->image_url) }}" alt="postimage"/> 
            @endif

            @error('image')
                <p class="is-danger"> {{ $message }} </p>
            @enderror
        </div> <!-- Image field end -->

        <div class="status" 
            data-validate="Status is required">
            <span> Status </span>

            <label for="approved">
                Publish Now
            </label>
            
            <input type="checkbox"
                    name="status"
                    id="approved"
                    value="1" 
                    {{($post->is_approved || old('is_approved', 0) === 1 ? 'checked' : '')}}>
        </div>

        <div class="submit">
            <button class="submit-post">
                {{ $submitButtonText ?? 'Create Post' }}
            </button>
        </div> <!-- Submit button -->

    </section> <!-- Slug, Tags, Image, Category & submit button end -->

    <a id="back" href="/dashboard"> <h1> Back </h1> </a>
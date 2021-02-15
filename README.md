# Web developer

What does this mean? That even though I like to use Laravel I feel my strongest asset is the Front-End, right now im working on creating a _tight-modest_ blog for myself with the best "best practices" I can find so I can continue learning and start working on other projects.

# Recent changes

Watch a preview video https://imgur.com/bM7PlRz

I just committed a better and more "stylish" forms for my Posts. I used to have a 2 columns composition, where I would have 1 column of _1fr_ dedicated to the ```textarea``` or the body of the post, and the other column with the size of **233px** to have the details of said post, so things like category, tags, slug, etc all of that would've been there.

Happy to say I took it to the next level... (yeah)

The page where I show the form to create/edit a post has the entire window dedicated to the body of the Post and by using a modal (CSS) im displaying and toggling a column to the right side of the screen to give me the details. Everything still looks very familiar to what I used to have, there were no Javascript or third party plug-ins adopted because im using a clever way.

## Clever way

```
.overlay {
    visibility: hidden;
}

.overlay:target {
    visibility: visible;
}
```

Though I am not using those class names exactly, that's basically it I am toggling this element using that property and then to give it justice and show the modal wherever I want it, and that means on top of the page like any other modal out there im using:

```
.window {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
```

Again it's not literal and im not using all of those properties, but that's the idea. For the body of the text I'm using a WYSIWYG text editor, TinyMCE which is highly customizable with lots of plugins one can keep adding.

# What im still working on

- Still inspecting the UI of the entire blog since Im just getting used to Tailwind most of the styling in this blog uses CSS so im in the middle of adopting this framework to design my webapp.
- Updating categories, title and image. Title does gets updated the image to delete the file and add a new instance of it, also, will keep an eye and avoid the issue many people have when doing this which is once they delete their old file sometimes when you don't submit an image to a new post the last image gets deleted, or something, I've yet to work on that. 

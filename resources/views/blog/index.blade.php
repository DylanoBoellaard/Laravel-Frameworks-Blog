<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    @vite(['resources/scss/blog/blog.index.scss', 'resources/css/blog.index.css'])
</head>

<body>
    <main>
        <h1>Blog Posts</h1>

        <!-- Display only if the user is logged in -->
        @auth
        <a href="{{ route('blog.create') }}">Create New Post</a>
        @endauth

        <div id="blogContainer">
            <!-- Display all posts -->
            @foreach ($posts as $post)
            <div class="blogPost">
                <h2 class="blogTitle">{{ $post->title }}</h2>
                <p class="blogMessage">{{ $post->message }}</p>
                <p>Posted by: {{ $post->user->name}}</p>

                <!-- Display comments -->
                <div class="comments">
                    <h3>Comments:</h3>
                    @foreach ($post->comments as $comment)
                    <p>{{ $comment->user->name }}: {{ $comment->content }}</p>
                    @endforeach

                    <!-- Add a form for adding comments -->
                    @auth
                    <form method="POST" action="{{ route('comment.store', $post) }}">
                        @csrf
                        <textarea name="content" rows="3" placeholder="Add a comment" required></textarea>
                        <button type="submit">Add Comment</button>
                    </form>
                    @endauth
                </div>

                <!-- Delete & Edit buttons -->
                <div class="edit-delete">
                    <!-- Display edit and delete buttons only if the authenticated user owns the post -->
                    @auth
                    @if(auth()->user()->id === $post->user_id)
                    <a href="{{ route('blog.edit', $post) }}">Edit</a>
                    <form method="POST" action="{{ route('blog.destroy', $post) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    @endif
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>

</html>
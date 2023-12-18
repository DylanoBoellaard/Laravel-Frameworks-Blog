<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Blog Post</h1>

    <form method="POST" action="{{ route('blog.update', $blogPost) }}">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
            <input type="text" name="title" value="{{ $blogPost->title }}" required>
        <br>
        <label for="message">Message:</label>
            <textarea name="message" rows="4" required>{{ $blogPost->message }}</textarea>
        <br>
        <button type="submit">Update Post</button>
    </form>

    <a href="{{ route('blog.index') }}">Back to Posts</a>

</body>
</html>
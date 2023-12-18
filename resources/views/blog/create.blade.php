<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create New Blog Post</h1>

    <form method="POST" action="{{ route('blog.store') }}">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <br>
        <label for="message">Message:</label>
        <textarea name="message" rows="4" required></textarea>
        <br>
        <button type="submit">Create Post</button>
    </form>

    <a href="{{ route('blog.index') }}">Back to Posts</a>

</body>
</html>
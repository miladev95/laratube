<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="video">
    <button type="submit">Upload</button>
</form>

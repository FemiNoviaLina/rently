<form action="/test-up" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" id="image">
    <input type="submit" value="submit">
</form>
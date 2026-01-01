<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="create-container">

    <a href="{{ route('admin.dashboard') }}" class="back-btn-top">⬅️ الرجوع للوحة التحكم</a>

    <h2>تعديل الكورس: {{ $course->title }}</h2>

    <form action="{{ route('tahseeli.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>عنوان الكورس:</label>
        <input type="text" name="title" value="{{ $course->title }}" required>

        <label>رابط فيديو اليوتيوب:</label>
        <input type="text" name="youtube_url" value="{{ $course->youtube_url }}" required>

        <label>الصورة الحالية:</label><br>
        @if($course->thumbnail)
            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="thumbnail" style="max-width:200px;">
        @else
            <p>لا توجد صورة.</p>
        @endif

        <br><br>

        <label>تغيير الصورة (اختياري):</label>
        <input type="file" name="thumbnail" accept="image/*">

        <label>الوصف:</label>
        <textarea name="description" rows="4" required>{{ $course->description }}</textarea>

        <button type="submit">حفظ التعديلات</button>
    </form>

</div>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="create-container">

    <a href="{{ route('admin.dashboard') }}" class="back-btn-top">⬅️ الرجوع للوحة التحكم</a>

    <h2>إضافة كورس جديد</h2>

    <form action="{{ route('qodrat.courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>عنوان الكورس:</label>
        <input type="text" name="title" required>

        <label>رابط فيديو اليوتيوب:</label>
        <input type="text" name="youtube_url" required>

        <label>الصورة المصغرة (الغلاف):</label>
        <input type="file" name="thumbnail" accept="image/*">

        <label>الوصف:</label>
        <textarea name="description" rows="4" required></textarea>

        <button type="submit">إضافة الكورس</button>
    </form>

</div>
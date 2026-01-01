<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="container">

    <h2>عرض الكورس: {{ $course->title }}</h2>

    {{-- الفيديو --}}
    @php
        $videoId = null;
        $url = $course->youtube_url;
        $queryString = parse_url($url, PHP_URL_QUERY);
        if ($queryString) {
            parse_str($queryString, $params);
            $videoId = $params['v'] ?? null;
        }
    @endphp

    @if($videoId)
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
        </div>
    @endif

    <p><strong>الوصف:</strong> {{ $course->description }}</p>

    <hr>

    <h3>إضافة سؤال جديد</h3>

    <form action="{{ route('tahseeli.quizzes.store', $course->id) }}" method="POST">
        @csrf

        <label>السؤال:</label>
        <input type="text" name="question" required>

        <label>الخيار A:</label>
        <input type="text" name="option_a" required>

        <label>الخيار B:</label>
        <input type="text" name="option_b" required>

        <label>الخيار C:</label>
        <input type="text" name="option_c" required>

        <label>الخيار D:</label>
        <input type="text" name="option_d" required>

        <label>الإجابة الصحيحة:</label>
        <select name="correct_answer" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>

        <button type="submit">إضافة السؤال</button>
    </form>

    <hr>

    <h3>الكويزات التابعة للكورس</h3>

    @if($course->quizzes->count() == 0)
        <p>لا يوجد كويزات بعد.</p>
    @else
        @foreach($course->quizzes as $quiz)
            <div class="quiz-item">
                <p>{{ $quiz->question }}</p>

                <form action="{{ route('tahseeli.quizzes.delete', $quiz->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn-danger">حذف</button>
                </form>
            </div>
        @endforeach
    @endif
<a href="{{ route('admin.dashboard') }}" class="back-btn">⬅️ الرجوع للوحة التحكم</a>
</div>
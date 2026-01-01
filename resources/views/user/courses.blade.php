<link rel="stylesheet" href="{{ asset('css/user.css') }}">
<a class="btn-back" href="{{ route('user.index', $type) }}">⬅ الرجوع</a>

<h2 class="courses-title">
    كورسات {{ $type == 'tahseeli' ? 'التحصيلي' : 'القدرات' }}
</h2>

<div class="courses-container">
    @foreach($courses as $course)
        <div class="course-card">
            
            {{-- الصورة المصغرة --}}
            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="course-thumb">
            
            <h3>{{ $course->title }}</h3>

            <a href="{{ route('user.show', [$type, $course->id]) }}" class="course-btn">
                مشاهدة
            </a>
        </div>
    @endforeach
</div>
<link rel="stylesheet" href="{{ asset('css/user.css') }}">

<a class="btn-back" href="{{ route('user.courses', $type) }}">⬅ الرجوع</a>

<h2 class="course-title">{{ $course->title }}</h2>

{{-- الفيديو --}}
<div class="video-container">
    <iframe
        src="https://www.youtube.com/embed/{{ $course->video_id }}"
        allowfullscreen>
    </iframe>
</div>

<h3 class="quiz-title">الاختبار</h3>

@foreach($course->quizzes as $quiz)
    <div class="quiz-block">
        <p class="quiz-question">{{ $quiz->question }}</p>

        <button class="quiz-option" onclick="selectAnswer(this, '{{ $quiz->correct_answer }}', 'A')">
            A) {{ $quiz->option_a }}
        </button>

        <button class="quiz-option" onclick="selectAnswer(this, '{{ $quiz->correct_answer }}', 'B')">
            B) {{ $quiz->option_b }}
        </button>

        <button class="quiz-option" onclick="selectAnswer(this, '{{ $quiz->correct_answer }}', 'C')">
            C) {{ $quiz->option_c }}
        </button>

        <button class="quiz-option" onclick="selectAnswer(this, '{{ $quiz->correct_answer }}', 'D')">
            D) {{ $quiz->option_d }}
        </button>

        <p class="correct-answer-text">
            الإجابة الصحيحة هي: {{ $quiz->correct_answer }}
        </p>
    </div>
@endforeach

<script>
function selectAnswer(btn, correct, chosen) {
    let parent = btn.parentElement;

    // منع اختيار أكثر من إجابة
    if (parent.classList.contains('answered')) return;

    parent.classList.add('answered');

    // مقارنة الإجابة
    if (chosen.trim() === correct.trim()) {
        btn.classList.add("correct");
    } else {
        btn.classList.add("wrong");

        // إظهار الإجابة الصحيحة
        let correctText = parent.querySelector('.correct-answer-text');
        correctText.style.display = "block";
    }
}
</script>
<h2>لوحة التحكم</h2>

<button onclick="showSection('tahseeli')">التحصيلي</button>
<button onclick="showSection('qodrat')">القدرات</button>

<hr>

<div id="tahseeli" style="display:none;">

    <h3>قسم التحصيلي</h3>

    <button onclick="showTahseeli('courses')">الكورسات</button>
    <button onclick="showTahseeli('quizzes')">الكويزات</button>


    <div id="tahseeli_courses" style="display:none;">
        <h4>كورسات التحصيلي</h4>

        <a href="{{ route('tahseeli.courses.create') }}">➕ إضافة كورس جديد</a>

        <ul>
            @foreach($tahseeliCourses as $course)
                <li>
                    {{ $course->title }}
                    <a href="{{ route('tahseeli.courses.show', $course->id) }}">عرض</a>
                    <a href="{{ route('tahseeli.courses.edit', $course->id) }}">تعديل</a>
                    <form action="{{ route('tahseeli.courses.delete', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button>حذف</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>


    <div id="tahseeli_quizzes" style="display:none;">
        <h4>كويزات التحصيلي</h4>

        @if(count($tahseeliCourses) == 0)
            <p>⚠️ لا يمكن إضافة كويزات بدون وجود كورس واحد على الأقل.</p>
        @else
            <p>اختر كورس لعرض كويزاته:</p>
            <ul>
                @foreach($tahseeliCourses as $course)
                    <li>
                        {{ $course->title }}
                        <a href="{{ route('tahseeli.quizzes.index', $course->id) }}">عرض الكويزات</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>


<div id="qodrat" style="display:none;">

    <h3>قسم القدرات</h3>

    <button onclick="showQodrat('courses')">الكورسات</button>
    <button onclick="showQodrat('quizzes')">الكويزات</button>


    <div id="qodrat_courses" style="display:none;">
        <h4>كورسات القدرات</h4>

        <a href="{{ route('qodrat.courses.create') }}">➕ إضافة كورس جديد</a>

        <ul>
            @foreach($qodratCourses as $course)
                <li>
                    {{ $course->title }}
                    <a href="{{ route('qodrat.courses.show', $course->id) }}">عرض</a>
                    <a href="{{ route('qodrat.courses.edit', $course->id) }}">تعديل</a>
                    <form action="{{ route('qodrat.courses.delete', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button>حذف</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>


    <div id="qodrat_quizzes" style="display:none;">
        <h4>كويزات القدرات</h4>

        @if(count($qodratCourses) == 0)
            <p>⚠️ لا يمكن إضافة كويزات بدون وجود كورس واحد على الأقل.</p>
        @else
            <p>اختر كورس لعرض كويزاته:</p>
            <ul>
                @foreach($qodratCourses as $course)
                    <li>
                        {{ $course->title }}
                        <a href="{{ route('qodrat.quizzes.index', $course->id) }}">عرض الكويزات</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>

<script>
function showSection(section) {
    document.getElementById('tahseeli').style.display = 'none';
    document.getElementById('qodrat').style.display = 'none';
    document.getElementById(section).style.display = 'block';
}

function showTahseeli(type) {
    document.getElementById('tahseeli_courses').style.display = 'none';
    document.getElementById('tahseeli_quizzes').style.display = 'none';
    document.getElementById('tahseeli_' + type).style.display = 'block';
}

function showQodrat(type) {
    document.getElementById('qodrat_courses').style.display = 'none';
    document.getElementById('qodrat_quizzes').style.display = 'none';
    document.getElementById('qodrat_' + type).style.display = 'block';
}
</script>




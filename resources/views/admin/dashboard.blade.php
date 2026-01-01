<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container">
    {{-- المرحلة 1: زرين في النص --}}
    <div id="main-buttons" class="center-buttons">
        <button class="big-btn" onclick="showSection('tahseeli')">📘 التحصيلي</button>
        <button class="big-btn" onclick="showSection('qodrat')">📗 القدرات</button>
    </div>

    {{-- المرحلة 2: كورسات التحصيلي --}}
    <div id="tahseeli-section" class="hidden">
        <h2 class="section-title">كورسات التحصيلي</h2>

        <a href="{{ route('tahseeli.courses.create') }}" class="add-btn">➕ إضافة كورس جديد</a>

        <ul class="course-list">
            @foreach($tahseeliCourses as $course)
                <li class="course-item" onclick="toggleTable('tahseeli-{{ $course->id }}')">
                    {{ $course->title }}
                </li>

                {{-- المرحلة 3: جدول التفاصيل --}}
                <table id="tahseeli-{{ $course->id }}" class="course-table hidden">

                    <tr class="single-row">
                        <td>
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="thumb">
                            @else
                                —
                            @endif
                        </td>

                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description ?? '—' }}</td>

                        <td><a href="{{ route('tahseeli.courses.show', $course->id) }}" class="btn-small">عرض</a></td>
                        <td><a href="{{ route('tahseeli.courses.edit', $course->id) }}" class="btn-small">تعديل</a></td>

                        <td>
                            <form action="{{ route('tahseeli.courses.delete', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger-small">حذف</button>
                            </form>
                        </td>
                    </tr>
                </table>
            @endforeach
        </ul>
    </div>

    {{-- المرحلة 2: كورسات القدرات --}}
    <div id="qodrat-section" class="hidden">
        <h2 class="section-title">كورسات القدرات</h2>

        <a href="{{ route('qodrat.courses.create') }}" class="add-btn">➕ إضافة كورس جديد</a>
        
        <ul class="course-list">
            @foreach($qodratCourses as $course)
                <li class="course-item" onclick="toggleTable('qodrat-{{ $course->id }}')">
                    {{ $course->title }}
                </li>

                <table id="qodrat-{{ $course->id }}" class="course-table hidden">
                    <tr class="single-row">
                        <td>
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="thumb">
                            @else
                                —
                            @endif
                        </td>

                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description ?? '—' }}</td>

                        <td><a href="{{ route('qodrat.courses.show', $course->id) }}" class="btn-small">عرض</a></td>
                        <td><a href="{{ route('qodrat.courses.edit', $course->id) }}" class="btn-small">تعديل</a></td>

                        <td>
                            <form action="{{ route('qodrat.courses.delete', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger-small">حذف</button>
                            </form>
                        </td>
                    </tr>
                </table>
            @endforeach
        </ul>
    </div>

</div>

<script>
    function showSection(section) {
        document.getElementById('main-buttons').style.display = 'none';
        document.getElementById(section + '-section').style.display = 'block';
    }

    function toggleTable(id) {
        const table = document.getElementById(id);
        table.classList.toggle('hidden');
    }
</script>
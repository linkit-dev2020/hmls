
 	<div id="side-section">

      <ul id="side">
        @if (Auth::user()->hasRole(0))
        <li><a href="{{route('users.indexmanager')}}">المشرفون <i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('users.indexteacher')}}">المعلمون<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('users.indexstudent')}}"> الطلاب<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('class.index')}}">التخصصات والصفوف<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('course.index') }}">الدورات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('subject.index')}}">المواد<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('unit.index')}}">الوحدات الدرسية<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('lesson.index')}}">الدروس<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <!-- <li><a href="{{route('classrequest.index')}}">إدارة طلبات الصفوف<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('courserequest.index')}}">إدارة طلبات الدورات<i class="fa fa-angle-double-left pull-left"></i></a></li>-->
        <li><a href="{{route('test.index')}}">الأختبارات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('attachment.index')}}">المرفقات<i class="fa fa-angle-double-left pull-left"></i></a></li>

        <li><a href="{{route('notes.index')}}">الملاحظات<i class="fa fa-angle-double-left pull-left"></i></a></li>

        @endif
        @if (Auth::user()->hasRole(1))
        <li><a href="{{route('users.indexteacher')}}">المعلمون<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('users.indexstudent')}}"> الطلاب<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('class.index')}}">الصفوف<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('course.index') }}">الدورات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('subject.index')}}">المواد<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('unit.index')}}">الوحدات الدرسية<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('lesson.index')}}">الدروس<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('classrequest.index')}}">إدارة طلبات الصفوف<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('courserequest.index')}}">إدارة طلبات الدورات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('test.index')}}">الأختبارات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('attachment.index')}}">المرفقات<i class="fa fa-angle-double-left pull-left"></i></a></li>

        <li><a href="{{route('notes.index')}}">الملاحظات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        @endif
        @if (Auth::user()->hasRole(2))
        <li><a href="{{route('subject.index')}}">المواد<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('course.index') }}">الدورات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('unit.index')}}">الوحدات الدرسية<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('lesson.index')}}">الدروس<i class="fa fa-angle-double-left pull-left"></i></a></li>
            <li><a href="{{route('test.index')}}">الأختبارات<i class="fa fa-angle-double-left pull-left"></i></a></li>
            <li><a href="{{route('attachment.index')}}">المرفقات<i class="fa fa-angle-double-left pull-left"></i></a></li>
        @endif
        @if (Auth::user()->hasRole(3))
        <li><a href="{{route('class.index')}}">الصفوف<i class="fa fa-angle-double-left pull-left"></i></a></li>
        <li><a href="{{route('course.index') }}">الدورات<i class="fa fa-angle-double-left pull-left"></i></a></li>

        <li><a href="{{route('class.myclasses') }}">صفوفي<i class="fa fa-angle-double-left pull-left"></i></a></li>
            <li><a href="{{route('course.mycourses') }}">دوراتي<i class="fa fa-angle-double-left pull-left"></i></a></li>
        @endif
      </ul>
    </div>


<div id="hornav" class="container no-padding">
    <div class="row">
        <div class="col-md-12 no-padding">
            <div class="pull-right visible-lg">

                <ul id="hornavmenu" class="nav navbar-nav">
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li>
                        <span class="">About</span>
                        <ul>
                            @php
                                $about = App\Models\Speech::all();
                            @endphp
                            @foreach ($about as $item)
                                <li>
                                    <a href="{{ route('speech.fullview',$item->id) }}">{{ $item->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>


                    <li>
                        <span class="">Authority</span>
                        <ul>
                            <li><a href="{{ route('teacher.list') }}">শিক্ষক-শিক্ষিকা</a></li>
                            <li><a href="{{ route('student.list') }}">ছাত্র-ছাত্রী</a></li>
                            {{-- <li><a href="stafflist.php?stfid=2">কর্মচারি</a></li>
                            <li><a href="stafflist.php?stfid=3">ম্যানেজমেন্ট</a></li>
                            <li><a href="stafflist.php?stfid=4">ভোকেশনাল</a></li> --}}
                        </ul>
                    </li>

                    <li>
                        <span class="">Facilities</span>
                        <ul>

                              @php
                                $facilities = App\Models\Facilities::all();
                            @endphp
                            @foreach ($facilities as $item)
                                <li>
                                    <a href="{{ route('facilities.fullview',$item->id) }}">{{ $item->title }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    <li>
                        <span class="">Campus</span>
                        <ul>
                            <li>
                                <a href="{{ route('recent.news.all') }}">Recent news</a>
                            </li>
                            <li>
                                <a href="{{ route('photo.gallery.all') }}">Photo gallery</a>
                            </li>
                            {{-- <li>
                                <a href="news_archive.php">Video gallery</a>
                            </li> --}}

                        </ul>
                    </li>
                    {{-- <li>
                        <span class="">Article</span>
                        <ul>
                            <li>
                                <a href="article_aut.php">Authority </a>
                            </li>
                            <li>
                                <a href="article_st.php">Student</a>
                            </li>
                        </ul>
                    </li> --}}

                    <li>
                        <span class="">Admission</span>
                        <ul>
                            <li>
                                <a href="#">Apply online</a>
                            </li>
                            <li>
                                <a href="#">Admit card</a>
                            </li>
                            <li>
                                <a href="#">Result of admission test</a>
                            </li>
                            <li class="parent">
                                <span>Question of admission test</span>
                                <ul>
                                    <li>
                                        <a href="#">Class 6</a>
                                    </li>
                                    <li>
                                        <a href="#">Class 8</a>
                                    </li>
                                    <li>
                                        <a href="#">Class 9</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="">Exam corner</span>
                        <ul>

                            <li><a href="result_query_by_roll.php">Search result</a></li>

                            <li>
                                <a href="exam_routine.php">Exam routine</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <span class="">Corner</span>
                        <ul>
                            <li>
                                <a href="{{ route('student.list') }}">Student corner</a>
                            </li>
                            <li>
                                <a href="{{ route('teacher.corners') }}">Teacher corner</a>
                            </li>
                            {{-- <li class="parent">
                                <span>Institute corner</span>
                                <ul>
                                    <li>
                                        <a href="teacher_corner.php">Teacher corner</a>
                                    </li>
                                    <li>
                                        <a href="empty_post.php">Empty post</a>
                                    </li>
                                    <li>
                                        <a href="created_post.php">Created post</a>
                                    </li>
                                </ul>
                            </li> --}}
                            <li>
                                <a href="guardian_corner.php">Guardian corner</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="">Archive</span>
                        <ul>
                            <li>
                                <a href="list_of_former_ins_chairman.php">List of chairman</a>
                            </li>
                            <li>
                                <a href="list_of_former_ins_head.php">List of ins. head</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="">Notice</span>
                        <ul>
                            <li>
                                <a href="{{ route('notice.important.all') }}">Importent notice</a>
                            </li>
                            <li>
                                <a href="{{ route('notice.general.all') }}">General notice</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.php" class="">Contact</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.login') }}" class="">Login</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
<style>


</style>


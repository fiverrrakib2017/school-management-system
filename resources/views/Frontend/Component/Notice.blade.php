<div class="col-md-3">
    <!-- Important Notices -->
    <div class="panel panel-danger wow fadeInRight" data-wow-duration="1.5s">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-bell"></i> জরুরি বিজ্ঞপ্তি</h3>
        </div>
        <div class="panel-body notice-box">
            <marquee direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">
                <ul class="notice-list">
                    @php
                        $impnotices = App\Models\Notice::where('notice_type', '2')
                                                       ->where('post_type', '1')
                                                       ->limit(5)
                                                       ->get();
                    @endphp
                    @foreach ($impnotices as $item)
                        @php
                            $filePath = asset('Backend/uploads/photos/' . $item->image);
                            $extension = strtolower(pathinfo($item->image, PATHINFO_EXTENSION));
                        @endphp
                        <li>
                            @if(in_array($extension, ['pdf']))
                                <a href="{{ $filePath }}" target="_blank">{{ $item->title }}</a>
                            @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img class="img-fluid" src="{{ $filePath }}" alt="file" style="max-width: 100px; max-height: 90px;">
                                <br>
                                <a href="{{ $filePath }}" target="_blank">{{ $item->title }}</a>
                            @else
                                <a href="{{ $filePath }}" target="_blank">{{ $item->title }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>

            </marquee>
        </div>
    </div>

    <!-- General Notices -->
    <div class="panel panel-info wow fadeInRight" data-wow-delay="0.5s">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> সাধারণ বিজ্ঞপ্তি</h3>
        </div>
        <div class="panel-body notice-box">
            <marquee direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">
                <ul class="notice-list">
                    @php
                        $impnotices = App\Models\Notice::where('notice_type', '1')
                                                       ->where('post_type', '1')
                                                       ->limit(5)
                                                       ->get();
                    @endphp
                    @foreach ($impnotices as $item)
                        @php
                            $filePath = asset('Backend/uploads/photos/' . $item->image);
                            $extension = strtolower(pathinfo($item->image, PATHINFO_EXTENSION));
                        @endphp
                        <li>
                            @if(in_array($extension, ['pdf']))
                                <a href="{{ $filePath }}" target="_blank">{{ $item->title }}</a>
                            @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img class="img-fluid" src="{{ $filePath }}" alt="file" style="max-width: 100px; max-height: 90px;">
                                <br>
                                <a href="{{ $filePath }}" target="_blank">{{ $item->title }}</a>
                            @else
                                <a href="{{ $filePath }}" target="_blank">{{ $item->title }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </marquee>

        </div>
    </div>
</div>
<style>

/* Notice Boxes */
.notice-box {
    max-height: 200px;
    overflow: hidden;
    padding: 10px;
    background: #fff;
    border-radius: 5px;
}

/* Notice List */
.notice-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.notice-list li {
    padding: 5px 0;
    border-bottom: 1px solid #ddd;
}

.notice-list li a {
    color: #333;
    font-weight: bold;
    text-decoration: none;
    display: block;
}

.notice-list li a:hover {
    color: #007bff;
}
/* Responsive Adjustments */
@media (max-width: 767px) {
    

    .notice-box {
        max-height: 150px;
    }

    .notice-list li {
        font-size: 14px;
    }
}
</style>

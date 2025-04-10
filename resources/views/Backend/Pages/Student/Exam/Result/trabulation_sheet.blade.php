@php
    $website_info = App\Models\Website_information::first();
@endphp

@extends('Backend.Layout.App')
@section('title', 'Student Tabulation Sheet')

@section('style')
    <style>
        .school-header {
            text-align: center;
            padding: 15px;
        }

        .school-header img {
            height: 80px;
            width: 80px;
            margin-bottom: 10px;
        }

        .school-header h2 {
            font-weight: 100;
            margin-bottom: 5px;
        }

        .school-header p {
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .tabulation-container {
            background: #fff;
            padding: 20px;
            /* border-radius: 10px; */
            border: 1px dotted #ccc;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            /* margin-top: 20px; */
        }

        /* .tabulation-container .card-header {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 15px;
            background-color: #f7f7f7;
            border-radius: 6px;
            padding: 15px;
        } */

        .tabulation-container .table th,
        .tabulation-container .table td {
            vertical-align: middle !important;
            text-align: center;
            border: 1px solid #000 !important;
            font-size: 14px;
            padding: 6px 8px;
        }

        .tabulation-container .table th {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        .print-btn {
            margin-bottom: 15px;
            float: right;
        }

        @media print {
            .print-btn {
                display: none;
            }

            body {
                background: #fff;
            }

            .tabulation-container {
                box-shadow: none;
                border: none;
            }

        }

        @media print {
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid black !important;
                padding: 5px;
                text-align: center;
            }

            @page {
                size: A4 landscape;
                margin: 20mm;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="row" id="search_box">
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="exam_id" class="form-label">Examination Name <span
                                        class="text-danger">*</span></label>
                                <select name="exam_id" id="exam_id" class="form-control" style="width: 100%;" required>
                                    <option value="">---Select---</option>
                                    @foreach (\App\Models\Student_exam::latest()->get() as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->name }}--{{ $exam->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-control" style="width: 100%;" required>
                                    <option value="">---Select---</option>
                                    @php
                                        $classes = \App\Models\Student_class::latest()->get();
                                    @endphp
                                    @if ($classes->isNotEmpty())
                                        @foreach ($classes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="section_id" class="form-label">Section <span
                                        class="text-danger">*</span></label>
                                <select name="section_id" id="section_id" class="form-control" style="width: 100%;"
                                    required>
                                    <option value="">---Select---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mt-3">
                                <button type="button" name="submit_btn" class="btn btn-success" style="margin-top: 16px">
                                    <i class="fas fa-search"></i> Search Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card-body d-none" id="student_table">
                    <button type="button" id="printBtn" class="btn btn-primary"><i class="fas fa-print"></i></button><br>
                    <div class="table-responsive responsive-table">

                        <table id="datatable1" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>

                                    <th class=""></th>
                                    <th class="">No.</th>
                                    <th class="">Images</th>
                                    <th class="">Student Name </th>
                                    <th class="">Class </th>
                                    <th class="">Section </th>
                                    <th class="">Roll </th>
                                    <th class="">Phone Number</th>
                                    <th class="">Address</th>
                                </tr>
                            </thead>
                            <tbody id="_data">
                                <tr id="no-data">
                                    <td colspan="10" class="text-center">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}
                <div class="card-body tabulation-container " id="tabulation-container">

                    <div id="printHeader" class="school-header">
                        <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}"
                            alt="School Logo">
                        <h2>{{ $website_info->name ?? 'Future ICT School' }}</h2>
                        <p>{{ $website_info->address ?? 'Daudkandi , Chittagong , Bangladesh' }}</p>

                        <span><span><span id="examName"></span>1st Semister-2025</span><br>
                            <span><span>Class:</span> <span id="className"></span> | </span>
                            <span><span>Section:</span> <span id="sectionName"></span> | </span>
                            <span><span>Subject:</span> <span id="subjectName"></span></span>
                    </div>
                    <div class="card-title mb-2">
                        <i class="fas fa-users"></i> Tabulation Sheet
                    </div>
                    <div class="table-responsive responsive-table ">

                        <table class="table table-bordered table-hover table-condensed mb-none">
                            <thead class="text-dark" style="background: #ededed; font-family: sans-serif;">
                                <tr style="border: 1px solid black !important;">
                                    <td rowspan="2" style="border: 1px solid black !important;">Sl</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">Students</td>
                                    <!-- <td rowspan="2">Register/ID</td> -->
                                    <td rowspan="2" style="border: 1px solid black !important;">Roll</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">English(100)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">Mathematics(100)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">Bangla(100)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">General knowledge(50)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">Islam & Moral Education(100)</td>
                                    <td style="border: 1px solid black !important;" colspan="5"
                                        style="text-align: center;">Drawing(50)</td>

                                    <td rowspan="2" style="border: 1px solid black !important;">Total Marks</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">GPA</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">P/F</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">Result</td>
                                    <td rowspan="2" style="border: 1px solid black !important;">Position</td>
                                </tr>
                                <tr>


                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>
                                    <td style="border: 1px solid black !important;">Wr</td>

                                    <td style="border: 1px solid black !important;">Ob</td>

                                    <td style="border: 1px solid black !important;">Pr</td>

                                    <td style="border: 1px solid black !important;">To</td>
                                    <td style="border: 1px solid black !important;">Gp</td>

                                </tr>
                            </thead>
                            <tbody>









                                <tr>
                                    <td style="border: 1px solid black !important;">13</td>
                                    <td style="border: 1px solid black !important;">Nusrat Fariya </td>
                                    <!-- <td>413</td> -->
                                    <td style="border: 1px solid black !important;">14</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">92</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">92</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">87</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">87</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">90</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">90</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">50</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">50</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">71</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">71</td>
                                    <td style="border: 1px solid black !important;">4</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">50</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">50</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">440/500 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        4.83 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        6/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-primary">PASS</span>
                                    </td>
                                    <td>
                                        12 </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">14</td>
                                    <td style="border: 1px solid black !important;">Ariyan </td>
                                    <!-- <td>414</td> -->
                                    <td style="border: 1px solid black !important;">15</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">79</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">79</td>
                                    <td style="border: 1px solid black !important;">4</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">65</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">65</td>
                                    <td style="border: 1px solid black !important;">3.5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">70</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">70</td>
                                    <td style="border: 1px solid black !important;">4</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">71</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">71</td>
                                    <td style="border: 1px solid black !important;">4</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">45</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">45</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">330/450 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        5/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">15</td>
                                    <td style="border: 1px solid black !important;">Abir </td>
                                    <!-- <td>416</td> -->
                                    <td style="border: 1px solid black !important;">16</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">86</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">86</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">68</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">68</td>
                                    <td style="border: 1px solid black !important;">3.5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">81</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">81</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">40</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">40</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">68</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">68</td>
                                    <td style="border: 1px solid black !important;">3.5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">45</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">45</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">388/500 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        4.50 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        6/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-primary">PASS</span>
                                    </td>
                                    <td>
                                        24 </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">16</td>
                                    <td style="border: 1px solid black !important;">Jannatul Saba </td>
                                    <!-- <td>417</td> -->
                                    <td style="border: 1px solid black !important;">17</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">95</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">95</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">95/400 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        1/3 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">17</td>
                                    <td style="border: 1px solid black !important;">Mohammad Mohib </td>
                                    <!-- <td>418</td> -->
                                    <td style="border: 1px solid black !important;">18</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/400 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/4 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">18</td>
                                    <td style="border: 1px solid black !important;">Yeasin </td>
                                    <!-- <td>419</td> -->
                                    <td style="border: 1px solid black !important;">19</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/400 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/4 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">19</td>
                                    <td style="border: 1px solid black !important;">Sadib Hasan </td>
                                    <!-- <td>420</td> -->
                                    <td style="border: 1px solid black !important;">20</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">96</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">96</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">95</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">95</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">95</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">95</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">45</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">45</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">90</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">90</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">40</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">40</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">461/500 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        5.00 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        6/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-primary">PASS</span>
                                    </td>
                                    <td>
                                        7 </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">20</td>
                                    <td style="border: 1px solid black !important;">Osman </td>
                                    <!-- <td>423</td> -->
                                    <td style="border: 1px solid black !important;">21</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">84</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">84</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">87</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">87</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">83</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">83</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">40</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">40</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">68</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">68</td>
                                    <td style="border: 1px solid black !important;">3.5</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">40</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">40</td>
                                    <td style="border: 1px solid black !important;">5</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">402/500 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        4.75 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        6/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-primary">PASS</span>
                                    </td>
                                    <td>
                                        26 </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">21</td>
                                    <td style="border: 1px solid black !important;">Nishat Anjum </td>
                                    <!-- <td>471</td> -->
                                    <td style="border: 1px solid black !important;">22</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">22</td>
                                    <td style="border: 1px solid black !important;">Amena Sarker </td>
                                    <!-- <td>424</td> -->
                                    <td style="border: 1px solid black !important;">22</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">0</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;" colspan="3">A</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/400 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/4 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">23</td>
                                    <td style="border: 1px solid black !important;">Talham</td>
                                    <!-- <td>500</td> -->
                                    <td style="border: 1px solid black !important;">23</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">24</td>
                                    <td style="border: 1px solid black !important;">Homayra</td>
                                    <!-- <td>486</td> -->
                                    <td style="border: 1px solid black !important;">24</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">25</td>
                                    <td style="border: 1px solid black !important;">Nafiz </td>
                                    <!-- <td>501</td> -->
                                    <td style="border: 1px solid black !important;">25</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">26</td>
                                    <td style="border: 1px solid black !important;">Tayeba</td>
                                    <!-- <td>489</td> -->
                                    <td style="border: 1px solid black !important;">26</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black !important;">27</td>
                                    <td style="border: 1px solid black !important;">Saniya</td>
                                    <!-- <td>490</td> -->
                                    <td style="border: 1px solid black !important;">27</td>

                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->
                                    <!-- <td> -->
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;">N</td>
                                    <td style="border: 1px solid black !important;" colspan="3">N/A</td> <!-- </td> -->


                                    <td style="border: 1px solid black !important;">0/0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0 </td>
                                    <!-- 10-08-22 -->
                                    <td style="border: 1px solid black !important;">
                                        0/0 </td>
                                    <td style="border: 1px solid black !important;">
                                        <span class="label label-danger">FAIL</span>
                                    </td>
                                    <td>
                                        N/A </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" id="printBtn" class="btn btn-danger"><i class="fas fa-print"></i>
                                Generate Print</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $('select').select2({
            placeholder: "---Select---",
            allowClear: false
        });
        var students = @json($students);
        $(document).on('change', 'select[name="class_id"]', function() {
            var sections = @json($sections);
            var subjects = @json($subjects);
            var students = @json($students);
            /*Get Class ID*/
            var selectedClassId = $(this).val();

            var filteredStudents = students.filter(function(student) {
                /*Filter class by class_id*/
                return student.current_class == selectedClassId;
            });
            var filteredSections = sections.filter(function(section) {
                /*Filter sections by class_id*/
                return section.class_id == selectedClassId;
            });
            /* Update Subject dropdown*/
            var filteredSubjects = subjects.filter(function(subject) {
                /*Filter subject by class_id*/
                return subject.class_id == selectedClassId;
            });

            /* Update Student dropdown*/
            var studentOptions = '<option value="">--Select--</option>';
            filteredStudents.forEach(function(student) {
                studentOptions += '<option value="' + student.id + '">' + student.name + '</option>';
            });
            /* Update Section dropdown*/
            var sectionOptions = '<option value="">--Select--</option>';
            filteredSections.forEach(function(section) {
                sectionOptions += '<option value="' + section.id + '">' + section.name + '</option>';
            });
            /* Update Subject dropdown*/
            var subjectOptions = '<option value="">--Select--</option>';
            filteredSubjects.forEach(function(subject) {
                subjectOptions += '<option value="' + subject.id + '">' + subject.name + '</option>';
            });

            $('select[name="student_id"]').html(studentOptions);
            $('select[name="student_id"]').select2();

            $('select[name="section_id"]').html(sectionOptions);
            $('select[name="section_id"]').select2();

            $('select[name="subject_id"]').html(subjectOptions);
            $('select[name="subject_id"]').select2();

        });

        $("button[name='submit_btn']").on('click', function(e) {
            e.preventDefault();
            var exam_id = $("select[name='exam_id']").val();
            var class_id = $("select[name='class_id']").val();
            var section_id = $("select[name='section_id']").val();
            var student_id = $("select[name='student_id']").val();

            if (!exam_id) {
                toastr.error("Exam Name is require!!");
                return;
            }
            if (!class_id) {
                toastr.error("Student Class Name is require!!");
                return;
            }

        });



        /* Print Trabulation  */
        document.getElementById("printBtn").addEventListener("click", function() {
            var printContents = document.getElementById("tabulation-container").innerHTML;
            var printWindow = window.open('', '_blank');

            printWindow.document.write('<html><head><title>Print Tabulation Sheet</title>');
            printWindow.document.write('<style>');

            /* Base font & layout*/
            printWindow.document.write(
                'body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; margin: 20px; color: #000; }'
                );

            /* School header*/
            printWindow.document.write(
            '.school-header { text-align: center; padding: 15px; margin-bottom: 10px; }');
            printWindow.document.write('.school-header img { height: 80px; width: 80px; margin-bottom: 10px; }');
            printWindow.document.write('.school-header h2 { font-size: 20px; margin: 0; }');
            printWindow.document.write('.school-header p { margin: 0; font-size: 14px; color: #333; }');

            /* Table styles*/
            printWindow.document.write(
                'table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }');
            printWindow.document.write(
                'th, td { border: 1px solid #000; padding: 5px; text-align: center; vertical-align: middle; }');
            printWindow.document.write('thead th { background-color: #f2f2f2; font-weight: bold; }');
            printWindow.document.write('tbody tr:nth-child(even) { background-color: #f9f9f9; }');

            /*Footer / signature space*/
            printWindow.document.write(
                '.signature-section { margin-top: 50px; display: flex; justify-content: space-between; }');
            printWindow.document.write(
                '.signature-box { width: 200px; text-align: center;  border-top: 2px dotted #cfc9c9; padding-top: 5px; }'
                );

            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);

            /*Optional signature section*/
            printWindow.document.write(`
        <div class="signature-section">
            <div class="signature-box">Class Teacher</div>
            <div class="signature-box">Headmaster</div>
        </div>
    `);

            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        });
    </script>
@endsection

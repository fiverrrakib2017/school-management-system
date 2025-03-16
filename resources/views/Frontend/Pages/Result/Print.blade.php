<style type="text/css">
    @page
    {
        size: auto;   /* auto is the initial value */
        margin: 5mm 5mm 5mm 5mm;
    }
    *
    {
        color: #555;
    }
    body
    {
        margin:0px;
        color:#000;
    }
    #header
    {
        height:100px;
        width:100%;
        border:thin solid #000;
        border-left:hidden;
        border-right:hidden;
        border-top:hidden;

    }
    table{
        width:100%;
        border-collapse:collapse;
        table-layout:auto;
        vertical-align:top;
        border:1px solid #000;
        font-family:Verdana, Geneva, sans-serif;
        font-size:11px;
        }

    td{
        vertical-align:top;
        border:thin solid #000;
        border-left:1px solid #000;
        border-right:1px solid #000;
        }
    .tdh{
        background-color:#D2D2D2;
        font-weight:bold;
        }

    #table{
        border:none;
        }
    .nobdr{
        border:none;
        }

    #progress_body
    {
        height:1010px;
        width: auto;
        margin-left: auto;
        margin-right: auto;
        border:thin solid #000;
        margin-top:4px;
        margin-bottom:9px;
        overflow:hidden;
    }
    #progress_title
    {
        margin-top:5px;
        width:180px;
        padding:2px;
        text-align:center;
        margin-left:auto;
        margin-right:auto;
        font-size:16px;
        font-family:Verdana, Geneva, sans-serif;
        font-weight:bold; color:#000;

    }
    #progress_grad_body
    {
        float:right;
        width:200px;
        margin-top:2px;
        margin-left:0px;
    }
    #grad_system
    {
        margin:0px;
        text-align:center;
        font-family:Verdana, Geneva, sans-serif;
        font-size:11px;
        margin-bottom:3px;
        font-weight:bold;

    }
    #grad_line
    {
        width:60%;
        margin-top:0px;
        margin-bottom:5px;
        padding:0px;
        margin-left:auto;
        margin-right:auto;
        border:thin solid #000;

    }
    #grad_table
    {
        font-family:Verdana, Geneva, sans-serif;
        font-size:11px;
        border:thin solid #000;
        border-right:hidden;
    }
    #name_class_holder
    {
        float:left;
        width:500px;
        margin-top:90px;
        border-left:hidden;
        overflow: hidden;
    }
    #name_class_holder table
    {
        border-left:hidden;
    }
    #student_name
    {
        margin:2px;
        font-family:Verdana, Geneva, sans-serif;

    }
    #mark_holder
    {
        height:460px;
        padding-top:5px;
        border:thin solid #000;
        border-top:hidden;
        border-left:hidden;
        border-right:hidden;
    }
    #mark_holder table
    {
        border-left:hidden;
        border-right:hidden;
    }
    #exam_name
    {
        margin:5px;
        text-decoration:underline;
    }
    #powerd_by
    {
        margin-top:0px;
        padding-right:20px;
        float:right;
        height:15px;
        font-family:Verdana, Geneva, sans-serif;
        font-size:8px;

    }
    </style>







    <div id="progress_body">
    <div id="header">
        <center><img src="{{ asset('Backend/images/94828ae245e43f1402b9f3e0e4c6ae8b.jpg') }}" height="90" width="100%" /></center>
    </div>
    <div id="progress_title">Progress Report</div>
    <div style="clear:both"></div>
    <div id="progress_grad_body">
    <p id="grad_system">Grading System</p>

    <table id="grad_table" border="1" width="100%" cellpadding="1" cellspacing="0">
        <tr>
        <td width="24%" class="td" align="center">L.G.</td>
        <td width="53%" class="td" align="center">Class Interval</td>
        <td width="23%" class="td" align="center">G.P.</td>
      </tr>



        <tr>

        <td class="td" align="center">5</td>
        <td class="td" align="center">00 - 00</td>
        <td class="td" align="center">4.20</td>
      </tr>


    </table>



    </div>



    <br />




    <div id="name_class_holder">
    <table border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
    <td class="td" align="center" colspan="8"><h3 id="student_name"></h3></td
    ></tr>
    <tr>
            <td align="right">Department :</td>
            <td align="left"><b></b></td>
            <td align="right">Class :</td>
            <td align="left"><b></b></td>
            <td align="right">Section :</td>
            <td align="left"><b></b></td>
            <td align="right">Roll :</td>
            <td align="left"><b></b></td>

              </tr>
    </table>
    </div>


    <!-- marks display area-->
    <div style="clear:both" ></div>
    <div id="mark_holder">

    <center><h3 style="margin:5px; text-decoration:underline;"><?php echo 'ExmName'." - ".'Exmstart_date' ?> </h3></center>
    <table border="1" width="100%"  cellpadding="2" cellspacing="0" >
    <tr bgcolor="#D1D1D1">
            <td width="2%" align="center" class="tdh">No.</td>
            <td width="4%" align="center" class="tdh">Code</td>
            <td width="29%" class="tdh">Subject Names</td>
            <td width="36%" class="tdh">Subject Sector Marks</td>
            <td width="7%" align="center" class="tdh">Full Marks</td>
            <td width="6%" align="center" class="tdh">Highest Marks</td>
            <td width="6%" align="center" class="tdh">Obtained Marks</td>
            <td width="5%" align="center" class="tdh">Grade Point</td>
            <td width="5%" align="center" class="tdh">Letter Grade</td>
              </tr>
              </tr>






            <tr>
            <td align="center" class="td">1</td>
            <td align="center" class="td"></td>
            <td class="td">Common Subject</td>
            <td class="td">

                </td>
            <td class="td" align="center"></td>
            <td class="td" align="center"></td>
            <td class="td" align="center"></td>
            <td class="td" align="center"></td>
            <td class="td" align="center"></td>
              </tr>




    <tr bgcolor="#D1D1D1">

            <td colspan="4" class="tdh">Point added from optional subject: </td>
            <td class="tdh" align="center"></td>
            <td class="tdh" align="center"></td>
            <td class="tdh" align="center"></td>
            <td class="tdh" align="center"></td>
            <td class="tdh" align="center"></td>
              </tr>
    </table>
    </div>
    <div style="height:200px;">
    <div style="height:130px; margin-bottom:10px;">
    <br />

    <table id="table" width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="31%" align="right" class="nobdr">Number of Students :</td>
        <td class="nobdr" width="12%"></td>
        <td class="nobdr" width="21%">&nbsp;</td>
        <td class="nobdr" width="11%">&nbsp;</td>
        <td class="nobdr" width="11%" align="right">Position :</td>
        <td class="nobdr" width="14%"></td>
      </tr>
      <tr>
        <td align="right" class="nobdr">Total Working Days :</td>
        <td class="nobdr">................</td>
        <td class="nobdr" align="right">Total Present Days :</td>
        <td class="nobdr" width="11%">................</td>
        <td class="nobdr" align="right">Percentage :</td>
        <td class="nobdr">................</td>
      </tr>
      <tr>
        <td align="right" class="nobdr">Class Teacher's Comments :</td>
        <td class="nobdr">................</td>
        <td class="nobdr">&nbsp;</td>
        <td class="nobdr" width="11%">&nbsp;</td>
        <td class="nobdr" align="right">Conduct :</td>
        <td class="nobdr">................</td>
      </tr>

    </table>




    </div>
    <table id="table" border="0" cellpadding="0" cellspacing="0">
    <tr>
            <td class="nobdr" align="center" >&nbsp;</td>
            <td class="nobdr" align="center" >&nbsp;</td>
            <td class="nobdr" align="center" ></td>
            </tr>
    <tr>
            <td class="nobdr" width="19%" align="center"><strong>Guardian's Sign.</strong></td>
            <td class="nobdr" width="40%" align="center"><strong>Class Teacher's Sign.</strong></td>
            <td class="nobdr" width="28%" align="center"><strong>Principal/Headmaster's Sign.</strong></td>
            </tr>

    </table>
    </div>
    </div>
    <div id="powerd_by">Powered by: <strong>IT-FAST</strong><br /></div>
    <div style="clear:both;"></div>




    </body>
    </html>

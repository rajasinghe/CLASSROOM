<?php

trait ReportModel
{

    function generateMonthlyReport($data)
    {
        // Generate the table template
        $template =
            "<thead>
          <tr>
              <th scope='col' rowspan='2'>
              MIS
              </th>
              <th scope='col' rowspan='2'>NIC</th>
              <th scope='col' rowspan='2'>INITIALS</th>
              <th scope='col' rowspan='2'>LAST NAME</th>
              <th scope='col' colspan='{$data['days']}'>ATTENDANCE</th>
              <th colspan='2'>SUMMARY</th>
          </tr><tr>";

        for ($i = 1; $i <= $data['days']; $i++) {
            $template .= "<th scope='col' class='at-td'>$i</th>";
        }

        $template .= "<th scope='col'> </th>
              <th scope='col'>%</th>
          </tr>
          </thead>
          <tbody>";

        foreach ($data['rows'] as $d) {

            // For the template
            $template .= "<tr>
                      <th>
                      {$d['mis']}
                      </th>
                      <td>{$d['nic']}</td>
                      <td>{$d['initials']}</td>
                      <td>{$d['surname']}</td>";

            // Generate table data for each day of the month and fill them with data if the exist
            for ($i = 1; $i <= $data['days']; $i++) {

                if (isset($d['attendance'][$i . '']) && (!empty($d['attendance'][$i . '']) || $d['attendance'][$i . ''] == 0)) {
                    $template .= "<td class='at-td'>{$d['attendance'][$i]}</td>";
                } else {
                    $template .= "<td class='at-td bb-none'> </td>";
                }
            }

            $cName = 'bad';
            if (($d['percentage'] >= 80)) {
                $cName = 'good';
            } else if (($d['percentage'] >= 70)) {
                $cName = 'average';
            }

            $template .= "<td>{$d['total']}</td>
                      <td class='$cName'>{$d['percentage']}%</td>
                  </tr>";

        }

        $template .= "</tbody>";


        $html = "<html><head>
          <style>
                body{
                    font-family: sans-serif;
                }
                table{
                    width:100%;
                    border:1px solid black;
                    border-collapse: collapse;
                }
                td,th{
                    border:1px solid black;
                    text-align: center;
                    font-size: 14px;
                }
                .info-table td{
                    padding: 4px 8px;
                }
                .at-td{
                    min-width: 16px;
                    font-size: 12px;
                }
                .bb-none{
                    border-bottom: none !important;
                    border-top: none !important;
                }
                .report-info div{
                    width: 700px;
                    margin-left: auto;
                }
                .report-info{
                    margin-top:30px;
                    display: flex;
                }
                .for-to{
                    display:flex;
                    font-size: 14px;
                    padding-top: 25px;
                }
                .for-to span{
                    margin-left: 15px;
                }
                .heading-table{
                    border: none !important;
                }
                .heading-table td, .heading-table th{
                    border: none !important;
                    text-align: left;
                    padding-bottom: 10px;
                }
                .good{
                    background-color: rgb(228, 115, 115);
                }
                .average{
                    background-color: rgb(117, 196, 117);
                }
                .bad{
                    background-color: rgb(43, 38, 38);
                    color: white;
                }
          </style>
          </head><body>
          <div>
              <div style='padding-bottom: 35px;'>
                  <span style='font-size: 18px; padding: 5px 10px; border: 1.5px solid black;'>STUDENT MONTHLY ATTENDANCE</span>
                  <span style='font-size: 18px; padding-left: 35px;'>Vocational Training Authority of Sri Lanka</span>
              </div>
              <table class='heading-table'>
                  <tr>
                      <td>Oraganization Name (Center Name)</td><td>: VTA</td><td>Organization ID</td><td>: P03/0082</td><td></td>
                  </tr>
                  <tr>
                      <td>Course Name</td><td>: Software Developer</td><td>Year</td><td>: 2023</td><td>Month
                      : {$data['month']}</td>
                  </tr>
              </table>
          </div>
          <div style='margin-top: 25px;'>
              <table class='monthly-table'>
                  $template
              </table>
          </div>
          <div class='for-to'>
              <span>Date : ……………………………..</span>
              <span>Prepared by (TO/OIC/Instructor) : ……………………………………</span>
              <span>Certified by(TM/AD) : ………………………………..</span>
          </div>
          <div class='report-info'>
              <div>
                  <table class='info-table'>
                      <tr>
                          <td>All dates </td><td>{$data['totalConductedDays']}</td>
                          <td>Present dates </td><td>{$data['totalAttendance']}</td>
                          <td>class % </td><td>{$data['totalPercentage']}%</td>
                      </tr>
                  </table>
              </div>
          </div>
          </body></html>";

        return $html;
    }

    function generateAnnualReport($data)
    {
        // Generate the table template
        $template =
            "<thead>
              <tr>
                  <th scope='col' rowspan='2' class='align-middle'>
                      MIS
                  </th>
                  <th scope='col' rowspan='2' >NIC</th>
                  <th scope='col' rowspan='2' >INITIALS</th>
                  <th scope='col' rowspan='2' >LAST NAME</th>
                  <th scope='col' colspan='12' >ATTENDANCE</th>
                  <th colspan='" . count($data['dates']) . "'></th>
              </tr>
              <tr>";

        foreach ($data['dates'] as $value) {
            $template .= "<th scope='col'>$value</th>";
        }

        $template .= "<th scope='col'>Total </th>
                  <th scope='col'>Counducted Days</th>
                  <th scope='col'>%</th>
                  <th>Rank</th>
              </tr>
          </thead><tbody>";

        foreach ($data['students'] as $d) {
            $template .= "<tr>
              <th>
              {$d['mis']}
              </th>
              <td>{$d['nic']}</td>
              <td>{$d['initials']}</td>
              <td>{$d['surname']}</td>";

            foreach ($d['attendance'] as $key => $value) {
                $template .= "<td>$value</td>";
            }

            $cName = 'bad';
            if (($d['percentage'] >= 80)) {
                $cName = 'good';
            } else if (($d['percentage'] >= 70)) {
                $cName = 'average';
            }

            $template .= "
              <td>{$d['total']}</td>
              <td>{$d['conducted_days']}</td>
              <td class='$cName'>{$d['percentage']}%</td>
              <td>{$d['rank']}</td>
              </tr>";
        }

        $template .= "</tbody>";


        $html = "<html><head>
          <style>
              body{
                  font-family: sans-serif;
              }
              table{
                  width:100%;
                  border:1px solid black;
                  border-collapse: collapse;
              }
              td,th{
                  border:1px solid black;
                  text-align: center;
                  font-size: 14px;
              }
              .info-table td{
                  padding: 4px 8px;
              }
              .at-td{
                  min-width: 16px;
                  font-size: 12px;
              }
              .bb-none{
                  border-bottom: none !important;
                  border-top: none !important;
              }
              .report-info div{
                  width: 200px;
                  margin-left: auto;
              }
              .report-info{
                  margin-top:25px;
                  display: flex;
              }
              .for-to{
                  display:flex;
                  font-size: 14px;
                  padding-top: 22px;
              }
              .for-to span{
                  margin-left: 15px;
              }
              .heading-table{
                  border: none !important;
              }
              .heading-table td, .heading-table th{
                  border: none !important;
                  text-align: left;
                  padding-bottom: 10px;
              }
              .good{
                  background-color: rgb(228, 115, 115);
              }
              .average{
                  background-color: rgb(117, 196, 117);
              }
              .bad{
                  background-color: rgb(43, 38, 38);
                  color: white;
              }
          </style>
          </head><body>
          <div>
              <div style='padding-bottom: 35px;'>
                  <span style='font-size: 18px; padding: 5px 10px; border: 1.5px solid black;'>STUDENT ANNUAL ATTENDANCE</span>
                  <span style='font-size: 18px; padding-left: 35px;'>Vocational Training Authority of Sri Lanka</span>
              </div>
              <table class='heading-table'>
                  <tr>
                      <td>Oraganization Name (Center Name)</td><td>: VTA</td><td>Organization ID</td><td>: P03/0082</td><td></td>
                  </tr>
                  <tr>
                      <td>Course Name</td><td>: Software Developer</td><td>Year</td><td>: 2023</td>
                  </tr>
              </table>
          </div>
          <div style='margin-top: 35px;'>
              <table class='monthly-table'>
                  $template
              </table>
          </div>
          <div class='for-to'>
              <span>Date : ……………………………..</span>
              <span>Prepared by (TO/OIC/Instructor) : ……………………………………</span>
              <span>Certified by(TM/AD) : ………………………………..</span>
          </div>
          </body></html>";

        return $html;
    }

    function generatePracticalAssessmentReport($data)
    {
        // Generate the table template
        $template =
            "<thead>
            <tr>
                <th scope='col'>
                MIS
                </th>
                <th scope='col'>SURNAME</th>";

        foreach ($data['modules'] as $module) {
            $template .= "<th scope='col'>{$module['module_no']}</th>";
        }

        $template .= "</tr>
        </thead><tbody>";

        foreach ($data['summary'] as $d) {

            // For the template
            $template .= "<tr>
            <td>{$d['mis']}</td>
            <td>{$d['surname']}</td>";

            // Generate table data for each day of the month and fill them with data if the exist
            foreach ($d['summary'] as $mark) {

                $template .= "<td>{$mark}</td>";
            }

            $template .= "</tr>";

        }

        $template .= "</tbody>";


        $html = "<html><head>
          <style>
                body{
                    font-family: sans-serif;
                }
                table{
                    width:100%;
                    border:1px solid black;
                    border-collapse: collapse;
                }
                td,th{
                    border:1px solid black;
                    text-align: center;
                    font-size: 14px;
                }
                .info-table td{
                    padding: 4px 8px;
                }
                .at-td{
                    min-width: 16px;
                    font-size: 12px;
                }
                .bb-none{
                    border-bottom: none !important;
                    border-top: none !important;
                }
                .report-info div{
                    width: 700px;
                    margin-left: auto;
                }
                .report-info{
                    margin-top:30px;
                    display: flex;
                }
                .for-to{
                    display:flex;
                    font-size: 14px;
                    padding-top: 25px;
                }
                .for-to span{
                    margin-left: 15px;
                }
                .heading-table{
                    border: none !important;
                }
                .heading-table td, .heading-table th{
                    border: none !important;
                    text-align: left;
                    padding-bottom: 10px;
                }
                .good{
                    background-color: rgb(228, 115, 115);
                }
                .average{
                    background-color: rgb(117, 196, 117);
                }
                .bad{
                    background-color: rgb(43, 38, 38);
                    color: white;
                }
          </style>
          </head><body>
          <div>
              <div style='padding-bottom: 35px;'>
                  <span style='font-size: 18px; padding: 5px 10px; border: 1.5px solid black;'>STUDENT MONTHLY ATTENDANCE</span>
                  <span style='font-size: 18px; padding-left: 35px;'>Vocational Training Authority of Sri Lanka</span>
              </div>
          </div>
          <div style='margin-top: 25px;'>
              <table class='monthly-table'>
                  $template
              </table>
          </div>
          <div class='for-to'>
              <span>Date : ……………………………..</span>
              <span>Prepared by (TO/OIC/Instructor) : ……………………………………</span>
              <span>Certified by(TM/AD) : ………………………………..</span>
          </div>
          <div class='report-info'>
              <div>
              </div>
          </div>
          </body></html>";

        return $html;
    }
    
    function generateTheoryAssessmentReport($data)
    {
        // Generate the table template
        $template =
            "<thead>
            <tr>
                <th scope='col'>
                MIS
                </th>
                <th scope='col'>SURNAME</th>";

        foreach ($data['modules'] as $module) {
            $template .= "<th scope='col'>{$module['module_no']}</th>";
        }

        $template .= "<th scope='col'>TOTAL</th>
                <th scope='col'>AVERAGE</th> 
            </tr>
        </thead><tbody>";

        foreach ($data['student_marks'] as $d) {

            // For the template
            $template .= "<tr>
            <td>{$d['mis']}</td>
            <td>{$d['surname']}</td>";

            // Generate table data for each day of the month and fill them with data if the exist
            foreach ($d['marks'] as $mark) {

                $template .= "<td>";

                foreach($mark as $m){
                    $template .= "<div class='d-block'>$m</div>";
                }

                $template .= "</td>";
            }

            $template .= "<td>{$d['total']}</td>
            <td>{$d['average']}</td>
            </tr>";

        }

        $template .= "</tbody>";


        $html = "<html><head>
          <style>
                body{
                    font-family: sans-serif;
                }
                table{
                    width:100%;
                    border:1px solid black;
                    border-collapse: collapse;
                }
                td,th{
                    border:1px solid black;
                    text-align: center;
                    font-size: 14px;
                }
                .info-table td{
                    padding: 4px 8px;
                }
                .at-td{
                    min-width: 16px;
                    font-size: 12px;
                }
                .bb-none{
                    border-bottom: none !important;
                    border-top: none !important;
                }
                .report-info div{
                    width: 700px;
                    margin-left: auto;
                }
                .report-info{
                    margin-top:30px;
                    display: flex;
                }
                .for-to{
                    display:flex;
                    font-size: 14px;
                    padding-top: 25px;
                }
                .for-to span{
                    margin-left: 15px;
                }
                .heading-table{
                    border: none !important;
                }
                .heading-table td, .heading-table th{
                    border: none !important;
                    text-align: left;
                    padding-bottom: 10px;
                }
                .good{
                    background-color: rgb(228, 115, 115);
                }
                .average{
                    background-color: rgb(117, 196, 117);
                }
                .bad{
                    background-color: rgb(43, 38, 38);
                    color: white;
                }
          </style>
          </head><body>
          <div>
              <div style='padding-bottom: 35px;'>
                  <span style='font-size: 18px; padding: 5px 10px; border: 1.5px solid black;'>STUDENT MONTHLY ATTENDANCE</span>
                  <span style='font-size: 18px; padding-left: 35px;'>Vocational Training Authority of Sri Lanka</span>
              </div>
          </div>
          <div style='margin-top: 25px;'>
              <table class='monthly-table'>
                  $template
              </table>
          </div>
          <div class='for-to'>
              <span>Date : ……………………………..</span>
              <span>Prepared by (TO/OIC/Instructor) : ……………………………………</span>
              <span>Certified by(TM/AD) : ………………………………..</span>
          </div>
          <div class='report-info'>
              <div>
              </div>
          </div>
          </body></html>";

        return $html;
    }

    function generateAssessmentTaskReport($data)
    {
        // Generate the table template
        $template =
            "<thead>
            <tr>
                <th scope='col' class='align-middle' rowspan='2'>
                    MIS
                </th>
                <th scope='col' rowspan='2'>STUDENT NAME</th>
                <th scop='col' class='text-center' colspan='" . count($data['steps']) ."'>STEPS</th>
                <th scope='col' class='align-middle c-date' rowspan='2'>COMPLETED DATE</th>
            </tr>
            <tr>";

        foreach ($data['steps'] as $step) {
            $template .= "<th scope='col'>{$step['step_no']}</th>";
        }

        $template .= "</tr>
        </thead><tbody>";

        foreach ($data['students'] as $d) {

            // For the template
            $template .= "<tr>
            <th scope='row' width='50px'>
                {$d['mis']}
            </th>
            <td width='200px'>{$d['initials']} {$d['surname']}</td>";

            // Generate table data for each day of the month and fill them with data if the exist
            foreach ($d['marks'] as $mark) {

                $template .= "<td class=''>". 
                (($mark == 1)? "TRUE":"FALSE") ."
                </td>";
            }

            $template .= "<td class='c-date'>
                    <span class='d-flex justify-content-center px-0'>
                        {$d['completed_date']}
                    </span>
                </td>
            </tr>";

        }

        $template .= "</tbody>";


        $html = "<html><head>
          <style>
                body{
                    font-family: sans-serif;
                }
                table{
                    width:100%;
                    border:1px solid black;
                    border-collapse: collapse;
                }
                td,th{
                    border:1px solid black;
                    text-align: center;
                    font-size: 14px;
                }
                .info-table td{
                    padding: 4px 8px;
                }
                .at-td{
                    min-width: 16px;
                    font-size: 12px;
                }
                .c-date{
                    width: 1%;
                    white-space: nowrap;
                }
                .bb-none{
                    border-bottom: none !important;
                    border-top: none !important;
                }
                .report-info div{
                    width: 700px;
                    margin-left: auto;
                }
                .report-info{
                    margin-top:30px;
                    display: flex;
                }
                .for-to{
                    display:flex;
                    font-size: 14px;
                    padding-top: 25px;
                }
                .for-to span{
                    margin-left: 15px;
                }
                .heading-table{
                    border: none !important;
                }
                .heading-table td, .heading-table th{
                    border: none !important;
                    text-align: left;
                    padding-bottom: 10px;
                }
                .good{
                    background-color: rgb(228, 115, 115);
                }
                .average{
                    background-color: rgb(117, 196, 117);
                }
                .bad{
                    background-color: rgb(43, 38, 38);
                    color: white;
                }
          </style>
          </head><body>
          <div>
              <div style='padding-bottom: 35px;'>
                  <span style='font-size: 18px; padding: 5px 10px; border: 1.5px solid black;'>STUDENT MONTHLY ATTENDANCE</span>
                  <span style='font-size: 18px; padding-left: 35px;'>Vocational Training Authority of Sri Lanka</span>
              </div>
          </div>
          <div style='margin-top: 25px;'>
              <table class='monthly-table'>
                  $template
              </table>
          </div>
          <div class='for-to'>
              <span>Date : ……………………………..</span>
              <span>Prepared by (TO/OIC/Instructor) : ……………………………………</span>
              <span>Certified by(TM/AD) : ………………………………..</span>
          </div>
          <div class='report-info'>
              <div>
              </div>
          </div>
          </body></html>";

        return $html;
    }
    
    function generateTrainingReport(){
        $template = file_get_contents("./public/trainingPrintout.html");
        return $template;
    }
}
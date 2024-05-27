<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Theatre details</title>
<!-- CSS FOR STYLING THE PAGE -->
<!--<style>
table {
          margin: 0 auto;
          font-size: large;
          border: 1px solid black;
       }
       h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',' Calibri', 'Trebuchet MS', 'sans-serif';
           }
        td {
            background-color: #40E0D0;
            border: 1px solid black;
          }
        th,
        td {
            font-weight: bold;
             border: 1px solid black;
             padding: 30px;
             text-align: center;
           }
  td {
          font-weight: lighter;
      }
     </style>-->
    <style>
     * {
    /* Change your font family */
    font-family: sans-serif;
}

table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    min-width: 400px;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

 tr {
    background-color: #1f931f;
    color: #030100;
    text-align: left;
    /*font-weight: bold;*/
}

 th,
 td {
    padding: 12px 15px;
}

 tr {
    border-bottom: 1px solid #dddddd;
}

tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

tr:last-of-type {
    border-bottom: 2px solid #009879;
}

 tr.active-row {
    font-weight: bold;
    color: #009879;
}
</style>
</head>
<body>
    
    

     <section>
        <h1>Stock Availability Form </h1>
        <!-- TABLE CONSTRUCTION -->
        <?php
        include("Stock.php");
    ?>
         <!--<table>
           <tr>
                <tr><th>D_id</th><th>Name</th><th>B_type<th>Gender</th><th>Weight</th><th>Address</th><th>BP</th><th>Phno</th><th>DOB</th><th>Doctor_id</th></tr>";
         </tr>
          <tr>
                // FETCHING DATA FROM EACH
                 //ROW OF EVERY COLUMN 
                <td> echo $rows['T_ID'];</td>
                <td> echo $rows['T_NAME'];</td>
                <td> echo $rows['PH_NO'];</td>
                <td> echo $rows['ADDRRESS'];</td>
                <td> echo $rows['MAIL'];</td>
                <td> echo $rows['RATE'];</td>
                <td> echo $rows['PRICE'];</td>
            </tr>
           
    </table>-->
     </section>
</body>
</html>
